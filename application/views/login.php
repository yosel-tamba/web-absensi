<?php date_default_timezone_set('Asia/Jakarta'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <title>Form login | TAP KARTU UNTUK ABSENSI</title>
  <style>
    ::-webkit-scrollbar {
      width: 10px;
    }

    ::-webkit-scrollbar-track {
      border-radius: 5px;
      background-color: #e6e6e6;
    }

    ::-webkit-scrollbar-thumb {
      border-radius: 5px;
      background-color: #789afa;
    }

    ::-webkit-scrollbar-thumb:hover {
      background-color: #4e73df;
    }

    p img {
      max-width: 100% !important;
      height: 100% !important;
    }
  </style>

  <!-- Custom fonts for this template-->

  <link href="<?= base_url('assets/sbadmin/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
  <link href="<?= base_url('assets/sbadmin/css/sb-admin-2.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/sbadmin/vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?= base_url() ?>assets/sbadmin/css/templates/sb-admin-2.min.css" rel="stylesheet" />
  <?php
  foreach ($sekolah as $key) {
    if ($key->foto_sekolah != 'sekolah.png') { ?>
      <link rel="icon" href="<?= base_url('assets/images/') . $key->foto_sekolah ?>">
  <?php }
  } ?>
</head>

<body class="bg-gradient-primary">
  <div class="container-fluid mb-3">
    <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-lg-12 mt-2 mb-lg-1 text-center d-flex justify-content-between align-items-center">
        <div class="d-flex justify-content-lg-start align-items-center">
          <?php
          foreach ($sekolah as $key) {
            if ($key->foto_sekolah != 'sekolah.png') { ?>
              <img class="rounded border border-primary border-bottom-primary align-middle mr-lg-3" width="60px" src="<?= base_url('assets/images/') . $key->foto_sekolah ?>" />
          <?php }
          } ?>
          <h2 class="text-light text-uppercase">Tap kartu untuk absensi</h2>
        </div>
        <div class="d-flex justify-content-lg-end align-items-center">
          <h5 id="date_time" class="text-light"></h5>
        </div>
      </div>
    </div>

    <!-- tabel absensi -->
    <div class="row justify-content-center">
      <div class="col-lg-12">
        <?php if ($this->session->flashdata('success_d')) : ?>
          <div class="alert alert-info text-center" role="alert">
            <b><?= $this->session->flashdata('success_d'); ?></b>
          </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('failed_d')) : ?>
          <div class="alert alert-danger text-center" role="alert">
            <b><?= $this->session->flashdata('failed_d'); ?></b>
          </div>
        <?php endif; ?>
        <div class="card o-hidden border-0 shadow-lg my-lg-2">
          <div class="card-header d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Aktivitas Kehadiran Siswa Terkini</h6>
            <div class="d-flex justify-content-end">
              <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
              <?= form_open('absensi') ?>
              <div class="input-group input-group-sm flex-nowrap">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="addon-wrapping">PIN</span>
                </div>
                <input type="text" class="form-control" name="pin" id="pin" aria-describedby="addon-wrapping" placeholder="Nomor PIN" autofocus autocomplete="off">
              </div>
              <?= form_close() ?>
              <span class="text-danger font-weight-bold">
              </span>
              <script>
                $(document).ready(function() {
                  $('#pin').on('input', function() {
                    if ($(this).val().length == 10) {
                      $(this).closest('form').submit();
                    }
                  });
                });
              </script>
            </div>
          </div>
          <div class="card-body px-4">
            <?php if ($this->session->flashdata('success')) : ?>
              <div class="alert alert-info text-center" role="alert">
                <b><?= $this->session->flashdata('success'); ?></b>
              </div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('failed')) : ?>
              <div class="alert alert-danger text-center" role="alert">
                <b><?= $this->session->flashdata('failed'); ?></b>
              </div>
            <?php endif; ?>
            <?php if (empty($hadir)) { ?>
              <div class="alert alert-info text-center" role="alert">
                <b class="mt-2">Tidak Ada Data Kehadiran Hari Ini.</b>
              </div>
            <?php } else { ?>
              <div class="table-responsive">
                <table class="display table table-bordered table-stripped" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr class="text-uppercase">
                      <th scope="col">No</th>
                      <th scope="col">Foto</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Nis</th>
                      <th scope="col">Kelas</th>
                      <th scope="col">Tanggal</th>
                      <th scope="col">Hadir</th>
                      <th scope="col">Pulang</th>
                      <th scope="col">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($hadir as $row) {
                    ?>
                      <tr>
                        <td class="align-middle"><?= $no++; ?></td>
                        <?php
                        $where = ['id_siswa' => $row->id_siswa];
                        $data = $this->m_crud->edit_data($where, 'tb_siswa')->result();
                        foreach ($data as $k) { ?>
                          <td class="align-middle"><img src="<?= base_url('assets/images/foto_profil/') . $k->foto ?>" width="100px" class="rounded border border-primary"></td>
                          <td class="align-middle"><?= $k->nama_siswa; ?></td>
                          <td class="align-middle"><?= $k->nis; ?></td>
                          <?php
                          $where = ['id_kelas' => $k->id_kelas];
                          $datas = $this->m_crud->edit_data($where, 'tb_kelas')->result();
                          foreach ($datas as $data) { ?>
                            <td class="align-middle">
                              <?= $data->tingkatan; ?>
                              <?php
                              $where = ['id_jurusan' => $k->id_jurusan];
                              $jurusan = $this->m_crud->edit_data($where, 'tb_jurusan')->result();
                              foreach ($jurusan as $j) { ?>
                                <?= $j->inisial; ?>
                              <?php } ?>
                              <?= $data->nama_kelas; ?>
                            </td>
                          <?php } ?>
                        <?php } ?>
                        <td class="align-middle"><?= date('d-m-Y', strtotime($row->tgl_masuk)); ?></td>
                        <td class="align-middle"> <?= $row->jam_masuk; ?></td>
                        <td class="align-middle"> <?= $row->jam_keluar; ?></td>
                        <td class="align-middle"><?= $row->status; ?></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                  <thead>
                    <tr class="text-uppercase">
                      <th scope="col">No</th>
                      <th scope="col">Foto</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Nis</th>
                      <th scope="col">Kelas</th>
                      <th scope="col">Tanggal</th>
                      <th scope="col">Hadir</th>
                      <th scope="col">Pulang</th>
                      <th scope="col">Status</th>
                    </tr>
                  </thead>
                </table>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg">
                <div class="p-4">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Login</h1>
                  </div>
                  <form class="user" method="post" action="<?= base_url('login/ceklogin') ?>">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Masukkan Username" autocomplete="off" />
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Masukkan Password" autocomplete="off" />
                    </div>
                    <input type="submit" class="btn btn-primary btn-user btn-block" value="Masuk">
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="fixed-bottom">
    <div class="bg-info">
      <marquee class="d-flex align-items-center text-light">
        <?php
        foreach ($berita as $key) {
          if ($key->isi_berita != '' && $key->status == '1') { ?>
            <span> ● <?= $key->isi_berita ?> ● </span>
        <?php }
        } ?>
      </marquee>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="<?= base_url() ?>assets/sbadmin/vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url() ?>assets/sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url() ?>assets/sbadmin/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url() ?>assets/sbadmin/js/templates/sb-admin-2.min.js"></script>

  <!-- datatables -->
  <script src="<?= base_url() ?>assets/sbadmin/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>assets/sbadmin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?= base_url() ?>assets/sbadmin/js/templates/demo/datatables-demo.js"></script>

  <!-- Data Table -->
  <script src="<?= base_url('assets/sbadmin/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
  <script src="<?= base_url('assets/sbadmin/vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>
  <script src="<?= base_url('assets/sbadmin/js/demo/datatables-demo.js') ?>"></script>

  <!-- my script -->
  <script src="<?= base_url('assets/sbadmin/js/script.js'); ?>"></script>
  <script type="text/javascript">
    window.onload = date_time('date_time');
  </script>

</body>

</html>