<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12 mb-5">
            <!-- Project Card Example -->
            <div class="card shadow">
                <div class="card-header d-sm-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Kehadiran Siswa</h6>
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#FilterDataModal" title="Filter"><i class="fas fa-filter"></i> Filter Data</a>
                    </div>
                </div>
                <div class="card-body">
                    <?php if (empty($siswa)) { ?>
                        <div class="alert alert-info text-center" role="alert">
                            <b class="mt-2">Tidak Ada Data Laporan.</b>
                        </div>
                    <?php } else { ?>
                        <?php if ($this->session->flashdata('failed')) : ?>
                            <div class="alert alert-danger text-center" role="alert">
                                <b><?php echo $this->session->flashdata('failed'); ?></b>
                            </div>
                        <?php endif; ?>
                        <div class="table-responsive">
                            <table class="display nowrap table table-bordered table-stripped" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="text-uppercase">
                                        <th scope="col">No</th>
                                        <th scope="col">NIS</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Kelas</th>
                                        <th scope="col">Wali Kelas</th>
                                        <th scope="col">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($siswa as $row) {
                                    ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $row->nis; ?></td>
                                            <td><?= $row->nama_siswa; ?></td>
                                            <?php
                                            $where = ['id_kelas' => $row->id_kelas];
                                            $datas = $this->m_crud->edit_data($where, 'tb_kelas')->result();
                                            foreach ($datas as $data) { ?>
                                                <td class="align-middle">
                                                    <?= $data->tingkatan; ?>
                                                    <?php
                                                    $where = ['id_jurusan' => $row->id_jurusan];
                                                    $jurusans = $this->m_crud->edit_data($where, 'tb_jurusan')->result();
                                                    foreach ($jurusans as $j) { ?>
                                                        <?= $j->inisial; ?>
                                                    <?php } ?>
                                                    <?= $data->nama_kelas; ?>
                                                </td>
                                                <td class="align-middle"><?= $data->wali_kelas; ?></td>
                                            <?php } ?>
                                            <td class="text-center">
                                                <?php if ($this->session->userdata('level') == "Administrator") { ?>
                                                <a href="<?= base_url('administrator/laporan/detail/' . $row->id_siswa) ?>" class="btn btn-secondary btn-sm" title="Detail"><i class="fas fa-eye"></i></a>
                                                <?php } ?>
                                                <?php if ($this->session->userdata('level') == "Wali Kelas") { ?>
                                                <a href="<?= base_url('wali_kelas/laporan/detail/' . $row->id_siswa) ?>" class="btn btn-secondary btn-sm" title="Detail"><i class="fas fa-eye"></i></a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <thead>
                                    <tr class="text-uppercase">
                                        <th scope="col">No</th>
                                        <th scope="col">NIS</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Kelas</th>
                                        <th scope="col">Wali Kelas</th>
                                        <th scope="col">Detail</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- Filter Data Modal-->
<div class="modal fade" id="FilterDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light text-primary">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Form Laporan Kehadiran Siswa</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <?php if ($this->session->userdata('level') == 'Administrator') { ?>
                <?= form_open_multipart('administrator/laporan/aksi_filter') ?>
            <?php } elseif ($this->session->userdata('level') == 'Wali Kelas') { ?>
                <?= form_open_multipart('wali_kelas/laporan/aksi_filter') ?>
            <?php } ?>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="id_jurusan" class="form-label">Jurusan</label>
                    <select class="custom-select" name="id_jurusan" id="id_jurusan">
                        <option disabled selected>-- Pilih Jurusan --</option>
                        <?php foreach ($jurusan as $data) { ?>
                            <option value="<?= $data->id_jurusan ?>"><?= $data->nama_jurusan ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3" id="id_kelas">
                    <label for="kelas" class="form-label">Kelas</label>
                    <select class="custom-select" name="id_kelas" id="kelas">
                        <option disabled selected>-- Pilih Kelas --</option>
                    </select>
                </div>
                <div class="mb-3" id="status">
                    <label for="status" class="form-label">Status</label>
                    <select class="custom-select" name="status" id="status">
                        <option disabled selected>-- Pilih Status --</option>
                        <option class="Hadir">Hadir</option>
                        <option class="Sakit">Sakit</option>
                        <option class="Izin">Izin</option>
                        <option class="Dispen">Dispen</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label mb-3">Filter Tanggal</label>
                    <div class="input-group mb-3 flex-nowrap">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="addon-wrapping">Dari</span>
                        </div>
                        <input type="date" class="form-control" id="dari_tgl" name="dari_tgl" aria-describedby="addon-wrapping" value="<?= date('Y-m-d') ?>">
                    </div>
                    <div class="input-group flex-nowrap">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="addon-wrapping">Sampai</span>
                        </div>
                        <input type="date" class="form-control" id="sampai_tgl" name="sampai_tgl" aria-describedby="addon-wrapping" value="<?= date('Y-m-d') ?>">
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light text-primary">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">
                    Cancel
                </button>
                <input type="submit" class="btn btn-primary" value="Filter Data">
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
<!-- akhir Filter data modal -->
