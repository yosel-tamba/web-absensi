<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Topbar Search -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>
            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <h3 class="mt-2 text-dark" style="font-weight: 700;"><?= $judul ?></h3>
            </form>
            <div class="nav-item dropdown no-arrow d-sm-none">
                <a role="button" aria-haspopup="true" aria-expanded="false">
                    <h4 class="mt-2 text-dark" style="font-weight: 700;"><?= $judul ?></h4>
                </a>
            </div>

            <!-- <h4 class="mt-2 text-dark" style="font-weight: 700;">Virtual - Multiple Skill Laboratory</h4> -->


            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
                <?php $id = $this->session->userdata('id'); ?>

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><i class="fas fa-angle-down me-1"></i> <?= $this->session->userdata('nama') ?></span>
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <?php if ($this->session->userdata('level') == 'Administrator') { ?>
                            <a class="dropdown-item" href="<?= base_url('administrator/pengaturan') ?>">
                                <i class="fas fa-cog fa-fw mr-2 text-gray-400"></i>
                                Settings
                            </a>
                            <div class="dropdown-divider"></div>
                        <?php } ?>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->