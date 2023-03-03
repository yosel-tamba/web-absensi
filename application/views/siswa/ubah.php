<!-- Containe Fluid -->
<div class="container-fluid">

    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-12 mb-4">

            <div class="row">
                <!-- ubah -->
                <div class="col-lg-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Ubah Data Siswa</h6>
                        </div>
                        <div class="card-body">
                            <?php if ($this->session->userdata('level') == 'Administrator') { ?>
                                <?= form_open_multipart('administrator/siswa/aksi_ubah') ?>
                            <?php } ?>
                            <?php if ($this->session->userdata('level') == 'Guru') { ?>
                                <?= form_open_multipart('guru/siswa/aksi_ubah') ?>
                            <?php } ?>
                            <?php foreach ($siswa as $row) { ?>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class=" text-center ">
                                            <input type='hidden' name="foto_default" value="<?= $row->foto ?>">
                                            <label for="nama" class="">Foto Profil</label>
                                            <p><input accept="image/*" type='file' id="tambah" name="foto" onchange="loadFile(event)" style="display: none;"></p>
                                            <span class=""><img class="rounded-circle border border-secondary" id="output" width="200px" height="200px" src="<?= base_url('assets/images/foto_profil/') . $row->foto ?>" /></span>
                                            <p><label for="tambah" class="btn btn-info mt-2" style="cursor: pointer;">Unggah Foto</label></p>
                                        </div>
                                    </div>
                                    <input type="hidden" name="id_siswa" value="<?= $row->id_siswa ?>">
                                    <div class="col-lg-8">
                                        <div class="mb-3">
                                            <label for="pin" class="form-label">PIN</label>
                                            <input type="number" class="form-control" id="pin" name="pin" placeholder="Masukkan PIN" autocomplete="off" value="<?= $row->pin ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nip" class="form-label">NIS</label>
                                            <input type="number" class="form-control" id="nis" name="nis" placeholder="Masukkan NIS" autocomplete="off" value="<?= $row->nis ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" placeholder="Masukkan Nama" autocomplete="off" value="<?= $row->nama_siswa ?>" required>
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
                                                foreach ($data as $k) { ?>
                                                    <option value="<?= $k->id_kelas; ?>" selected><?= $k->nama_kelas; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha512-+NqPlbbtM1QqiK8ZAo4Yrj2c4lNQoGv8P79DPtKzj++l5jnN39rHA/xsqn8zE9l0uSoxaCdrOgFs6yjyfbBxSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                                        <script>
                                            $(document).ready(function() {

                                                $("#id_jurusan").change(function() {
                                                    $("#id_kelas").val();
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "<?php echo base_url("index.php/administrator/siswa/listKelas"); ?>",
                                                        data: {
                                                            id_jurusan: $("#id_jurusan").val()
                                                        },
                                                        dataType: "json",
                                                        beforeSend: function(e) {
                                                            if (e && e.overrideMimeType) {
                                                                e.overrideMimeType("application/json;charset=UTF-8");
                                                            }
                                                        },
                                                        success: function(response) {
                                                            $("#id_kelas").html(response.list_kelas).show();
                                                        },
                                                        error: function(xhr, ajaxOptions, thrownError) {
                                                            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                                                        }
                                                    });
                                                });
                                            });
                                        </script>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                        <div class="card-footer">
                            <?php if ($this->session->userdata('level') == 'Administrator') { ?>
                                <a class="btn btn-secondary" href="<?= base_url('administrator/data_pengguna/siswa/') ?>" role="button">Kembali</a>
                            <?php } ?>
                            <?php if ($this->session->userdata('level') == 'Guru') { ?>
                                <a class="btn btn-secondary" href="<?= base_url('guru/data_pengguna/siswa/') ?>" role="button">Kembali</a>
                            <?php } ?>
                            <input type="submit" class="btn btn-primary" value="Simpan Data">
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
            <!-- End Content Column -->
        </div>
        <!-- End Content Row -->
    </div>
    <!-- End Container Fluid -->
    <script type="text/javascript">
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>