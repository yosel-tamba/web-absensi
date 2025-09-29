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
                            <h6 class="m-0 font-weight-bold text-primary">Ubah Data Siswa</h6>
                        </div>
                        <?= form_open_multipart('administrator/siswa/aksi_ubah') ?>
                        <div class="card-body">
                            <?php if ($this->session->flashdata('failed')) : ?>
                                <div class="alert alert-danger text-center" role="alert">
                                    <b><?php echo $this->session->flashdata('failed'); ?></b>
                                </div>
                            <?php endif; ?>
                            <?php
                            $no = 1;
                            foreach ($siswa as $row) {
                            ?>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class=" text-center ">
                                            <input type='hidden' name="foto_default" value="<?= $row->foto ?>">
                                            <label for="foto">Foto Profil</label>
                                            <p><input accept="image/*" type='file' id="ubah" name="foto" onchange="loadFile(event)" style="display: none;"></p>
                                            <span><img class="rounded border border-primary" id="output" width="250px" src="<?= base_url('assets/images/foto_profil/') . $row->foto ?>" /></span>
                                            <p><label for="ubah" class="btn btn-info mt-2" style="cursor: pointer;">Unggah Foto</label></p>
                                        </div>
                                    </div>
                                    <input type="hidden" name="id_siswa" value="<?= $row->id_siswa ?>">
                                    <div class="col-lg-8">
                                        <div class="mb-3">
                                            <label for="pin" class="form-label">PIN</label>
                                            <input type="number" class="form-control" id="pin" name="pin" placeholder="Masukkan PIN" autocomplete="off" value="<?= $row->pin ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="nis " class="form-label">NIS</label>
                                            <input type="number" class="form-control" id="nis" name="nis" placeholder="Masukkan NIS" autocomplete="off" value="<?= $row->nis ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" placeholder="Masukkan Nama" autocomplete="off" value="<?= $row->nama_siswa ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="id_jurusan" class="form-label">Jurusan</label>
                                            <select class="custom-select" name="id_jurusan" id="id_jurusan">
                                                <option disabled selected>-- Pilih Jurusan --</option>
                                                <?php foreach ($jurusan as $data) { ?>
                                                    <option value="<?= $data->id_jurusan ?>" <?= $data->id_jurusan == $row->id_jurusan ? 'selected' : null ?>><?= $data->nama_jurusan ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="mb-3" id="id_kelas">
                                            <label for="kelas" class="form-label">Kelas</label>
                                            <select class="custom-select" name="id_kelas" id="kelas">
                                                <?php
                                                $where = ['id_kelas' => $row->id_kelas];
                                                $data = $this->m_crud->edit_data($where, 'tb_kelas')->result();
                                                foreach ($data as $k) {
                                                    $where = ['id_jurusan' => $row->id_jurusan];
                                                    $jurusans = $this->m_crud->edit_data($where, 'tb_jurusan')->result();
                                                    foreach ($jurusans as $j) { ?>
                                                        <option value="<?= $k->id_kelas; ?>" selected><?= $k->tingkatan; ?> <?= $j->inisial; ?> <?= $k->nama_kelas; ?></option>
                                                <?php }
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="card-footer bg-light text-primary">
                            <a class="btn btn-secondary" href="<?= base_url('administrator/siswa') ?>">Kembali</a>
                            <input type="submit" class="btn btn-primary " value="Simpan Data">
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Content Column -->
    </div>
    <!-- End Content Row -->
</div>
<!-- End Container Fluid -->