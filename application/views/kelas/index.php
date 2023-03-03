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
                            <h6 class="m-0 font-weight-bold text-primary">Data Kelas</h6>
                            <?php if ($this->session->userdata('level') == "Administrator") { ?>
                                <div class="d-flex justify-content-end">
                                    <a class="btn btn-success btn-sm mr-2" href="#" data-toggle="modal" data-target="#UnggahDataModal" title="Unggah"><i class="fa fa-upload"></i> Unggah Data</a>
                                    <a class="btn btn-info btn-sm mr-2" href="#" data-toggle="modal" data-target="#UnggahDataModal" title="Unggah"><i class="fa fa-download"></i> Unduh Data</a>
                                    <a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#AddDataModal" title="Tambah"><i class="fas fa-plus"></i> Tambah Data</a>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="card-body">
                            <?php if (empty($kelas)) { ?>
                                <div class="alert alert-info text-center" role="alert">
                                    <b class="mt-2">Tidak Ada Data Kelas!</b>
                                </div>
                            <?php } else { ?>
                                <div class="table-responsive">
                                    <table class="display nowrap table table-bordered table-stripped" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Nama Jurusan</th>
                                                <th scope="col">Nama Kelas</th>
                                                <th scope="col">Wali Kelas</th>
                                                <th scope="col" class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($kelas as $row) {
                                            ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td>
                                                        <?php
                                                        $where = ['id_jurusan' => $row->id_jurusan];
                                                        $data = $this->m_crud->edit_data($where, 'tb_jurusan')->result();
                                                        foreach ($data as $k) {
                                                            echo $k->nama_jurusan;
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?= $row->nama_kelas; ?></td>
                                                    <td><?= $row->wali_kelas; ?></td>
                                                    <?php if ($this->session->userdata('level') == "Administrator") { ?>
                                                        <td class="text-center">
                                                            <a href="#" data-toggle="modal" data-target="#EditDataModal<?= $row->id_kelas ?>" class="btn btn-warning btn-sm" title="Hapus"><i class="fas fa-pen"></i></a>
                                                            <a href="#" data-toggle="modal" data-target="#DeleteDataModal<?= $row->id_kelas ?>" class="btn btn-danger btn-sm" title="Hapus"><i class="fas fa-trash"></i></a>
                                                        </td>
                                                    <?php } ?>
                                                    <?php if ($this->session->userdata('level') == "Guru") { ?>
                                                        <td class="text-center">
                                                            <a href="<?= base_url() . 'guru/data_pengguna/mahasiswa/ubah/' . $row->id_kelas; ?>" class="btn btn-warning btn-sm" title="Ubah"><i class="fas fa-pen"></i></a>
                                                            <a href="#" data-toggle="modal" data-target="#DeleteDataModal<?= $row->id_kelas ?>" class="btn btn-danger btn-sm" title="Hapus"><i class="fas fa-trash"></i></a>
                                                        </td>
                                                    <?php } ?>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Nama Jurusan</th>
                                                <th scope="col">Nama Kelas</th>
                                                <th scope="col">Wali Kelas</th>
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

<!-- Add Data Modal-->
<div class="modal fade" id="AddDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Tambah Data Kelas</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <?= form_open_multipart('administrator/kelas/aksi_tambah') ?>
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
                <div class="mb-3">
                    <label for="nama_kelas" class="form-label">Nama Kelas</label>
                    <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" placeholder="Masukkan Nama kelas" autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label for="wali_kelas" class="form-label">Wali Kelas</label>
                    <input type="text" class="form-control" id="wali_kelas" name="wali_kelas" placeholder="Masukkan Wali Kelas" autocomplete="off" required>
                </div>
            </div>
            <div class="modal-footer">
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
foreach ($kelas as $row) {
?>
    <div class="modal fade" id="EditDataModal<?= $row->id_kelas ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Tambah Data Kelas</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <?= form_open_multipart('administrator/kelas/aksi_ubah') ?>
                <div class="modal-body">
                    <input type="hidden" name="id_kelas" value="<?= $row->id_kelas ?>">
                    <div class="mb-3">
                        <label for="id_jurusan" class="form-label">Jurusan</label>
                        <select class="custom-select" name="id_jurusan" id="id_jurusan">
                            <option disabled selected>-- Pilih Jurusan --</option>
                            <?php foreach ($jurusan as $data) { ?>
                                <option value="<?= $data->id_jurusan ?>" <?= $data->id_jurusan == $row->id_jurusan ? 'selected' : null ?>><?= $data->nama_jurusan ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nama_kelas" class="form-label">Nama Kelas</label>
                        <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" placeholder="Masukkan Nama kelas" autocomplete="off" value="<?= $row->nama_kelas ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="wali_kelas" class="form-label">Wali Kelas</label>
                        <input type="text" class="form-control" id="wali_kelas" name="wali_kelas" placeholder="Masukkan Wali Kelas" autocomplete="off" value="<?= $row->wali_kelas ?>" required>
                    </div>
                </div>
                <div class="modal-footer">
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
foreach ($kelas as $row) {
?>
    <div class="modal fade" id="DeleteDataModal<?= $row->id_kelas ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin ingin menghapus ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    Anda akan menghapus Kelas<br>
                    <h3 class="font-weight-bold font-italic mt-2"><?= $row->nama_kelas ?></h3>
                    <div class="mt-4">
                        <i class="text-danger"> Tekan "Delete" untuk hapus data</i>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">
                        Cancel
                    </button>
                    <a href="<?= base_url() . 'administrator/kelas/hapus/' . $row->id_kelas; ?>" class="btn btn-danger" title="Hapus">Delete</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<!-- akhir delete data modal -->

<!-- Unggah Data Modal-->
<div class="modal fade" id="UnggahDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Unggah Data Jurusan</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <div class="alert alert-info" role="alert">
                        <h6 class="m-0 font-weight-bold">Untuk mengunggah file Excel, anda harus menggunakan template yang telah disediakan dengan menekan tombol <a class="btn btn-dark btn-sm">Unduh Template</a> agar tidak terjadi kesalahan atau error saat mengunggah.</h6>
                    </div>
                </div>
                <div class="mb-3">
                    <input type="file">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">
                    Cancel
                </button>
                <input type="submit" class="btn btn-success " value="Unggah Data">
            </div>
        </div>
    </div>
</div>
<!-- akhir Import data modal -->