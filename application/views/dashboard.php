<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Content Row -->
  <div class="row">

    <!-- Content Column -->
    <div class="col-lg-6 mb-4">
      <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-12 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                    Total Kelas</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_kelas ?></div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-door-closed fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-12 mb-4">
          <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                    Total Siswa</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_siswa ?></div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-users fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-6 col-md-12 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                    Hadir Hari Ini</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $hadir_hari_ini ?></div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-user fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-6 col-md-12 mb-4">
          <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                    Hadir Kemarin</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $hadir_kemarin; ?></div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-clock fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6 mb-3">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Diagram Kehadiran</h6>
          <div class="d-flex justify-content-end">
            <select id="selectOption" class="tambah-buku form-control" data-live-search="true" onchange="updateChart()">
              <?php foreach ($kelas as $kelas_item) : ?>
                <?php
                $where = ['id_jurusan' => $kelas_item->id_jurusan];
                $jurusans = $this->m_crud->edit_data($where, 'tb_jurusan')->result();
                foreach ($jurusans as $ji) : ?>
                  <option value="<?= $kelas_item->id_kelas ?>" data-tokens="<?= $kelas_item->tingkatan ?> <?= $ji->inisial ?> <?= $kelas_item->nama_kelas; ?>" data-id="<?= $kelas_item->id_kelas ?>">
                    <?= $kelas_item->tingkatan ?> <?= $ji->inisial ?> <?= $kelas_item->nama_kelas; ?>
                  </option>
                <?php endforeach; ?>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="card-body d-flex justify-content-center">
          <canvas id="myChart"></canvas>
        </div>
      </div>
    </div>
    <div class="col-lg-12 mb-5">
      <!-- Project Card Example -->
      <div class="card shadow">
        <div class="card-header d-sm-flex align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">
            Aktivitas Kehadiran Siswa Terkini
          </h6>

          <div class="d-flex justify-content-end">
            <!-- Tombol Filter Data -->
            <a class="btn btn-info btn-sm mr-2"
              href="#"
              data-toggle="modal"
              data-target="#FilterDataModal"
              title="Filter">
              <i class="fas fa-filter mr-1"></i> Filter Data
            </a>

            <!-- Tombol Tambah Data -->
            <a class="btn btn-primary btn-sm mr-2"
              href="#"
              data-toggle="modal"
              data-target="#AddDataModal"
              title="Tambah">
              <i class="fas fa-plus mr-1"></i> Tambah Data
            </a>

            <!-- Tombol Hari Libur khusus Administrator -->
            <?php if ($this->session->userdata('level') == 'Administrator') : ?>
              <a class="btn btn-danger btn-sm <?= (empty($hari)) ? 'disabled' : '' ?>"
                href="#"
                data-toggle="modal"
                data-target="#HariLiburModal"
                title="Hari Libur">
                <i class="fa fa-calendar-times mr-1"></i> Hari Libur
              </a>
            <?php endif; ?>
          </div>
        </div>

        <div class="card-body">
          <?php if (empty($hadir)) { ?>
            <div class="alert alert-info text-center" role="alert">
              <b class="mt-2">Tidak Ada Data Kehadiran Hari Ini.</b>
            </div>
          <?php } else { ?>
            <?php if ($this->session->flashdata('success')) : ?>
              <div class="alert alert-success text-center" role="alert">
                <b><?php echo $this->session->flashdata('success'); ?></b>
              </div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('failed')) : ?>
              <div class="alert alert-danger text-center" role="alert">
                <b><?php echo $this->session->flashdata('failed'); ?></b>
              </div>
            <?php endif; ?>
            <div class="table-responsive">
              <table class="display nowrap table table-bordered table-stripped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr class="text-uppercase">
                    <th scope="col">No</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Nama</th>
                    <th scope="col">NIS</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Wali Kelas</th>
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
                      <td class="text-center align-middle"><?= $no++; ?></td>
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
                            $jurusans = $this->m_crud->edit_data($where, 'tb_jurusan')->result();
                            foreach ($jurusans as $j) { ?>
                              <?= $j->inisial; ?>
                            <?php } ?>
                            <?= $data->nama_kelas; ?>
                          </td>
                          <td class="align-middle"><?= $data->wali_kelas; ?></td>
                        <?php } ?>
                      <?php } ?>
                      <td class="align-middle"><?= date('d-m-Y', strtotime($row->tgl_masuk)); ?></td>
                      <td class="align-middle"><?= $row->jam_masuk; ?></td>
                      <td class="align-middle"><?= $row->jam_keluar; ?></td>
                      <td class="align-middle"><?= $row->status; ?></td>
                    </tr>
                  <?php } ?>
                </tbody>
                <thead>
                  <tr class="text-uppercase">
                    <th scope="col">No</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Nama</th>
                    <th scope="col">NIS</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Wali Kelas</th>
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
  </div>
</div>
<!-- /.container-fluid -->

<!-- Filter Data Modal-->
<div class="modal fade" id="FilterDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light text-primary">
        <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Form Filter Kehadiran Siswa</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <?php if ($this->session->userdata('level') == 'Administrator') { ?>
        <?= form_open_multipart('administrator/dashboard/aksi_filter') ?>
      <?php } elseif ($this->session->userdata('level') == 'Wali Kelas') { ?>
        <?= form_open_multipart('wali_kelas/dashboard/aksi_filter') ?>
      <?php } ?>
      <div class="modal-body">
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
        <div class="mb-3" id="status">
          <label for="status" class="form-label">Status</label>
          <select class="custom-select" name="status" id="status">
            <option disabled selected>-- Pilih Status --</option>
            <option class="Hadir">Hadir</option>
            <option class="Sakit">Sakit</option>
            <option class="Izin">Izin</option>
            <option class="Dispen">Dispen</option>
          </select>
        </div>
        <label class="form-label mb-3">Filter Tanggal</label>
        <div class="input-group mb-3 flex-nowrap">
          <div class="input-group-prepend">
            <span class="input-group-text" id="addon-wrapping">Dari</span>
          </div>
          <input type="date" class="form-control" id="dari_tgl" name="dari_tgl" aria-describedby="addon-wrapping" value="<?= date('Y-m-d') ?>">
        </div>
        <div class="input-group flex-nowrap">
          <div class="input-group-prepend">
            <span class="input-group-text" id="addon-wrapping">Sampai</span>
          </div>
          <input type="date" class="form-control" id="sampai_tgl" name="sampai_tgl" aria-describedby="addon-wrapping" value="<?= date('Y-m-d') ?>">
        </div>
      </div>
      <div class="modal-footer bg-light text-primary">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">
          Cancel
        </button>
        <input type="submit" class="btn btn-primary" value="Filter Data">
      </div>
      <?= form_close() ?>
    </div>
  </div>
</div>
<!-- akhir Filter data modal -->

<!-- Add Data Modal-->
<div class="modal fade" id="AddDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light text-primary">
        <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Form Tambah Data Kehadiran</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="display2 nowrap table table-bordered table-stripped" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr class="text-uppercase">
                <th scope="col">Nama</th>
                <th scope="col">Kelas</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($siswa as $row) {
              ?>
                <tr>
                  <td class="align-middle"><?= $row->nama_siswa; ?></td>
                  <?php
                  $where = ['id_kelas' => $row->id_kelas];
                  $datas = $this->m_crud->edit_data($where, 'tb_kelas')->result();
                  foreach ($datas as $data) { ?>
                    <td class="align-middle">
                      <?= $data->tingkatan; ?>
                      <?php
                      $where = ['id_jurusan' => $row->id_jurusan];
                      $jurusans = $this->m_crud->edit_data($where, 'tb_jurusan')->result();
                      foreach ($jurusans as $j) { ?>
                        <?= $j->inisial; ?>
                      <?php } ?>
                      <?= $data->nama_kelas; ?>
                    </td>
                  <?php } ?>
                  <td class="align-middle">
                    <!-- tombol untuk administrator -->
                    <?php if ($this->session->userdata('level') == 'Administrator') : ?>
                      <a class="btn btn-success btn-sm" href="<?= base_url('administrator/dashboard/auth_absensi/Hadir/' . $row->pin); ?>" title="Hadir">Hadir</a>
                      <a class="btn btn-info btn-sm" href="<?= base_url('administrator/dashboard/auth_absensi/Izin/' . $row->pin); ?>" title="Izin">Izin</a>
                      <a class="btn btn-warning btn-sm" href="<?= base_url('administrator/dashboard/auth_absensi/Dispen/' . $row->pin); ?>" title="Dispen">Dispen</a>
                      <a class="btn btn-danger btn-sm" href="<?= base_url('administrator/dashboard/auth_absensi/Sakit/' . $row->pin); ?>" title="Sakit">Sakit</a>
                    <?php endif ?>

                    <!-- tombol untuk Wali Kelas -->
                    <?php if ($this->session->userdata('level') == 'Wali Kelas') : ?>
                      <a class="btn btn-success btn-sm" href="<?= base_url('wali_kelas/dashboard/auth_absensi/Hadir/' . $row->pin); ?>" title="Hadir">Hadir</a>
                      <a class="btn btn-info btn-sm" href="<?= base_url('wali_kelas/dashboard/auth_absensi/Izin/' . $row->pin); ?>" title="Izin">Izin</a>
                      <a class="btn btn-warning btn-sm" href="<?= base_url('wali_kelas/dashboard/auth_absensi/Dispen/' . $row->pin); ?>" title="Dispen">Dispen</a>
                      <a class="btn btn-danger btn-sm" href="<?= base_url('wali_kelas/dashboard/auth_absensi/Sakit/' . $row->pin); ?>" title="Sakit">Sakit</a>
                    <?php endif ?>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
            <thead>
              <tr class="text-uppercase">
                <th scope="col">Nama</th>
                <th scope="col">Kelas</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
      <div class="modal-footer bg-light text-primary">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">
          Cancel
        </button>
      </div>
    </div>
  </div>
</div>
<!-- akhir add data modal -->

<!-- Modal Libur Sekolah-->
<div class="modal fade" id="HariLiburModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light text-primary">
        <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Yakin Meliburkan Absensi?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body text-center">
        Anda akan menghapus absensi tanggal <b><?= date('d-m-Y') ?></b>, karena akan menjadi hari libur<br>
        <h3 class="font-weight-bold font-italic mt-2"></h3>
        <hr>
        <div class="mt-3">
          <i class="text-danger"> Tekan tombol <strong>Liburkan</strong> untuk memulai absensi</i>
        </div>
      </div>
      <div class="modal-footer bg-light text-primary">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">
          Cancel
        </button>
        <a href="<?= base_url('administrator/dashboard/hari_libur') ?>" class="btn btn-danger" title="Mulai">Liburkan</a>
      </div>
    </div>
  </div>
</div>
<!-- akhir Modal Libur Sekolah -->