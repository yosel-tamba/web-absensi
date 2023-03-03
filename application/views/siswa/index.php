<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-12 mb-4">

            <div class="row">
                <!-- card -->
                <div class="col-lg-12">
                    <div class="card shadow mb-4">
                        <div class="card-header d-sm-flex align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Data Siswa</h6>
                            <?php if ($this->session->userdata('level') == "Administrator") { ?>
                                <a class="btn btn-primary btn-sm" href="<?= base_url('administrator/siswa/tambah') ?>" title="Tambah"><i class="fas fa-plus me-1"></i> Tambah Data</a>
                            <?php } ?>
                            <?php if ($this->session->userdata('level') == "Guru") { ?>
                                <a class="btn btn-primary btn-sm" href="<?= base_url('guru/data_pengguna/mahasiswa/tambah') ?>" title="Tambah"><i class="fas fa-plus me-1"></i> Tambah Data</a>
                            <?php } ?>
                        </div>
                        <div class="card-body">

                            <?php if (empty($siswa)) { ?>
                                <div class="alert alert-info text-center" role="alert">
                                    <b class="mt-2">Tidak Ada Data Siswa!</b>
                                </div>
                            <?php } else { ?>
                                <div class="table-responsive">
                                    <table class="display nowrap table table-bordered table-stripped" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Foto</th>
                                                <th scope="col">NIS</th>
                                                <th scope="col">Nama Siswa</th>
                                                <th scope="col">Kelas</th>
                                                <th scope="col" class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($siswa as $row) {
                                            ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><img src="<?= base_url('assets/images/foto_profil/') . $row->foto ?>" width="100px" alt=""></td>
                                                    <td><?= $row->nis; ?></td>
                                                    <td><?= $row->nama_siswa; ?></td>
                                                    <td>
                                                        <?php
                                                        $where = ['id_kelas' => $row->id_kelas];
                                                        $data = $this->m_crud->edit_data($where, 'tb_kelas')->result();
                                                        foreach ($data as $k) {
                                                            echo $k->nama_kelas;
                                                        }
                                                        ?>
                                                    </td>
                                                    <?php if ($this->session->userdata('level') == "Administrator") { ?>
                                                        <td class="text-center">
                                                            <a href="<?= base_url('administrator/siswa/ubah/') . $row->id_siswa ?>" class="btn btn-warning btn-sm" title="Hapus"><i class="fas fa-pen"></i></a>
                                                            <a href="#" data-toggle="modal" data-target="#DeleteDataModal<?= $row->id_siswa ?>" class="btn btn-danger btn-sm" title="Hapus"><i class="fas fa-trash"></i></a>
                                                        </td>
                                                    <?php } ?>
                                                    <?php if ($this->session->userdata('level') == "Guru") { ?>
                                                        <td class="text-center">
                                                            <a href="<?= base_url() . 'guru/data_pengguna/mahasiswa/ubah/' . $row->id_siswa; ?>" class="btn btn-warning btn-sm" title="Ubah"><i class="fas fa-pen"></i></a>
                                                            <a href="+#" data-toggle="modal" data-target="#DeleteDataModal<?= $row->id_siswa ?>" class="btn btn-danger btn-sm" title="Hapus"><i class="fas fa-trash"></i></a>
                                                        </td>
                                                    <?php } ?>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Foto</th>
                                                <th scope="col">NIS</th>
                                                <th scope="col">Nama Siswa</th>
                                                <th scope="col">Kelas</th>
                                                <th scope="col" class="text-center">Aksi</th>
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
        <!-- End Content Column -->
    </div>
    <!-- End Content Row -->
</div>
<!-- End Container Fluid -->

<!-- Edit Data Modal-->
<?php
foreach ($siswa as $row) {
?>
    <div class="modal fade" id="EditDataModal<?= $row->id_siswa ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <?= form_open_multipart('administrator/siswa/aksi_tambah') ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Tambah Data Siswa</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nip" class="form-label">NIS</label>
                        <input type="number" class="form-control" id="nis" name="nis" placeholder="Masukan NIS" autocomplete="off" value="value=" <?= $row->nis ?> required>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" placeholder="Masukan Nama" autocomplete="off" value="<?= $row->nama_siswa ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="id_jurusan" class="form-label">Jurusan</label>
                        <select class="custom-select" name="id_jurusan" id="id_jurusan">
                            <option value="<?= $row->id_jurusan ?>" selected><?= $row->id_jurusan ?></option>
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
                    <div class="mb-3">
                        <label for="kelas" class="form-label">Foto</label>
                        <br>
                        <input type="file">
                    </div>
                </div>
                <input type="hidden" name="foto_default" value="user.png">
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">
                        Cancel
                    </button>
                    <a href="<?= base_url() . 'administrator/data_pengguna/mahasiswa/ubah/' . $row->id_siswa; ?>" class="btn btn-warning btn-sm" title="Ubah"><i class="fas fa-pen"></i></a>
                    <input type="submit" class="btn btn-primary " value="Simpan Data">
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
<?php } ?>
<!-- akhir edit data modal -->

<!-- Delete data Modal-->
<?php
foreach ($siswa as $row) {
?>
    <div class="modal fade" id="DeleteDataModal<?= $row->id_siswa ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin ingin menghapus ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-between">
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-3">NIS</div>
                                <div class="col-1 text-right">:</div>
                                <div class="col"><strong><?= $row->nis ?></strong></div>
                            </div>
                            <div class="row">
                                <div class="col-3">Nama</div>
                                <div class="col-1 text-right">:</div>
                                <div class="col"><strong><?= $row->nama_siswa ?></strong></div>
                            </div>
                            <div class="row">
                                <div class="col-3">Kelas</div>
                                <div class="col-1 text-right">:</div>
                                <div class="col"><strong><?= $row->id_kelas ?></strong></div>
                            </div>
                        </div>
                        <img src="<?= base_url('assets/images/foto_profil/') . $row->foto ?>" width="150px" height="150px" alt="">
                    </div>
                    <div class="mt-3">
                        <i class="text-danger"> Tekan "Delete" untuk hapus data</i>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">
                        Cancel
                    </button>
                    <a href="<?= base_url() . 'administrator/siswa/hapus/' . $row->id_siswa; ?>" class="btn btn-danger" title="Hapus">Delete</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<!-- akhir delete data modal -->