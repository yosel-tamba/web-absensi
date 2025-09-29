<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Laporan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('m_data');
        $this->load->model('m_crud');

        if ($this->session->userdata('status') != "telah_login") {
            $this->session->set_flashdata('failed_d', 'Anda Harus Login Terlebih Dahulu!');
            redirect(base_url());
        } else if ($this->session->userdata('level') != "Administrator") {
            $this->session->set_flashdata('failed_d', 'Anda Bukan Administrator!');
            redirect(base_url());
        }

        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data = array(
            'judul' => "Laporan"
        );

        $data['siswa'] = $this->m_crud->get_data('id_siswa', 'tb_siswa')->result();
        $data['jurusan'] = $this->m_crud->get_data('id_jurusan', 'tb_jurusan')->result();
        $data['hari'] = $this->m_crud->get_data('id_hari', 'tb_hari')->num_rows();

        $this->load->view('template/sidebar', $data);
        $this->load->view('template/header');
        $this->load->view('laporan/index', $data);
        $this->load->view('template/footer');
    }

    public function tambah_kehadiran()
    {
        // rules for form validation
        $this->form_validation->set_rules('tgl_masuk', 'Tanggal', 'required|trim');
        $this->form_validation->set_rules('jam_masuk', 'Jam Masuk', 'required|trim');
        $this->form_validation->set_rules('jam_keluar', 'Jam Keluar', 'required|trim');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');

        // jika validasi form gagal
        $id_siswa = $this->input->post('id_siswa');
        if ($this->form_validation->run() != false) {
            // tangkap setiap data yang dikirim
            $tgl_masuk = $this->input->post('tgl_masuk');
            $jam_masuk = $this->input->post('jam_masuk');
            $jam_keluar = $this->input->post('jam_keluar');
            $status = $this->input->post('status');

            $data = [
                'id_siswa' => $id_siswa,
                'tgl_masuk' => $tgl_masuk,
                'jam_masuk' => $jam_masuk,
                'jam_keluar' => $jam_keluar,
                'status' => $status,
                'status_data' => "on"
            ];

            $this->m_crud->insert_data($data, 'tb_hadir');
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan.');
        } else {
            $this->session->set_flashdata('failed', validation_errors());
        }
        redirect(base_url() . 'administrator/laporan/detail/' . $id_siswa);
    }

    public function ubah_kehadiran()
    {
        // rules for form validation
        $this->form_validation->set_rules('tgl_masuk', 'Tanggal', 'required|trim');
        $this->form_validation->set_rules('jam_masuk', 'Jam Masuk', 'required|trim');
        $this->form_validation->set_rules('jam_keluar', 'Jam Keluar', 'required|trim');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');

        // jika validasi form gagal
        $id_siswa = $this->input->post('id_siswa');
        if ($this->form_validation->run() != false) {
            // tangkap setiap data yang dikirim
            $tgl_masuk = $this->input->post('tgl_masuk');
            $jam_masuk = $this->input->post('jam_masuk');
            $jam_keluar = $this->input->post('jam_keluar');
            $status = $this->input->post('status');
            $id_hadir = $this->input->post('id_hadir');

            $data = [
                'id_siswa' => $id_siswa,
                'tgl_masuk' => $tgl_masuk,
                'jam_masuk' => $jam_masuk,
                'jam_keluar' => $jam_keluar,
                'status' => $status
            ];

            $where = [
                'id_hadir' => $id_hadir
            ];

            $this->m_crud->update_data($where, $data, 'tb_hadir');
            $this->session->set_flashdata('success', 'Data berhasil diubah.');
        } else {
            $this->session->set_flashdata('failed', validation_errors());
        }
        redirect(base_url() . 'administrator/laporan/detail/' . $id_siswa);
    }

    public function hapus_kehadiran($id_hadir, $id_siswa)
    {
        $where = array(
            'id_hadir' => $id_hadir
        );
        $this->m_crud->delete_data($where, 'tb_hadir');
        $this->session->set_flashdata('success', 'Data berhasil dihapus.');
        redirect(base_url() . 'administrator/laporan/detail/' . $id_siswa);
    }

    public function detail($id_siswa)
    {
        $where = array(
            'id_siswa' => $id_siswa,
        );

        $data = array(
            'judul' => "Detail Laporan Kehadiran"
        );

        $data['siswa'] = $this->m_crud->edit_data($where, 'tb_siswa')->result();
        $data['hadir'] = $this->m_crud->edit_data($where, 'tb_hadir')->result();
        // var_dump($data['hadir']);
        // die;
        $data['hari'] = $this->m_crud->get_data('id_hari', 'tb_hari')->num_rows();

        $this->load->view('template/sidebar', $data);
        $this->load->view('template/header');
        $this->load->view('laporan/detail_kehadiran', $data);
        $this->load->view('template/footer');
    }

    public function aksi_filter()
    {
        // rules for form validation
        $this->form_validation->set_rules('dari_tgl', 'Dari Tanggal', 'required|trim');
        $this->form_validation->set_rules('sampai_tgl', 'Sampai Tanggal', 'required|trim');

        // jika validasi form gagal
        if ($this->form_validation->run() != false) {
            // tangkap setiap data yang dikirim
            $id_kelas = $this->input->post('id_kelas');
            $status = $this->input->post('status');
            $id_jurusan = $this->input->post('id_jurusan');
            $dari_tgl = $this->input->post('dari_tgl');
            $sampai_tgl = $this->input->post('sampai_tgl');

            if (empty($id_jurusan)) {
                $id_jurusan = 'kosong';
            }

            if (empty($id_kelas)) {
                $id_kelas = 'kosong';
            }

            if (empty($status)) {
                $status = 'kosong';
            }
            //mengalihkan halaman
            redirect(base_url('administrator/laporan/hasil_filter/'  . $id_jurusan . '/' . $id_kelas . '/' . $dari_tgl . '/' . $sampai_tgl . '/' . $status));
        } else {
            $this->session->set_flashdata('failed', validation_errors());
            redirect(base_url() . 'administrator/laporan');
        }
    }

    public function hasil_filter($id_jurusan, $id_kelas, $dari_tgl, $sampai_tgl, $status)
    {
        $data = array(
            'judul' => "Laporan",
            'pesan' => 'Data di Filter Dari Tanggal ' . $dari_tgl . ' Sampai Tanggal  ' . $sampai_tgl,
            'id_jurusan' => $id_jurusan,
            'status' => $status,
            'id_kelas' => $id_kelas,
            'dari_tgl' => $dari_tgl,
            'sampai_tgl' => $sampai_tgl
        );

        $data['hadir'] = $this->m_data->filter_laporan($id_jurusan, $id_kelas, $dari_tgl, $sampai_tgl, $status)->result();
        $data['hari'] = $this->m_crud->get_data('id_hari', 'tb_hari')->num_rows();

        $data['jurusan'] = $this->m_crud->get_data('id_jurusan', 'tb_jurusan')->result();

        $this->load->view('template/sidebar', $data);
        $this->load->view('template/header');
        $this->load->view('filter/laporan', $data);
        $this->load->view('template/footer');
    }

    public function excel($id_jurusan, $id_kelas, $dari_tgl, $sampai_tgl, $status)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = [
            'font' => ['bold' => true], // Set font nya jadi bold
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];
        $sheet->setCellValue('B1', "Data Kehadiran Siswa");
        $sheet->mergeCells('B1:F1');
        $sheet->getStyle('B1')->getFont()->setBold(true);
        $sheet->setCellValue('B3', "Dari Tanggal : " . $dari_tgl . "");
        $sheet->mergeCells('B3:C3');
        $sheet->getStyle('B3')->getFont()->setBold(true);
        $sheet->setCellValue('B4', "Sampai Tanggal : " . $sampai_tgl . "");
        $sheet->mergeCells('B4:C4');
        $sheet->getStyle('B4')->getFont()->setBold(true);
        $sheet->setCellValue('D3', "Status : " . ($status == 'kosong' ? '-' : $status));
        $sheet->mergeCells('D3:E3');
        $sheet->getStyle('D3')->getFont()->setBold(true);
        // Buat header tabel nya pada baris ke 3
        $sheet->setCellValue('B6', "No"); // Set kolom A6 dengan tulisan "No"
        $sheet->setCellValue('C6', "Siswa"); // Set kolom B6 dengan tulisan "Mahasiswa"
        $sheet->setCellValue('D6', "NIS"); // Set kolom C6 dengan tulisan "Kelas"
        $sheet->setCellValue('E6', "Kelas"); // Set kolom D6 dengan tulisan "Sekolah"
        $sheet->setCellValue('F6', "Wali Kelas"); // Set kolom E6 dengan tulisan "Modul"
        $sheet->setCellValue('G6', "Hadir"); // Set kolom F6 dengan tulisan "Tanggal"
        $sheet->setCellValue('H6', "Sakit"); // Set kolom G6 dengan tulisan "Nilai"
        $sheet->setCellValue('I6', "Izin"); // Set kolom G6 dengan tulisan "Nilai"
        $sheet->setCellValue('J6', "Dispen"); // Set kolom G6 dengan tulisan "Nilai"
        $sheet->setCellValue('K6', "Absen"); // Set kolom G6 dengan tulisan "Nilai"
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $sheet->getStyle('B6')->applyFromArray($style_col);
        $sheet->getStyle('C6')->applyFromArray($style_col);
        $sheet->getStyle('D6')->applyFromArray($style_col);
        $sheet->getStyle('E6')->applyFromArray($style_col);
        $sheet->getStyle('F6')->applyFromArray($style_col);
        $sheet->getStyle('G6')->applyFromArray($style_col);
        $sheet->getStyle('H6')->applyFromArray($style_col);
        $sheet->getStyle('I6')->applyFromArray($style_col);
        $sheet->getStyle('J6')->applyFromArray($style_col);
        $sheet->getStyle('K6')->applyFromArray($style_col);

        $hadir = $this->m_data->filter_laporan($id_jurusan, $id_kelas, $dari_tgl, $sampai_tgl, $status)->result();
        // var_dump($hadir);
        // die;

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya

        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 7; // Set baris pertama untuk isi tabel adalah baris ke 7
        foreach ($hadir as $data) { // Lakukan looping pada variabel siswa
            $sheet->setCellValue('B' . $numrow, $no);

            $where_siswa = array(
                'nis' => $data->nis
            );
            $siswa = $this->m_crud->edit_data($where_siswa, 'tb_siswa')->result();
            foreach ($siswa as $row) {
                $sheet->setCellValue('D' . $numrow, " " . ($data->nis == $row->nis ? $row->nis : null));
                $sheet->setCellValue('C' . $numrow, $data->nis == $row->nis ? $row->nama_siswa : null);

                $where_kelas = array(
                    'id_kelas' => $row->id_kelas
                );
                $kelas = $this->m_crud->edit_data($where_kelas, 'tb_kelas')->result();
                foreach ($kelas as $k) {

                    $where_jurusan = ['id_jurusan' => $k->id_jurusan];
                    $jurusan = $this->m_crud->edit_data($where_jurusan, 'tb_jurusan')->result();
                    foreach ($jurusan as $j) {
                        $sheet->setCellValue('E' . $numrow, $k->tingkatan . ' ' . $j->inisial . ' ' . $k->nama_kelas);
                    }
                    $sheet->setCellValue('F' . $numrow, $k->wali_kelas);
                }
            }

            $siswa =  $this->m_crud->edit_data($where_siswa, 'tb_siswa')->result();
            foreach ($siswa as $key) {
                $where = [
                    'id_siswa' => $key->id_siswa,
                    'status' => 'Hadir',
                    'status_data' => 'on'
                ];

                $total_hadir =  $this->m_data->jumlah_hadir_bertanggal($where, $dari_tgl, $sampai_tgl)->num_rows();
                $sheet->setCellValue('G' . $numrow, $total_hadir . ' kali');

                $where = [
                    'id_siswa' => $key->id_siswa,
                    'status' => 'Sakit',
                    'status_data' => 'on'
                ];
                $total_sakit =  $this->m_data->jumlah_hadir_bertanggal($where, $dari_tgl, $sampai_tgl)->num_rows();
                $sheet->setCellValue('H' . $numrow, $total_sakit . ' kali');

                $where = [
                    'id_siswa' => $key->id_siswa,
                    'status' => 'Izin',
                    'status_data' => 'on'
                ];
                $total_izin =  $this->m_data->jumlah_hadir_bertanggal($where, $dari_tgl, $sampai_tgl)->num_rows();
                $sheet->setCellValue('I' . $numrow, $total_izin . ' kali');

                $where = [
                    'id_siswa' => $key->id_siswa,
                    'status' => 'Dispen',
                    'status_data' => 'on'
                ];
                $total_dispen =  $this->m_data->jumlah_hadir_bertanggal($where, $dari_tgl, $sampai_tgl)->num_rows();
                $sheet->setCellValue('J' . $numrow, $total_dispen . ' kali');
            }

            $where = [
                'id_siswa' => $row->id_siswa,
                'status_data' => 'on'
            ];
            $total =  $this->m_crud->edit_data($where, 'tb_hadir')->num_rows();
            $hari = $this->m_data->get_hari($dari_tgl, $sampai_tgl)->num_rows();
            $absen = $hari - $total;
            if ($absen <= 0) {
                $sheet->setCellValue('K' . $numrow, '0 kali');
            } else {
                $sheet->setCellValue('K' . $numrow, $absen . ' kali');
            }

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('G' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('H' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('I' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('J' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('K' . $numrow)->applyFromArray($style_row);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }
        // Set width kolom
        $sheet->getColumnDimension('B')->setWidth(5); // Set width kolom A
        $sheet->getColumnDimension('C')->setWidth(35); // Set width kolom B
        $sheet->getColumnDimension('D')->setWidth(15); // Set width kolom C
        $sheet->getColumnDimension('E')->setWidth(15); // Set width kolom D
        $sheet->getColumnDimension('F')->setWidth(35); // Set width kolom E
        $sheet->getColumnDimension('G')->setWidth(10); // Set width kolom E
        $sheet->getColumnDimension('H')->setWidth(10); // Set width kolom E
        $sheet->getColumnDimension('I')->setWidth(10); // Set width kolom E
        $sheet->getColumnDimension('J')->setWidth(10); // Set width kolom E
        $sheet->getColumnDimension('K')->setWidth(10); // Set width kolom E

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $sheet->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $sheet->setTitle("Laporan Praktikum");
        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        // nama file    
        header('Content-Disposition: attachment; filename="' . 'laporan_absensi_siswa_tanggal_' . $dari_tgl . "_" . $sampai_tgl . '.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}
