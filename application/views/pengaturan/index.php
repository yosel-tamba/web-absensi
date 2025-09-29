<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-12 mb-4">
            <?php if ($this->session->flashdata('success')) : ?>
                <div class="alert alert-info text-center" role="alert">
                    <b><?php echo $this->session->flashdata('success'); ?></b>
                </div>
            <?php endif; ?>
            <div class="row">
                <!-- card -->
                <div class="col-xl-4 col-lg-5">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Logo</h6>
                        </div>
                        <div class="card-body">
                            <?php foreach ($sekolah as $row) { ?>
                                <div class=" text-center">
                                    <label for="foto">Logo Sekolah</label>
                                    <p><img class="rounded border border-primary border-bottom-primary" width="200px" height="200px" src="<?= base_url('assets/images/') . $row->foto_sekolah ?>" /></p>
                                    <p>

                                    </p>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="card-footer">
                            <a href="#" data-toggle="modal" data-target="#LogoEditDataModal<?= $row->id_sekolah ?>" class="btn btn-warning btn-sm" title="Ubah"><i class="fas fa-pen mr-1"></i> Ubah</a>
                            <a href="#" data-toggle="modal" data-target="#LogoDeleteDataModal<?= $row->id_sekolah ?>" class="btn btn-danger btn-sm <?= $row->foto_sekolah == 'sekolah.png' ? 'disabled' : null ?>" title="Hapus"><i class="fas fa-trash mr-1"></i> Hapus</a>
                        </div>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Kehadiran</h6>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($total_hari)) { ?>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-2 text-center">
                                            <label class="form-label mb-0">Tahun Ajaran</label>
                                            <p class="font-weight-bold"><?= date('Y', strtotime($tgl_awal->tgl)); ?>/<?= date('Y', strtotime($tgl_awal->tgl)) + 1 ?></p>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-2 text-center">
                                            <label class="form-label mb-0">Awal Ajaran</label>
                                            <p class="font-weight-bold"><?= date('d-m-Y', strtotime($tgl_awal->tgl)); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-2 text-center">
                                            <label class="form-label mb-0">Total Hari</label>
                                            <p class="font-weight-bold"><?= $total_hari ?></p>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="text-center">
                                            <label class="form-label mb-0">Total Kehadiran</label>
                                            <p class="font-weight-bold"><?= $total_hadir ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="text-center">
                                    <p class="font-italic">Tahun ajaran belum dimulai</p>
                                    <p class="font-italic">Tekan tombol <b>Mulai</b>, untuk memulai tahun ajaran</p>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="card-footer">
                            <?php if (!empty($total_hari)) { ?>
                                <a href="#" data-toggle="modal" data-target="#ResetTahunDataModal" class="btn btn-primary btn-sm" title="Ganti Kelas">
                                    <i class="fas fa-sync-alt"></i> Ganti Kelas
                                </a>
                                <a href="#" data-toggle="modal" data-target="#ResetKehadiran" class="btn btn-danger btn-sm" title="Reset Kehadiran">
                                    <i class="fas fa-redo-alt"></i> Reset Kehadiran
                                </a>

                            <?php } else { ?>
                                <a class="btn btn-success btn-sm" href="#" data-toggle="modal" data-target="#MulaiDataModal" title="Mulai"><i class="fa fa-play mr-1"></i> Mulai</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-7">
                    <div class="card shadow mb-3">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Berita</h6>
                        </div>
                        <div class="card-body">
                            <?php
                            $no = 1;
                            foreach ($berita as $data) {
                            ?>
                                <label for="berita" class="form-label">Berita <?= $no++ ?></label>
                                <textarea type="number" class="form-control mb-2 border-bottom-primary border-primary" id="berita" name="berita" placeholder="Tidak ada Berita" autocomplete="off" style="height: 150px;" readonly><?= $data->isi_berita ?></textarea>
                                <div class="mb-3">
                                    <div class="row ">
                                        <div class="col-md-9">
                                            <a href="#" data-toggle="modal" data-target="#BeritaEditDataModal<?= $data->id_berita ?>" class="btn btn-warning btn-sm mb-1" title="Ubah"><i class="fas fa-pen mr-1"></i> Ubah</a>
                                        </div>
                                        <div class="col-md-3 d-flex justify-content-end align-content-center align-center">
                                            <select class="custom-select custom-select-sm" name="status" id="status" onChange="document.location.href=this.options[this.selectedIndex].value;">
                                                <option value="<?= base_url('administrator/pengaturan/status_berita/') . $data->id_berita . '/1' ?>" <?= $data->status == '1' ? 'selected disabled' : null ?>>Status : ON</option>
                                                <option value="<?= base_url('administrator/pengaturan/status_berita/') . $data->id_berita . '/0' ?>" <?= $data->status == '0' ? 'selected disabled' : null ?>>Status : OFF</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <br>
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

<!-- Edit Data Modal Logo-->
<?php
$no = 1;
foreach ($sekolah as $row) {
?>
    <div class="modal fade" id="LogoEditDataModal<?= $row->id_sekolah ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light text-primary">
                    <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Form Ubah Logo Sekolah</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <?= form_open_multipart('administrator/pengaturan/aksi_ubah_logo') ?>
                <div class="modal-body">
                    <input type="hidden" name="id_sekolah" value="<?= $row->id_sekolah ?>">
                    <input type="hidden" name="nama_sekolah" value="<?= $row->nama_sekolah ?>">
                    <div class="mb-3 text-center">
                        <input type='hidden' name="foto_default" value="<?= $row->foto_sekolah ?>">
                        <label for="foto" class="mb-1">Foto Profil</label>
                        <p><input accept="image/*" type='file' id="ubah" name="foto" onchange="loadFile(event)" style="display: none;"></p>
                        <span><img class="rounded border border-secondary" id="output" width="200px" src="<?= base_url('assets/images/') . $row->foto_sekolah ?>" /></span>
                        <p><label for="ubah" class="btn btn-info mt-2" style="cursor: pointer;">Unggah Foto</label></p>
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
<!-- Akhir Edit data modal Logo -->

<!-- Delete data Modal Logo -->
<?php
foreach ($sekolah as $row) {
?>
    <div class="modal fade" id="LogoDeleteDataModal<?= $row->id_sekolah ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light text-primary">
                    <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Yakin ingin menghapus ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <p>Anda akan menghapus Logo Sekolah</p>
                    <div class=" text-center ">
                        <p><img class="rounded border border-secondary" width="200px" height="200px" src="<?= base_url('assets/images/') . $row->foto_sekolah ?>" /></p>
                    </div>
                    <hr>
                    <div class="mt-3">
                        <i class="text-danger"> Tekan tombol <strong>Delete</strong> untuk menghapus data</i>
                    </div>
                </div>
                <div class="modal-footer bg-light text-primary">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">
                        Cancel
                    </button>
                    <a href="<?= base_url() . 'administrator/pengaturan/hapus_logo/' . $row->id_sekolah; ?>" class="btn btn-danger" title="Hapus">Delete</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<!-- akhir delete data modal Logo -->

<!-- Edit Data Modal Berita -->
<?php
$no = 1;
foreach ($berita as $row) {
?>
    <div class="modal fade" id="BeritaEditDataModal<?= $row->id_berita ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light text-primary">
                    <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Form Ubah Berita</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <?= form_open_multipart('administrator/pengaturan/aksi_ubah_berita') ?>
                <div class="modal-body">
                    <input type="hidden" name="id_berita" value="<?= $row->id_berita ?>">
                    <textarea type="number" class="form-control mb-2 border-bottom-primary border-primary" id="isi_berita" name="isi_berita" placeholder="Masukkan Isi Berita" autocomplete="off" style="height: 300px;"><?= $row->isi_berita ?></textarea>
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
<!-- Akhir Edit data modal Berita -->


<!-- Delete data Modal Berita -->
<?php
foreach ($berita as $row) {
?>
    <div class="modal fade" id="BeritaDeleteDataModal<?= $row->id_berita ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light text-primary">
                    <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Yakin ingin menghapus ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <p>Anda akan menghapus Berita Sekolah</p>
                    <p><strong><?= $row->isi_berita ?></strong></p>
                    <hr>
                    <div class="mt-3">
                        <i class="text-danger"> Tekan tombol <strong>Delete</strong> untuk menghapus data</i>
                    </div>
                </div>
                <div class="modal-footer bg-light text-primary">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">
                        Cancel
                    </button>
                    <a href="<?= base_url() . 'administrator/pengaturan/hapus_berita/' . $row->id_berita; ?>" class="btn btn-danger" title="Hapus">Delete</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<!-- akhir delete data modal Berita -->

<!-- Reset data Modal Tahun Ajaran -->
<div class="modal fade" id="ResetTahunDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light text-primary">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Yakin ingin menghapus ?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <p>Anda akan menghapus data kehadiran tahun ajaran <b><?= date('Y', strtotime($tgl_awal->tgl)); ?>/<?= date('Y', strtotime($tgl_awal->tgl)) + 1 ?></b>.</p>
                <b>
                    <p>Data kehadiran siswa kelas XII akan dihapus.</p>
                    <p>Siswa Kelas XII akan dihapus.</p>
                    <p>Siswa Kelas XI akan naik ke kelas XII.</p>
                    <p>Siswa Kelas X akan naik ke kelas XI.</p>
                </b>
                <hr>
                <div class="mt-3">
                    <i class="text-danger"> Tekan tombol <strong>Ganti</strong> untuk menghapus data tahun ajaran</i>
                </div>
            </div>
            <div class="modal-footer bg-light text-primary">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">
                    Cancel
                </button>
                <a href="<?= base_url() . 'administrator/pengaturan/ganti_kelas'; ?>" class="btn btn-danger" title="Ganti">Ganti</a>
            </div>
        </div>
    </div>
</div>
<!-- akhir Reset data modal Tahun Ajaran -->

<!-- Reset Kehadiran Modal -->
<div class="modal fade" id="ResetKehadiran" tabindex="-1" role="dialog" aria-labelledby="resetKehadiranLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light text-primary">
                <h5 class="modal-title font-weight-bold" id="resetKehadiranLabel">Yakin ingin mereset kehadiran?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <p>Anda akan mereset data kehadiran untuk tahun ajaran <b><?= date('Y'); ?>/<?= date('Y') + 1; ?></b>.</p>
                <hr>
                <div class="mt-3">
                    <i class="text-danger">Tekan tombol <strong>Reset</strong> untuk mereset data kehadiran tahun ajaran saat ini.</i>
                </div>
            </div>
            <div class="modal-footer bg-light text-primary">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">
                    Cancel
                </button>
                <a href="<?= base_url('administrator/pengaturan/reset_kehadiran'); ?>" class="btn btn-danger" title="Reset">Reset</a>
            </div>
        </div>
    </div>
</div>
<!-- End of Reset Kehadiran Modal -->


<!-- Mulai data Modal-->
<div class="modal fade" id="MulaiDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light text-primary">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Yakin Memulai Tahun ajaran?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body text-center">
                Anda akan memulai tahun ajaran tanggal <b><?= date('d-m-Y') ?></b><br>
                <h3 class="font-weight-bold font-italic mt-2"></h3>
                <hr>
                <div class="mt-3">
                    <i class="text-success"> Tekan tombol <strong>Mulai</strong> untuk memulai tahun ajaran</i>
                </div>
            </div>
            <div class="modal-footer bg-light text-primary">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">
                    Cancel
                </button>
                <a href="<?= base_url('administrator/pengaturan/mulai_kehadiran') ?>" class="btn btn-success" title="Mulai">Mulai</a>
            </div>
        </div>
    </div>
</div>
<!-- akhir Mulai data modal -->