<!-- Containe Fluid -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $judul ?></h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-12 mb-4">

            <div class="row">
                <!-- ubah -->
                <div class="col-lg-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Ubah Data Mahasiswa</h6>
                        </div>
                        <div class="card-body">
                            <?php if ($this->session->userdata('level') == 'Administrator') { ?>
                                <?= form_open_multipart('administrator/data_pengguna/mahasiswa/aksi_ubah') ?>
                            <?php } ?>
                            <?php if ($this->session->userdata('level') == 'Guru') { ?>
                                <?= form_open_multipart('guru/data_pengguna/mahasiswa/aksi_ubah') ?>
                            <?php } ?>
                            <?php if ($this->session->userdata('level') == 'Mahasiswa') { ?>
                                <?= form_open_multipart('mahasiswa/profil/aksi_ubah') ?>
                            <?php } ?>
                            <?php foreach ($mahasiswa as $row) { ?>
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
                                    <input type="hidden" name="id_mahasiswa" value="<?= $row->id_user ?>">
                                    <div class="col-lg-8">
                                        <div class="mb-3">
                                            <label for="nip" class="form-label">NIS</label>
                                            <input type="number" class="form-control" id="nis" name="nis" placeholder="Masukan NIS" autocomplete="off" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" placeholder="Masukan Nama" autocomplete="off" required>
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
                                <?php } ?>

                                </div>
                                <div class="card-footer">
                                    <?php if ($this->session->userdata('level') == 'Administrator') { ?>
                                        <a class="btn btn-secondary" href="<?= base_url('administrator/data_pengguna/mahasiswa/') ?>" role="button">Kembali</a>
                                    <?php } ?>
                                    <?php if ($this->session->userdata('level') == 'Guru') { ?>
                                        <a class="btn btn-secondary" href="<?= base_url('guru/data_pengguna/mahasiswa/') ?>" role="button">Kembali</a>
                                    <?php } ?>
                                    <input type="submit" class="btn btn-primary" value="Simpan Data">
                                    <input type="reset" class="btn btn-danger">
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