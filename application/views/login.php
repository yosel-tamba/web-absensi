<?php date_default_timezone_set('Asia/Jakarta'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Form login | Absenin</title>

  <!-- Custom fonts for this template-->

  <link href="<?= base_url('assets/sbadmin/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
  <link href="<?= base_url('assets/sbadmin/css/sb-admin-2.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/sbadmin/vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?= base_url() ?>assets/sbadmin/css/templates/sb-admin-2.min.css" rel="stylesheet" />
</head>

<body class="bg-gradient-primary">
  <div class="container-fluid">
    <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-lg-12 mt-4 mb-lg-0 mb-4 text-center d-flex justify-content-between">
        <h1 class="text-light text-uppercase">Tap kartu untuk absensi</h1>
        <h4 id="date_time" class="text-light"></h4>
      </div>
    </div>

    <!-- tabel absensi -->
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card o-hidden border-0 shadow-lg my-lg-5 my-0">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
              Absen kehadiran
            </h6>
          </div>
          <div class="card-body p-4">
            <div class="table-responsive">
              <table class="table table-bordered table-hover" id="dataTable">
                <thead>
                  <tr class="text-uppercase">
                    <th scope="col">No</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Nis</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Masuk</th>
                    <th scope="col">Keluar</th>
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
                      <td><?= $row->nama_siswa; ?></td>
                      <td><?= $row->nis; ?></td>
                      <td>
                        <?php
                        $where = ['id_kelas' => $row->id_kelas];
                        $data = $this->m_crud->edit_data($where, 'tb_kelas')->result();
                        foreach ($data as $k) {
                          echo $k->nama_kelas;
                        }
                        ?>
                      </td>
                      <td><?= $row->jam_masuk; ?></td>
                      <td><?= $row->jam_keluar; ?></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Login</h1>
                  </div>
                  <?php
                  if (isset($_GET['alert'])) {
                    if ($_GET['alert'] == "gagal") {
                      echo "<div class='alert alert-danger fw-bold text-center'>Maaf! Username dan Password salah</div>";
                    }
                    if ($_GET['alert'] == "belum_login") {
                      echo "<div class='alert alert-danger fw-bold text-center'>Anda Harus Login Terlebih Dahulu!</div>";
                    }
                    if ($_GET['alert'] == "bukan_admin") {
                      echo "<div class='alert alert-danger fw-bold text-center'>Anda Bukan Administrator</div>";
                    }
                    if ($_GET['alert'] == "bukan_guru") {
                      echo "<div class='alert alert-danger fw-bold text-center'>Anda Bukan Guru</div>";
                    }
                    if (isset($_GET['alert'])) {
                      if ($_GET['alert'] == "berhasil") {
                        echo "<div class='alert alert-success fw-bold text-center'>Data berhasil ditambahkan, silahkan login!</div>";
                      }
                    }
                  }
                  ?>
                  <form class="user" method="post" action="<?= base_url('login/ceklogin') ?>">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Masukan Username" autocomplete="off" autofocus required />
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password" autocomplete="off" required />
                    </div>
                    <input type="submit" class="btn btn-primary btn-user btn-block" value="Masuk">
                    <hr />
                    <div class="text-center">
                      <a class="small" href="<?= base_url('register'); ?>">Belum punya akun?</a>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
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

  <!-- my script -->
  <script src="<?= base_url('assets/bootstrap/js/script.js'); ?>"></script>
  <script type="text/javascript">
    window.onload = date_time('date_time');
  </script>

</body>

</html>