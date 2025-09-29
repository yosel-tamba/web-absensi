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
  <link href="<?= base_url('assets/sbadmin/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
  <link href="<?= base_url('assets/sbadmin/vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/sbadmin/css/sb-admin-2.min.css') ?>" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <link href="<?= base_url('assets/bootstrap-select/dist/css/bootstrap-select.min.css') ?>" rel="stylesheet">

  <?php
  $sekolah = $this->m_crud->get_data('id_sekolah', 'tb_sekolah')->result();
  foreach ($sekolah as $key) {
    if ($key->foto_sekolah != 'sekolah.png') { ?>
      <link rel="icon" href="<?= base_url('assets/images/') . $key->foto_sekolah ?>">
  <?php }
  } ?>

  <!-- Custom styles for this template-->
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

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <?php if ($this->session->userdata('level') == 'Administrator') { ?>
          <i class="fas fa-fw fa-user-cog"></i>
          <div class="sidebar-brand-text mx-1"> Administrator</div>
        <?php } else if ($this->session->userdata('level') == 'Wali Kelas') { ?>
          <i class="fas fa-fw fa-user"></i>
          <div class="sidebar-brand-text mx-1"> Wali Kelas</div>
        <?php } ?>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-2" />
      <!-- Heading -->
      <div class="sidebar-heading text-center text-uppercase">menu utama</div>
      <!-- Divider -->
      <hr class="sidebar-divider my-2" />

      <?php if ($this->session->userdata('level') == 'Administrator') { ?>

        <li class="nav-item <?= $judul == 'Dashboard' ? 'active' : null ?>">
          <a class="nav-link" href="<?= base_url('administrator/dashboard') ?>">
            <i class="fa fa-home" aria-hidden="true"></i>
            <span>Dashboard</span></a>
        </li>

        <li class="nav-item <?= $judul == 'Pengguna' ? 'active' : null ?>">
          <a class="nav-link" href="<?= base_url('administrator/pengguna') ?>">
            <i class="fa fa-users" aria-hidden="true"></i>
            <span>Data Pengguna</span></a>
        </li>


        <li class="nav-item <?= $judul == 'Siswa' ? 'active' : null ?>">
          <a class="nav-link" href="<?= base_url('administrator/siswa') ?>">
            <i class="fa fa-graduation-cap" aria-hidden="true"></i>
            <span>Data Siswa</span></a>
        </li>

        <li class="nav-item <?= $judul == 'Jurusan' ? 'active' : null ?>">
          <a class="nav-link" href="<?= base_url('administrator/jurusan') ?>">
            <i class="fa fa-tasks" aria-hidden="true"></i>
            <span>Data Jurusan</span></a>
        </li>

        <li class="nav-item <?= $judul == 'Kelas' ? 'active' : null ?>">
          <a class="nav-link" href="<?= base_url('administrator/kelas') ?>">
            <i class="fa fa-book" aria-hidden="true"></i>
            <span>Data Kelas</span></a>
        </li>

        <li class="nav-item <?= $judul == 'Laporan' ? 'active' : null ?>">
          <a class="nav-link" href="<?= base_url('administrator/laporan') ?>">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Laporan Kehadiran</span></a>
        </li>

      <?php } ?>

      <?php if ($this->session->userdata('level') == 'Wali Kelas') { ?>

        <li class="nav-item <?= $judul == 'Dashboard' ? 'active' : null ?>">
          <a class="nav-link" href="<?= base_url('wali_kelas/dashboard') ?>">
            <i class="fa fa-home" aria-hidden="true"></i>
            <span>Dashboard</span></a>
        </li>

        <li class="nav-item <?= $judul == 'Laporan' ? 'active' : null ?>">
          <a class="nav-link" href="<?= base_url('wali_kelas/laporan') ?>">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Laporan Kehadiran</span></a>
        </li>

      <?php } ?>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block" />

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>
    <!-- End of Sidebar -->