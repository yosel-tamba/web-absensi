<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-12 mb-4">

            <div class="row">
                <?php
                foreach ($siswa as $row) {
                ?>
                    <!-- data siswa -->
                    <div class="col-lg-6">
                        <div class="card shadow mb-4">
                            <div class="card-header d-sm-flex align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Data Siswa</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg">
                                        <div class=" text-center">
                                            <label for="foto" class="form-label">Foto Profil</label>
                                            <br>
                                            <img class="rounded border border-primary" id="output" width="150px" height="150px" src="<?= base_url('assets/images/foto_profil/') . $row->foto ?>" />
                                        </div>
                                    </div>
                                    <div class="col-lg">
                                        <div class="mb-3 text-center">
                                            <label class="form-label mb-0">NIS</label>
                                            <p class="font-weight-bold"><?= $row->nis ?></p>
                                        </div>
                                        <div class="mb-3 text-center">
                                            <label class="form-label mb-0">Nama Lengkap</label>
                                            <p class="font-weight-bold"><?= $row->nama_siswa ?></p>
                                        </div>
                                        <?php
                                        $where = ['id_kelas' => $row->id_kelas];
                                        $datas = $this->m_crud->edit_data($where, 'tb_kelas')->result();
                                        foreach ($datas as $data) { ?>
                                            <div class="mb-3 text-center">
                                                <label class="form-label mb-0">Kelas</label>
                                                <p class="font-weight-bold">
                                                    <?= $data->tingkatan; ?>
                                                    <?php
                                                    $where = ['id_jurusan' => $row->id_jurusan];
                                                    $jurusans = $this->m_crud->edit_data($where, 'tb_jurusan')->result();
                                                    foreach ($jurusans as $j) { ?>
                                                        <?= $j->inisial; ?>
                                                    <?php } ?>
                                                    <?= $data->nama_kelas; ?>
                                                </p>
                                            </div>
                                            <div class="mb-3 text-center">
                                                <label class="form-label mb-0">Wali Kelas</label>
                                                <p class="font-weight-bold"><?= $data->wali_kelas ?></p>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                    <!-- status kehdarian siswa -->
                    <div class="col-lg-6">
                        <div class="card shadow mb-4">
                            <div class="card-header d-sm-flex align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Status Kehadiran Siswa</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg">
                                        <div class="mb-3 text-center">
                                            <label class="form-label mb-0">Hadir</label>
                                            <?php
                                            $where = [
                                                'id_siswa' => $row->id_siswa,
                                                'status' => 'Hadir',
                                                'status_data' => 'on'
                                            ];
                                            $total_hadir =  $this->m_crud->edit_data($where, 'tb_hadir')->num_rows();
                                            ?>
                                            <p class="font-weight-bold"><?= $total_hadir ?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg">
                                        <div class="mb-3 text-center">
                                            <label class="form-label mb-0">Sakit</label>
                                            <?php
                                            $where = [
                                                'id_siswa' => $row->id_siswa,
                                                'status' => 'Sakit',
                                                'status_data' => 'on'
                                            ];
                                            $total_sakit =  $this->m_crud->edit_data($where, 'tb_hadir')->num_rows();
                                            ?>
                                            <p class="font-weight-bold"><?= $total_sakit ?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg">
                                        <div class="mb-3 text-center">
                                            <label class="form-label mb-0">Izin</label>
                                            <?php
                                            $where = [
                                                'id_siswa' => $row->id_siswa,
                                                'status' => 'Izin',
                                                'status_data' => 'on'
                                            ];
                                            $total_izin =  $this->m_crud->edit_data($where, 'tb_hadir')->num_rows();
                                            ?>
                                            <p class="font-weight-bold"><?= $total_izin ?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg">
                                        <div class="mb-3 text-center">
                                            <label class="form-label mb-0">Dispen</label>
                                            <?php
                                            $where = [
                                                'id_siswa' => $row->id_siswa,
                                                'status' => 'Dispen',
                                                'status_data' => 'on'
                                            ];
                                            $total_dispen =  $this->m_crud->edit_data($where, 'tb_hadir')->num_rows();
                                            ?>
                                            <p class="font-weight-bold"><?= $total_dispen ?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg">
                                        <div class="mb-3 text-center">
                                            <label class="form-label mb-0">Alpha</label>
                                            <?php
                                            $where = [
                                                'id_siswa' => $row->id_siswa,
                                                'status_data' => 'on'
                                            ];
                                            $total =  $this->m_crud->edit_data($where, 'tb_hadir')->num_rows();
                                            $absen = $hari - $total;
                                            if ($absen <= 0) { ?>
                                                <p class="font-weight-bold">0</p>
                                            <?php } else { ?>
                                                <p class="font-weight-bold"><?= $absen ?></p>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Data harian kehadiran siswa -->
                    <div class="col-lg-12">
                        <div class="card shadow mb-4">
                            <div class="card-header d-sm-flex align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Data Kehadiran Siswa</h6>
                                <a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#AddDataModal" title="Tambah"><i class="fas fa-plus"></i> Tambah Data</a>
                            </div>
                            <div class="card-body">
                                <?php if (empty($hadir)) { ?>
                                    <div class="alert alert-info text-center" role="alert">
                                        <b class="mt-2">Tidak Ada Data Kehadiran!</b>
                                    </div>
                                <?php } else { ?>
                                    <?php if ($this->session->flashdata('success')) : ?>
                                        <div class="alert alert-info text-center" role="alert">
                                            <b><?php echo $this->session->flashdata('success'); ?></b>
                                        </div>
                                    <?php endif; ?>
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
                                                    <th scope="col">Tanggal</th>
                                                    <th scope="col">Jam Masuk</th>
                                                    <th scope="col">Jam Pulang</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Ubah</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                foreach ($hadir as $data) {
                                                ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td><?= $data->tgl_masuk; ?></td>
                                                        <td><?= $data->jam_masuk; ?></td>
                                                        <td><?= $data->jam_keluar; ?></td>
                                                        <td><?= $data->status; ?></td>

                                                        <td class="">
                                                            <a href="#" data-toggle="modal" data-target="#EditDataModal<?= $data->id_hadir ?>" class="btn btn-warning btn-sm" title="Ubah"><i class="fas fa-pen"></i></a>
                                                            <a href="#" data-toggle="modal" data-target="#DeleteDataModal<?= $data->id_hadir ?>" class="btn btn-danger btn-sm" title="Delete"><i class="fas fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                            <thead>
                                                <tr class="text-uppercase">
                                                    <th scope="col">No</th>
                                                    <th scope="col">Tanggal</th>
                                                    <th scope="col">Jam Masuk</th>
                                                    <th scope="col">Jam Pulang</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Ubah</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <!-- End Content Column -->
    </div>
    <!-- End Content Row -->
</div>
<!-- End Container Fluid -->

<!-- Tambah Data Modal-->
<div class="modal fade" id="AddDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light text-primary">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Form Tambah Data Kehadiran</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <?php if ($this->session->userdata('level') == 'Administrator') { ?>
                <?= form_open_multipart('administrator/laporan/tambah_kehadiran') ?>
            <?php } elseif ($this->session->userdata('level') == 'Wali Kelas') { ?>
                <?= form_open_multipart('wali_kelas/laporan/tambah_kehadiran') ?>
            <?php } ?>
            <div class="modal-body">
                <input type="hidden" name="id_siswa" value="<?= $this->uri->segment('4'); ?>">
                <div class="mb-3">
                    <label for="tgl_masuk" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="tgl_masuk" name="tgl_masuk" value="<?= date('Y-m-d') ?>">
                </div>
                <div class="mb-3">
                    <label for="jam_masuk" class="form-label">Jam Masuk</label>
                    <input type="time" class="form-control" id="jam_masuk" name="jam_masuk">
                </div>
                <div class="mb-3">
                    <label for="jam_keluar" class="form-label">Jam Pulang</label>
                    <input type="time" class="form-control" id="jam_keluar" name="jam_keluar">
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="custom-select" name="status" id="status">
                        <option value="Hadir">Hadir</option>
                        <option value="Sakit">Sakit</option>
                        <option value="Izin">Izin</option>
                        <option value="Dispen">Dispen</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer bg-light text-primary">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">
                    Cancel
                </button>
                <input type="submit" class="btn btn-primary " value="Simpan Data">
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
<!-- akhir Tambah data modal -->

<!-- Edit Data Modal-->
<?php
foreach ($hadir as $row) {
?>
    <div class="modal fade" id="EditDataModal<?= $row->id_hadir ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light text-primary">
                    <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Form Ubah Data Kehadiran</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <?php if ($this->session->userdata('level') == 'Administrator') { ?>
                    <?= form_open_multipart('administrator/laporan/ubah_kehadiran') ?>
                <?php } elseif ($this->session->userdata('level') == 'Wali Kelas') { ?>
                    <?= form_open_multipart('wali_kelas/laporan/ubah_kehadiran') ?>
                <?php } ?>
                <div class="modal-body">
                    <input type="hidden" name="id_hadir" value="<?= $row->id_hadir ?>">
                    <input type="hidden" name="id_siswa" value="<?= $this->uri->segment('4'); ?>">
                    <div class="mb-3">
                        <label for="nama_user" class="form-label">Nama</label>
                        <input type="date" class="form-control" id="tgl_masuk" name="tgl_masuk" value="<?= $row->tgl_masuk ?>">
                    </div>
                    <div class="mb-3">
                        <label for="nama_user" class="form-label">Jam Masuk</label>
                        <input type="time" class="form-control" id="jam_masuk" name="jam_masuk" value="<?= $row->jam_masuk ?>">
                    </div>
                    <div class="mb-3">
                        <label for="jam_keluar" class="form-label">Jam Pulang</label>
                        <input type="time" class="form-control" id="jam_keluar" name="jam_keluar" value="<?= $row->jam_keluar ?>">
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="custom-select" name="status" id="status">
                            <option value="Hadir" <?= $row->status == "Hadir" ? "selected" : null; ?>>Hadir</option>
                            <option value="Sakit" <?= $row->status == "Sakit" ? "selected" : null; ?>>Sakit</option>
                            <option value="Izin" <?= $row->status == "Izin" ? "selected" : null; ?>>Izin</option>
                            <option value="Dispen" <?= $row->status == "Dispen" ? "selected" : null; ?>>Dispen</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer bg-light text-primary">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">
                        Cancel
                    </button>
                    <input type="submit" class="btn btn-primary " value="Simpan Data">
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
<?php } ?>
<!-- akhir Edit data modal -->

<!-- Delete data Modal-->
<?php
foreach ($hadir as $row) {
?>
    <div class="modal fade" id="DeleteDataModal<?= $row->id_hadir ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light text-primary">
                    <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Yakin ingin menghapus ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_hadir" value="<?= $row->id_hadir ?>">
                    <input type="hidden" name="id_siswa" value="<?= $this->uri->segment('4'); ?>">
                    <div class="mb-3">
                        <label for="nama_user" class="form-label">Nama</label>
                        <br> <b><?= $row->tgl_masuk ?></b>
                    </div>
                    <div class="mb-3">
                        <label for="nama_user" class="form-label">Jam Masuk</label>
                        <br> <b><?= $row->jam_masuk ?></b>
                    </div>
                    <div class="mb-3">
                        <label for="jam_keluar" class="form-label">Jam Pulang</label>
                        <br> <b><?= $row->jam_keluar ?></b>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <br> <b><?= $row->status; ?></b>
                    </div>
                </div>
                <div class="modal-footer bg-light text-primary">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">
                        Cancel
                    </button>
                    <?php if ($this->session->userdata('level') == 'Administrator') { ?>
                        <a href="<?= base_url() . 'administrator/laporan/hapus_kehadiran/' . $row->id_hadir . '/' . $this->uri->segment('4') ?>" class="btn btn-danger" title="Hapus">Delete</a>
                    <?php } elseif ($this->session->userdata('level') == 'Wali Kelas') { ?>
                        <a href="<?= base_url() . 'wali_kelas/laporan/hapus_kehadiran/' . $row->id_hadir . '/' . $this->uri->segment('4') ?>" class="btn btn-danger" title="Hapus">Delete</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<!-- akhir delete data modal -->