<!-- Begin Page Content -->
<div class="container-fluid">


    <!-- Content Row -->


    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <?php if ($this->session->userdata('level') == 'Administrator') { ?>
            <div class="col-lg-12 mb-5">
                <!-- Project Card Example -->
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Selamat Datang di Dashboard Administrator</h6>
                    </div>
                    <div class="card-body">
                        Disini Anda dapat melakukan monitoring dan pengolahan data Absensi siswa. <br> Menu yang diberikan yaitu, Master Data (Data Guru, Data Siswa), Menu Rekap/Laporan. <br> Untuk menjaga keamanan diharapkan anda meng-klik Menu Log Out jika akan keluar dan menutup aplikasi ini.

                    </div>
                </div>

            </div>
        <?php }  ?>
        <?php if ($this->session->userdata('level') == 'Guru') { ?>
            <div class="col-lg-12 mb-5">
                <!-- Project Card Example -->
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Selamat Datang di Dashboard Guru</h6>
                    </div>
                    <div class="card-body">
                        Disini Anda dapat melakukan pengolahan data hasil ujian. <br> Menu yang diberikan yaitu, Menu Penilaian, Menu untuk Membuat soal, Menu Laporan, dll. <br> Untuk menjaga keamanan diharapkan anda meng-klik Menu Log Out jika akan keluar dan menutup aplikasi ini.
                    </div>
                </div>

            </div>
        <?php }  ?>
        <div class="col-lg-12 mb-5">
                <!-- Project Card Example -->
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Aktivitas Absensi Siswa Terkini</h6>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>NIS</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Status</th>
                                        <th>Waktu Absensi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                      <th>NIP</th>
                                      <th>Nama</th>
                                      <th>Kelas</th>
                                      <th>Status</th>
                                      <th>Waktu Absensi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <tr>
                                        <td>632330024</td>
                                        <td>Jonathan Doe</td>
                                        <td>1A</td>
                                        <td class="text-success">Aktif</td>
                                        <td>02/03/23 14:00:00</td>
                                    </tr>
                                    <tr>
                                        <td>632330025</td>
                                        <td>Jennifer Doe</td>
                                        <td>1A</td>
                                        <td class="text-success">Aktif</td>
                                        <td>02/03/23 14:02:06</td>
                                    </tr>
                                    <tr>
                                        <td>632330026</td>
                                        <td>Walter H. White</td>
                                        <td>1A</td>
                                        <td class="text-success">Aktif</td>
                                        <td>02/03/23 14:02:50</td>
                                    </tr>
                                    <tr>
                                        <td>632330027</td>
                                        <td>Gustavo Fring</td>
                                        <td>1A</td>
                                        <td class="text-success">Aktif</td>
                                        <td>02/03/23 14:03:40</td>
                                    </tr>
                                  </tbody>
                                </table>
                                </div>
                    </div>
                </div>

            </div>     
    </div>
</div>
<!-- /.container-fluid -->