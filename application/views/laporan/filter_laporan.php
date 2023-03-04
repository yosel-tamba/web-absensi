<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-12 mb-4">

            <div class="row">

                <!-- card -->
                <div class="col-lg-12">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between">
                            <h4 class="my-auto font-weight-bold text-primary">Data laporan kehadiran</h4>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST" class="w-50 user needs-validation mx-3 mb-4">
                                <h5>Prensensi diselesaikan dalam jangka waktu</h5>
                                <div class="form-group">
                                    <label class="control-label text-primary">Dari</label>
                                    <input type="date" class="form-control" name="dari" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label text-primary">Sampai</label>
                                    <input type="date" class="form-control" name="sampai" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label text-primary">Jurusan</label>
                                    <select name="jurusan" id="jurusan" class="form-control">
                                        <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                                        <option value="Teknik Bisnis Sepeda Motor">Teknik Bisnis Sepeda Motor</option>
                                        <option value="Teknik Kendaraan Ringan Otomotif">Teknik Kendaraan Ringan Otomotif</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label text-primary">Kelas</label>
                                    <select name="kelas" id="kelas" class="form-control">
                                        <option value="X RPL 1">X RPL 1</option>
                                        <option value="X RPL 2">X RPL 2</option>
                                        <option value="X RPL 3">X RPL 3</option>
                                    </select>
                                </div>
                                <button type="submit" class="flex-fill btn btn-primary btn-user px-4">Search</button>
                            </form>
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