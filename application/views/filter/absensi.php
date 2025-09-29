<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12 mb-5">
            <!-- Project Card Example -->
            <div class="card shadow">
                <div class="card-header d-sm-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Aktivitas Absensi Siswa Terkini</h6>
                    <div class="d-flex justify-content-end">
                        <?php if ($this->session->userdata('level') == 'Administrator') { ?>
                            <a class="btn btn-secondary btn-sm mr-1" href="<?= base_url('administrator/dashboard') ?>" title="Kembali"><i class="fas fa-arrow-left"></i> Kembali</a>
                            <a class="btn btn-success btn-sm" href="<?= base_url('administrator/dashboard/excel/' . $id_jurusan . '/' . $id_kelas . '/' . $dari_tgl . '/' . $sampai_tgl . '/' . $status) ?>" title="Unduh"><i class="fa fa-download"></i> Unduh Data</a>
                        <?php } ?>
                        <?php if ($this->session->userdata('level') == 'Wali Kelas') { ?>
                            <a class="btn btn-secondary btn-sm mr-2" href="<?= base_url('wali_kelas/dashboard') ?>" title="Kembali"><i class="fas fa-arrow-left"></i> Kembali</a>
                            <a class="btn btn-success btn-sm" href="<?= base_url('wali_kelas/dashboard/excel/' . $id_jurusan . '/' . $id_kelas . '/' . $dari_tgl . '/' . $sampai_tgl . '/' . $status) ?>" title="Unduh"><i class="fa fa-download"></i> Unduh Data</a>
                        <?php } ?>
                    </div>
                </div>
                <div class="card-body">
                    <?php if (!empty($pesan)) : ?>
                        <div class="alert alert-info text-center" role="alert">
                            <b><?= $pesan; ?></b>
                        </div>
                    <?php endif; ?>
                    <?php if (empty($hadir)) { ?>
                        <div class="alert alert-info text-center" role="alert">
                            <b class="mt-2">Tidak Ada Data Absensi Pada Tanggal <?= $dari_tgl ?> Sampai Tanggal <?= $sampai_tgl ?> .</b>
                        </div>
                    <?php } else { ?>
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
                                                        $jurusan = $this->m_crud->edit_data($where, 'tb_jurusan')->result();
                                                        foreach ($jurusan as $j) { ?>
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