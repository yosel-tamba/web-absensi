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
                                <div class="d-flex justify-content-end">
                                    <a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#AddDataModal" title="Tambah"><i class="fas fa-plus me-1"></i> Tambah Data</a>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="card-body">

                            <?php if (empty($siswa)) { ?>
                                <div class="alert alert-info text-center" role="alert">
                                    <b class="mt-2">Tidak Ada Data Siswa!</b>
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
                                                <th scope="col">Foto</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">NIS</th>
                                                <th scope="col">Kelas</th>
                                                <th scope="col">PIN</th>
                                                <th scope="col">Wali Kelas</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($siswa as $row) {
                                            ?>
                                                <tr>
                                                    <td class="align-middle"><?= $no++; ?></td>
                                                    <td class="align-middle"><img src="<?= base_url('assets/images/foto_profil/') . $row->foto ?>" width="100px" class="rounded border border-primary"></td>
                                                    <td class="align-middle"><?= $row->nama_siswa; ?></td>
                                                    <td class="align-middle"><?= $row->nis; ?></td>
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
                                                        <td class="align-middle"><?= $row->pin; ?></td>
                                                        <td class="align-middle"><?= $data->wali_kelas; ?></td>
                                                    <?php } ?>
                                                    <?php if ($this->session->userdata('level') == "Administrator") { ?>
                                                        <td class="text-center align-middle">
                                                            <a href="<?= base_url('administrator/siswa/ubah/' . $row->id_siswa) ?>" class="btn btn-warning btn-sm" title="Ubah"><i class="fas fa-pen"></i></a>
                                                            <a href="#" data-toggle="modal" data-target="#DeleteDataModal<?= $row->id_siswa ?>" class="btn btn-danger btn-sm" title="Hapus"><i class="fas fa-trash"></i></a>
                                                        </td>
                                                    <?php } ?>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                        <thead>
                                            <tr class="text-uppercase">
                                                <th scope="col">No</th>
                                                <th scope="col">Foto</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">NIS</th>
                                                <th scope="col">Kelas</th>
                                                <th scope="col">PIN</th>
                                                <th scope="col">Wali Kelas</th>
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
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light text-primary">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Form Tambah Data Siswa</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <?= form_open_multipart('administrator/siswa/aksi_tambah') ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class=" text-center ">
                            <input type='hidden' name="foto_default" value="user.png">
                            <label for="foto">Foto Profil</label>
                            <p><input accept="image/*" type='file' id="tambah" name="foto" onchange="loadFile(event)" style="display: none;"></p>
                            <span><img class="rounded border border-primary" id="output" width="200px" height="200px" src="<?= base_url('assets/images/foto_profil/user.png') ?>" /></span>
                            <p><label for="tambah" class="btn btn-info mt-2" style="cursor: pointer;">Unggah Foto</label></p>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="mb-3">
                            <label for="pin" class="form-label">PIN</label>
                            <input type="number" class="form-control" id="pin" name="pin" placeholder="Masukkan PIN" autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="nip" class="form-label">NIS</label>
                            <input type="number" class="form-control" id="nis" name="nis" placeholder="Masukkan NIS" autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" placeholder="Masukkan Nama" autocomplete="off">
                        </div>
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
                    </div>
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

<!-- Delete data Modal-->
<?php
foreach ($siswa as $row) {
?>
    <div class="modal fade" id="DeleteDataModal<?= $row->id_siswa ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light text-primary">
                    <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Yakin ingin menghapus ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg">
                            <div class=" text-center">
                                <label for="foto" class="form-label">Foto Profil</label>
                                <img class="rounded border border-primary" id="output" width="150px" height="150px" src="<?= base_url('assets/images/foto_profil/') . $row->foto ?>" />
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="mb-3 text-center">
                                <label class="form-label mb-0">NIS</label>
                                <p class="font-weight-bold"><?= $row->nis ?></p>
                            </div>
                            <div class="mb-3 text-center">
                                <label class="form-label mb-0">Nama</label>
                                <p class="font-weight-bold"><?= $row->nama_siswa ?></p>
                            </div>
                            <div class="mb-3 text-center">
                                <label class="form-label mb-0">Kelas</label>
                                <?php
                                $where = ['id_kelas' => $row->id_kelas];
                                $data = $this->m_crud->edit_data($where, 'tb_kelas')->result();
                                foreach ($data as $k) { ?>
                                    <p class="font-weight-bold"><?= $k->nama_kelas ?></p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="mt-3">
                        <h6 class="text-danger text-center font-italic"> Tekan tombol <strong>Delete</strong> untuk menghapus data</h6>
                    </div>
                </div>
                <div class="modal-footer bg-light text-primary">
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