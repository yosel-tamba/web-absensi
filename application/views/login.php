<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Form login | Absenin</title>

    <!-- Custom fonts for this template-->
    
  <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
  <link href="<?= base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/templates/sb-admin-2.min.css" rel="stylesheet" />
  </head>

  <body class="bg-gradient-primary">
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
                    }
                    ?>
    <div class="container">
      <!-- Outer Row -->
      <div class="row justify-content-center">
        <div class="col-lg-12 mt-4 text-center">
          <h3 class="text-light">Selamat Datang Kembali !</h3>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="card o-hidden border-0 shadow-lg my-lg-5 my-0">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">
                Absen siswa terkini
              </h6>
            </div>
            <div class="card-body p-4">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">NIP</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Kelas</th>
                      <th scope="col">Waktu Absensi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>632230001</td>
                      <td>John Doe</td>
                      <td>1A</td>
                      <td>12/02/2023 14:00:00</td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td>632230002</td>
                      <td>Jane Doe</td>
                      <td>1A</td>
                      <td>12/02/2023 14:02:10</td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td>632230003</td>
                      <td>Walter H. White</td>
                      <td>1A</td>
                      <td>12/02/2023 14:06:50</td>
                    </tr>
                    <tr>
                      <th scope="row">4</th>
                      <td>632230004</td>
                      <td>Jimmy McGill</td>
                      <td>1A</td>
                      <td>12/02/2023 14:06:59</td>
                    </tr>
                    <tr>
                      <th scope="row">5</th>
                      <td>632230005</td>
                      <td>Christopher Nolan</td>
                      <td>1A</td>
                      <td>12/02/2023 14:06:59</td>
                    </tr>
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
                    <form class="user" method="post" action="<?= base_url('login/ceklogin') ?>">
                      <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Masukan Username" autocomplete="off" autofocus required />
                      </div>
                      <div class="form-group">
                        <input type="password" class="form-control form-control-user" id="password" name="password"     placeholder="Password" autocomplete="off" required />
                      </div>
                      <input type="submit" class="btn btn-primary btn-user btn-block" value="Masuk">
                      <hr />
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
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/templates/sb-admin-2.min.js"></script>
  </body>
</html>
