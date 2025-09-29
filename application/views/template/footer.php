</div>
<!-- End of Main Content -->
<!-- Footer -->
<footer class="sticky-footer bg-white">
    <?php
    $footer = $this->m_crud->get_data('id_footer', 'footer')->result();
    ?>
    <div class="container px-5 text-dark">
        <?php if ($judul == "Pengaturan" && $this->session->userdata('level') == "Administrator") : ?>
            <a href="#" data-toggle="modal" data-target="#editFooterModal" class="btn btn-warning btn-sm mb-1" title="Ubah"><i class="fas fa-pen mr-1"></i> Ubah Footer</a>
        <?php endif; ?>
        <hr>
        <?php foreach ($footer as $f) : ?>
            <table>
                <tr>
                    <td class="align-middle">
                        <?php if (!empty($f->icon)) : ?>
                            <img src="<?= base_url('assets/images/' . $f->icon) ?>" class="my-2" width="100px">
                        <?php endif; ?>

                        <p class="mr-5">
                            <?php if (!empty($f->nama)) echo $f->nama . '<br>'; ?>
                            <?php if (!empty($f->alamat)) echo nl2br($f->alamat); ?>
                        </p>
                    </td>
                    <td class="align-middle">
                        <p class="mb-2 ml-2 font-weight-bold">
                            <a href="#" class="text-dark" data-toggle="modal" data-target="#TentangDataModal">
                                <i class="fas fa-info-circle"></i> Tentang Kami
                            </a>
                        </p>

                        <?php if (!empty($f->whatsapp)) : ?>
                            <p class="mb-2 ml-2 font-weight-bold">
                                <a href="https://api.whatsapp.com/send?phone=<?= $f->whatsapp ?>" target="_blank" class="text-dark">
                                    <i class="fab fa-whatsapp"></i> WhatsApp
                                </a>
                            </p>
                        <?php endif; ?>

                        <?php if (!empty($f->tiktok)) : ?>
                            <p class="mb-2 ml-2 font-weight-bold">
                                <a href="<?= $f->tiktok ?>" target="_blank" class="text-dark">
                                    <i class="fab fa-tiktok"></i> TikTok
                                </a>
                            </p>
                        <?php endif; ?>

                        <?php if (!empty($f->instagram)) : ?>
                            <p class="mb-2 ml-2 font-weight-bold">
                                <a href="<?= $f->instagram ?>" target="_blank" class="text-dark">
                                    <i class="fab fa-instagram"></i> Instagram
                                </a>
                            </p>
                        <?php endif; ?>

                        <?php if (!empty($f->facebook)) : ?>
                            <p class="mb-2 ml-2 font-weight-bold">
                                <a href="<?= $f->facebook ?>" target="_blank" class="text-dark">
                                    <i class="fab fa-facebook-f"></i> Facebook
                                </a>
                            </p>
                        <?php endif; ?>

                    </td>
                </tr>
            </table>
            <hr>
            <?php if (!empty($f->copyright)) : ?>
                <p class="ml-2">
                   <b> &#169; <?= $f->copyright ?></b>
                </p>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- show preview image -->
<script type="text/javascript">
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
    };
</script>

<?php foreach ($footer as $f) : ?>
    <!-- Tentang Modal -->
    <div class="modal fade" id="TentangDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light text-primary">
                    <h5 class="modal-title font-weight-bold" id="exampleModalLabel">
                        Tentang <?= !empty($f->nama) ? $f->nama : 'Perusahaan Kami' ?>
                    </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php if (!empty($f->icon)) : ?>
                        <div class="d-flex justify-content-center mb-3">
                            <img src="<?= base_url('assets/images/' . $f->icon) ?>" width="150px">
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($f->deskripsi_developer)) : ?>
                        <p class="text-center"><?= $f->deskripsi_developer ?></p>
                    <?php else : ?>
                        <p class="text-center text-muted">Belum ada informasi tentang perusahaan.</p>
                    <?php endif; ?>
                </div>
                <div class="modal-footer bg-light text-primary">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Akhir Tentang Modal -->
<?php endforeach; ?>

<!-- footer edit modal -->
<?php if ($judul == "Pengaturan" && $this->session->userdata('level') == "Administrator") : ?>
    <?php foreach ($footer as $f) : ?>
        <div class="modal fade" id="editFooterModal" tabindex="-1" role="dialog" aria-labelledby="editFooterLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <form action="<?= base_url('footer/aksi_update') ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_footer" value="<?= $f->id_footer ?>">
                    <div class="modal-content">
                        <div class="modal-header bg-light text-primary">
                            <h5 class="modal-title font-weight-bold" id="editFooterLabel">Edit Footer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" name="nama" class="form-control" value="<?= $f->nama ?>">
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea name="alamat" class="form-control" rows="4"><?= $f->alamat ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi Developer</label>
                                    <textarea name="deskripsi_developer" class="form-control" rows="6"><?= $f->deskripsi_developer ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Copyright</label>
                                    <input type="text" name="copyright" class="form-control" value="<?= $f->copyright ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>WhatsApp</label>
                                    <input type="text" name="whatsapp" class="form-control" value="<?= $f->whatsapp ?>">
                                </div>
                                <div class="form-group">
                                    <label>TikTok</label>
                                    <input type="text" name="tiktok" class="form-control" value="<?= $f->tiktok ?>">
                                </div>
                                <div class="form-group">
                                    <label>Instagram</label>
                                    <input type="text" name="instagram" class="form-control" value="<?= $f->instagram ?>">
                                </div>
                                <div class="form-group">
                                    <label>Facebook</label>
                                    <input type="text" name="facebook" class="form-control" value="<?= $f->facebook ?>">
                                </div>
                                <div class="form-group">
                                    <label>Icon (gambar)</label><br>
                                    <?php if (!empty($f->icon)) : ?>
                                        <img src="<?= base_url('assets/images/' . $f->icon) ?>" width="80" class="mb-2"><br>
                                    <?php endif; ?>
                                    <input type="file" name="icon" class="form-control-file">
                                    <input type="hidden" name="icon_old" value="<?= $f->icon ?>">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-light">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif ?>

<!-- end footer edit modal -->

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light text-primary">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Tekan tombol <strong>Logout</strong> jika anda ingin meninggalkan keluar/menutup aplikasi.
            </div>
            <div class="modal-footer bg-light text-primary">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">
                    Cancel
                </button>
                <a class="btn btn-danger" href="<?= base_url('login/keluar') ?>">Logout</a>
            </div>
        </div>
    </div>
</div>
<!-- akhir logout modal -->

<!-- Chain dropdown jurusan -> kelas -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha512-+NqPlbbtM1QqiK8ZAo4Yrj2c4lNQoGv8P79DPtKzj++l5jnN39rHA/xsqn8zE9l0uSoxaCdrOgFs6yjyfbBxSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {

        $("#id_jurusan").change(function() {
            $("#id_kelas").val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url("index.php/listKelas"); ?>",
                data: {
                    id_jurusan: $("#id_jurusan").val()
                },
                dataType: "json",
                beforeSend: function(e) {
                    if (e && e.overrideMimeType) {
                        e.overrideMimeType("application/json;charset=UTF-8");
                    }
                },
                success: function(response) {
                    $("#id_kelas").html(response.list_kelas).show();
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
    });
</script>


<script>
    $(document).ready(function() {
        $('table.display2').DataTable();
    });
</script>
<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/sbadmin/vendor/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

<!-- bootstrap select-->
<script src="<?= base_url('assets/bootstrap-select/dist/js/bootstrap-select.min.js') ?>"></script>
<script>
    $('.tambah-buku').selectpicker();
    $('.tambah-peminjam').selectpicker();
    $('.ubah-buku').selectpicker();
    $('.ubah-peminjam').selectpicker();
</script>

<!-- chart -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data untuk diagram
    var dataSets = {};
    var myChart;

    async function updateChart() {
        var selectElement = document.getElementById('selectOption');
        var selectedId = selectElement.value;
        var selectedOption = selectElement.options[selectElement.selectedIndex];

        try {
            var dataForSelectedId = await getDataForId(selectedId);

            dataSets[selectedOption.dataset.id] = dataForSelectedId;

            if (myChart) {
                myChart.destroy();
            }

            var selectedOption = document.getElementById('selectOption').value;
            var ctx = document.getElementById('myChart').getContext('2d');

            myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Hadir', 'Sakit', 'Izin', 'Dispen', 'Alpha'],
                    datasets: [{
                        data: dataSets[selectedOption],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)', // Warna untuk batang pertama
                            'rgba(255, 99, 132, 0.2)', // Warna untuk batang kedua
                            'rgba(54, 162, 235, 0.2)', // Warna untuk batang ketiga
                            'rgba(255, 206, 86, 0.2)', // Warna untuk batang keempat
                            'rgba(153, 102, 255, 0.2)', // Warna untuk batang kelima
                            'rgba(255, 159, 64, 0.2)', // Warna untuk batang keenam
                            'rgba(0, 255, 0, 0.2)', // Warna untuk batang ketujuh
                            'rgba(255, 0, 0, 0.2)', // Warna untuk batang kedelapan
                            'rgba(0, 0, 255, 0.2)', // Warna untuk batang kesembilan
                            'rgba(128, 128, 128, 0.2)' // Warna untuk batang kesepuluh
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(0, 255, 0, 1)',
                            'rgba(255, 0, 0, 1)',
                            'rgba(0, 0, 255, 1)',
                            'rgba(128, 128, 128, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            position: "bottom",
                        }
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {}
                }
            });
        } catch (error) {
            console.error(error);
            return;
        }
    }

    function getDataForId(id) {
        return new Promise(function(resolve, reject) {
            $.ajax({
                url: '<?= base_url('Listkelas/getDataForDiagram') ?>', // Sesuaikan dengan alamat URL yang sesuai
                method: 'GET',
                data: {
                    id_kelas: id
                },
                dataType: 'json',
                success: function(response) {
                    if (response) {
                        resolve([
                            response.hadir,
                            response.sakit,
                            response.izin,
                            response.dispen,
                            response.alpha
                        ]);
                    } else {
                        reject(new Error('Invalid response from server'));
                    }
                },
                error: function() {
                    reject(new Error('Error fetching data from server'));
                }
            });
        });
    }
    window.onload = function() {
        updateChart();
    };
</script>
<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/sbadmin/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/sbadmin/js/sb-admin-2.min.js') ?>"></script>
<!-- Data Table -->
<script src="<?= base_url('assets/sbadmin/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/sbadmin/vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/sbadmin/js/demo/datatables-demo.js') ?>"></script>

</body>

</html>