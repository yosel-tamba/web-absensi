<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12 mb-5">
            <!-- Project Card Example -->
            <div class="card shadow">
                <div class="card-header d-sm-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Laporan Absensi Siswa</h6>
                    <div class="d-flex justify-content-end">
                        <?php if ($this->session->userdata('level') == 'Administrator') { ?>
                            <a class="btn btn-secondary btn-sm mr-1" href="<?= base_url('administrator/laporan') ?>" title="Kembali"><i class="fas fa-arrow-left"></i> Kembali</a>
                            <a class="btn btn-success btn-sm" href="<?= base_url('administrator/laporan/excel/' . $id_jurusan . '/' . $id_kelas . '/' . $dari_tgl . '/' . $sampai_tgl . '/' . $status) ?>" title="Unduh"><i class="fa fa-download"></i> Unduh Data</a>
                        <?php } ?>
                        <?php if ($this->session->userdata('level') == 'Wali Kelas') { ?>
                            <a class="btn btn-secondary btn-sm mr-1" href="<?= base_url('wali_kelas/laporan') ?>" title="Kembali"><i class="fas fa-arrow-left"></i> Kembali</a>
                            <a class="btn btn-success btn-sm" href="<?= base_url('wali_kelas/laporan/excel/' . $id_jurusan . '/' . $id_kelas . '/' . $dari_tgl . '/' . $sampai_tgl . '/' . $status) ?>" title="Unduh"><i class="fa fa-download"></i> Unduh Data</a>
                        <?php } ?>
                    </div>
                </div>
                <div class="card-body">
                    <?php if (!empty($pesan)) : ?>
                        <div class="alert alert-info text-center" role="alert">
                            <b><?= $pesan; ?></b>
                        </div>
                    <?php endif; ?>
                    <?php if (empty($hadir)) { ?>
                        <div class="alert alert-info text-center" role="alert">
                            <b class="mt-2">Tidak Ada Data Pada Tanggal <?= $dari_tgl ?> Sampai Tanggal <?= $sampai_tgl ?> .</b>
                        </div>
                    <?php } else { ?>
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
                                    foreach ($hadir as $row) {
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
                                                    $where = ['id_jurusan' => $data->id_jurusan];
                                                    $jurusans = $this->m_crud->edit_data($where, 'tb_jurusan')->result();
                                                    foreach ($jurusans as $j) { ?>
                                                        <?= $j->inisial; ?>
                                                    <?php } ?>
                                                    <?= $data->nama_kelas; ?>
                                                </td>
                                                <td class="align-middle"><?= $data->wali_kelas; ?></td>
                                            <?php } ?>
                                            <td class="text-center">
                                                <?php
                                                $where = ['nis' => $row->nis];
                                                $data = $this->m_crud->edit_data($where, 'tb_siswa')->result();
                                                foreach ($data as $k) { ?>
                                                    <a class="btn btn-secondary btn-sm" href="#" data-toggle="modal" data-target="#DetailDataModal<?= $k->id_siswa ?>" title="Detail"><i class="fas fa-eye"></i></a>
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
<!-- Detail Data Modal-->
<?php
$no = 1;
foreach ($hadir as $row) {
    $where = ['nis' => $row->nis];
    $data = $this->m_crud->edit_data($where, 'tb_siswa')->result();
    foreach ($data as $row) {
?>
        <div class="modal fade" id="DetailDataModal<?= $row->id_siswa ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-light text-primary">
                        <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Detail Kehadiran Siswa</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg">
                                <div class=" text-center">
                                    <label for="foto" class="form-label">Foto Profil</label>
                                    <?php
                                    $where = ['nis' => $row->nis];
                                    $data = $this->m_crud->edit_data($where, 'tb_siswa')->result();
                                    foreach ($data as $k) { ?>
                                        <img class="rounded border border-primary" id="output" width="200px" height="200px" src="<?= base_url('assets/images/foto_profil/') . $k->foto ?>" />
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="mb-3 text-center">
                                    <label for="nis" class="form-label mb-0">NIS</label>
                                    <p class="font-weight-bold"><?= $row->nis ?></p>
                                </div>
                                <div class="mb-3 text-center">
                                    <label for="nama" class="form-label mb-0">Nama Lengkap</label>
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
                        <p class="text-center font-weight-bold">Status Kehadiran :</p>
                        <div class="row">
                            <div class="col-lg">
                                <div class="mb-3 text-center">
                                    <label for="nis" class="form-label mb-0">Hadir</label>
                                    <?php
                                    $where = [
                                        'id_siswa' => $row->id_siswa,
                                        'status' => 'Hadir'
                                    ];
                                    $total_hadir =  $this->m_crud->edit_data($where, 'tb_hadir')->num_rows();
                                    ?>
                                    <p class="font-weight-bold"><?= $total_hadir ?></p>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="mb-3 text-center">
                                    <label for="nis" class="form-label mb-0">Sakit</label>
                                    <?php
                                    $where = [
                                        'id_siswa' => $row->id_siswa,
                                        'status' => 'Sakit'
                                    ];
                                    $total_sakit =  $this->m_crud->edit_data($where, 'tb_hadir')->num_rows();
                                    ?>
                                    <p class="font-weight-bold"><?= $total_sakit ?></p>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="mb-3 text-center">
                                    <label for="nis" class="form-label mb-0">Izin</label>
                                    <?php
                                    $where = [
                                        'id_siswa' => $row->id_siswa,
                                        'status' => 'Izin'
                                    ];
                                    $total_izin =  $this->m_crud->edit_data($where, 'tb_hadir')->num_rows();
                                    ?>
                                    <p class="font-weight-bold"><?= $total_izin ?></p>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="mb-3 text-center">
                                    <label for="nis" class="form-label mb-0">Dispen</label>
                                    <?php
                                    $where = [
                                        'id_siswa' => $row->id_siswa,
                                        'status' => 'Dispen'
                                    ];
                                    $total_dispen =  $this->m_crud->edit_data($where, 'tb_hadir')->num_rows();
                                    ?>
                                    <p class="font-weight-bold"><?= $total_dispen ?></p>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="mb-3 text-center">
                                    <label for="nis" class="form-label mb-0">Alpha</label>
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
        </div>
<?php }
} ?>
<!-- akhir Detail data modal -->