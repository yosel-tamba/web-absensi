<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?= $judul ?> | ABSENSI KEHADIRAN</title>
  <!-- Custom fonts for this template-->
  <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
  <link href="<?= base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


  <!-- <script src="<?= base_url('assets/sbadmin/vendor/jquery/jquery.min.js') ?>"></script> -->

  <script>
    $(document).ready(function() {
      $('table.display').DataTable();
    });
  </script>

  <!-- Custom styles for this template-->
  <style>
    ::-webkit-scrollbar {
      width: 15px;
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

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <i class="fas fa-fw fa-user-cog"></i>
        <div class="sidebar-brand-text mx-1"> Administrator</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-2" />
      <!-- Heading -->
      <div class="sidebar-heading text-center text-uppercase">menu utama</div>
      <!-- Divider -->
      <hr class="sidebar-divider my-2" />

      <!-- Nav Item - Dashboard -->
      <li class="nav-item <?= $judul == 'Dashboard' ? 'active' : null ?>">
        <a class="nav-link" href="<?= base_url('administrator/dashboard') ?>">
          <i class="fa fa-home" aria-hidden="true"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <!-- <li class="nav-item">
          <a
            class="nav-link collapsed"
            href="#"
            data-toggle="collapse"
            data-target="#collapseTwo"
            aria-expanded="true"
            aria-controls="collapseTwo"
          >
            <i class="fa fa-folder-open" aria-hidden="true"></i>
            <span>Data umum</span>
          </a>
          <div
            id="collapseTwo"
            class="collapse"
            aria-labelledby="headingTwo"
            data-parent="#accordionSidebar"
          >
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Custom Components:</h6>
              <a class="collapse-item" href="buttons.html">Buttons</a>
              <a class="collapse-item" href="cards.html">Cards</a>
            </div>
          </div>
        </li> -->

      <!-- Nav Item - Utilities Collapse Menu -->
      <!-- <li class="nav-item">
          <a
            class="nav-link collapsed"
            href="#"
            data-toggle="collapse"
            data-target="#collapseUtilities"
            aria-expanded="true"
            aria-controls="collapseUtilities"
          >
            <i class="fa fa-calendar" aria-hidden="true"></i>
            <span>Jadwal mengajar</span>
          </a>
          <div
            id="collapseUtilities"
            class="collapse"
            aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar"
          >
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Custom Utilities:</h6>
              <a class="collapse-item" href="utilities-color.html">Colors</a>
              <a class="collapse-item" href="utilities-border.html">Borders</a>
              <a class="collapse-item" href="utilities-animation.html"
                >Animations</a
              >
              <a class="collapse-item" href="utilities-other.html">Other</a>
            </div>
          </div>
        </li> -->

      <!-- Nav Item - Pages Collapse Menu -->
      <!-- <li class="nav-item">
          <a
            class="nav-link collapsed"
            href="#"
            data-toggle="collapse"
            data-target="#collapsePages"
            aria-expanded="true"
            aria-controls="collapsePages"
          >
            <i class="fa fa-graduation-cap" aria-hidden="true"></i>
            <span>Data Rektor</span>
          </a>
          <div
            id="collapsePages"
            class="collapse"
            aria-labelledby="headingPages"
            data-parent="#accordionSidebar"
          >
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Login Screens:</h6>
              <a class="collapse-item" href="login.html">Login</a>
              <a class="collapse-item" href="register.html">Register</a>
              <a class="collapse-item" href="forgot-password.html"
                >Forgot Password</a
              >
              <div class="collapse-divider"></div>
            </div>
          </div>
        </li> -->

      <!-- Nav Item - Charts -->
      <li class="nav-item <?= $judul == 'Pengguna' ? 'active' : null ?>">
        <a class="nav-link" href="<?= base_url('administrator/guru') ?>">
          <i class="fa fa-users" aria-hidden="true"></i>
          <span>Data Pengguna</span></a>
      </li>


      <li class="nav-item <?= $judul == 'Siswa' ? 'active' : null ?>">
        <a class="nav-link" href="<?= base_url('administrator/siswa') ?>">
          <i class="fa fa-user" aria-hidden="true"></i>
          <span>Data Siswa</span></a>
      </li>

      <li class="nav-item <?= $judul == 'Jurusan' ? 'active' : null ?>">
        <a class="nav-link" href="<?= base_url('administrator/siswa') ?>">
          <i class="fa fa-user" aria-hidden="true"></i>
          <span>Data Jurusan</span></a>
      </li>

      <li class="nav-item <?= $judul == 'Kelas' ? 'active' : null ?>">
        <a class="nav-link" href="<?= base_url('administrator/siswa') ?>">
          <i class="fa fa-user" aria-hidden="true"></i>
          <span>Data Kelas</span></a>
      </li>

      <li class="nav-item <?= $judul == 'Laporan' ? 'active' : null ?>">
        <a class="nav-link" href="<?= base_url('administrator/siswa') ?>">
          <i class="fa fa-user" aria-hidden="true"></i>
          <span>Laporan Kehadiran</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block" />

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>
    <!-- End of Sidebar -->