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
                            <h6 class="m-0 font-weight-bold text-primary">Data Pengguna</h6>
                            <div class="d-flex justify-content-end">
                                <a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#AddDataModal" title="Tambah"><i class="fas fa-plus"></i> Tambah Data</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php if (empty($pengguna)) { ?>
                                <div class="alert alert-info text-center" role="alert">
                                    <b class="mt-2">Tidak Ada Data Pengguna!</b>
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
                                                <th scope="col">Nama</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Username</th>
                                                <th scope="col">Password</th>
                                                <th scope="col">Level</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($pengguna as $row) {
                                            ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $row->nama_user; ?></td>
                                                    <td><?= $row->email; ?></td>
                                                    <td><?= $row->username; ?></td>
                                                    <td><?= $row->passconf; ?></td>
                                                    <td><?= $row->level == 0 ? 'Administrator' : 'Wali Kelas' ?></td>
                                                    <?php if ($this->session->userdata('level') == "Administrator") { ?>
                                                        <td class="text-center">
                                                            <a href="#" data-toggle="modal" data-target="#EditDataModal<?= $row->id_user ?>" class="btn btn-warning btn-sm" title="Ubah"><i class="fas fa-pen"></i></a>
                                                            <a href="#" data-toggle="modal" data-target="#DeleteDataModal<?= $row->id_user ?>" class="btn btn-danger btn-sm" title="Hapus"><i class="fas fa-trash"></i></a>
                                                        </td>
                                                    <?php } ?>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                        <thead>
                                            <tr class="text-uppercase">
                                                <th scope="col">No</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Username</th>
                                                <th scope="col">Password</th>
                                                <th scope="col">Level</th>
                                                <th scope="col">Aksi</th>
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

<!-- Add Data Modal-->
<div class="modal fade" id="AddDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light text-primary">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Form Tambah Data Pengguna</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <?= form_open_multipart('administrator/pengguna/aksi_tambah') ?>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="nama_user" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama_user" name="nama_user" placeholder="Masukkan Nama" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email" autocomplete="off">
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username" autocomplete="off">
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="text" class="form-control" id="password" name="password" placeholder="Masukkan Password" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="level" class="form-label">Level</label>
                    <select class="custom-select" name="level" id="level">
                        <option disabled selected>-- Pilih Level --</option>
                        <option value="0">Administrator</option>
                        <option value="1">Wali Kelas</option>
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
<!-- akhir add data modal -->

<!-- Edit Data Modal-->
<?php
$no = 1;
foreach ($pengguna as $row) {
?>
    <div class="modal fade" id="EditDataModal<?= $row->id_user ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light text-primary">
                    <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Form Ubah Data Pengguna</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <?= form_open_multipart('administrator/pengguna/aksi_ubah') ?>
                <div class="modal-body">
                    <input type="hidden" name="id_user" value="<?= $row->id_user ?>">
                    <div class="mb-3">
                        <label for="nama_user" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama_user" name="nama_user" placeholder="Masukkan Nama" autocomplete="off" value="<?= $row->nama_user ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email " autocomplete="off" value="<?= $row->email ?>">
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username " autocomplete="off" value="<?= $row->username ?>">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="text" class="form-control" id="password" name="password" placeholder="Masukkan Password " autocomplete="off" value="<?= $row->passconf ?>">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="level" class="form-label">Level</label>
                        <select class="custom-select" name="level" id="level">
                            <option value="0" <?= $row->level == '0' ? 'selected' : null ?>>Administrator</option>
                            <option value="1" <?= $row->level == '1' ? 'selected' : null ?>>Wali Kelas</option>
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
foreach ($pengguna as $row) {
?>
    <div class="modal fade" id="DeleteDataModal<?= $row->id_user ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light text-primary">
                    <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Yakin ingin menghapus ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    Anda akan menghapus pengguna<br>
                    <h3 class="font-weight-bold font-italic mt-2"><?= $row->nama_user ?></h3>
                    <hr>
                    <div class="mt-3">
                        <i class="text-danger"> Tekan tombol <strong>Delete</strong> untuk menghapus data</i>
                    </div>
                </div>
                <div class="modal-footer bg-light text-primary">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">
                        Cancel
                    </button>
                    <a href="<?= base_url() . 'administrator/pengguna/hapus/' . $row->id_user; ?>" class="btn btn-danger" title="Hapus">Delete</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<!-- akhir delete data modal -->