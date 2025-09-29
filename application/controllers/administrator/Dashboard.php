<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Dashboard extends CI_Controller
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
            'judul' => "Dashboard"
        );

        if (date('H:i:s') > "14:00:00" && date('H:i:s') < "23:59:59") {
            $data['hadir'] = $this->m_data->absensi_keluar_d()->result();
        } else {
            $data['hadir'] = $this->m_data->absensi_masuk_d()->result();
        }

        $data['siswa'] = $this->m_crud->get_data('id_siswa', 'tb_siswa')->result();
        $data['jurusan'] = $this->m_crud->get_data('id_jurusan', 'tb_jurusan')->result();
        $data['kelas'] = $this->m_crud->get_data('id_kelas', 'tb_kelas')->result();

        $data['total_siswa'] = $this->m_crud->get_data('id_siswa', 'tb_siswa')->num_rows();
        $data['total_kelas'] = $this->m_crud->get_data('id_kelas', 'tb_kelas')->num_rows();
        $data['hadir_hari_ini'] = $this->m_crud->edit_data(['tgl_masuk' => date('Y-m-d')], 'tb_hadir')->num_rows();
        $data['hadir_kemarin'] = $this->m_crud->edit_data(['tgl_masuk' => date('Y-m-d', strtotime("-1 day", strtotime(date("Y-m-d"))))], 'tb_hadir')->num_rows();

        $where = [
            'tgl' => date('Y-m-d')
        ];

        $data['hari'] = $this->m_crud->edit_data($where, 'tb_hari')->result();
        // $data['hari'] = $this->m_crud->edit_data($where, 'tb_hari')->num_rows();
        // var_dump( $data['hari'] );die;

        $this->load->view('template/sidebar', $data);
        $this->load->view('template/header');
        $this->load->view('dashboard', $data);
        $this->load->view('template/footer');
    }

    // jika ada yang hadir, maka akan otomatis menambahkan data "hari" pada tabel "tb_hari"
    public function auth_absensi($status, $pin)
    {
        $where = [
            'pin' => $pin
        ];

        $cek_siswa = $this->m_crud->edit_data($where, 'tb_siswa')->num_rows();
        $siswa = $this->m_crud->edit_data($where, 'tb_siswa')->row();
        if ($cek_siswa > 0) {
            $where = [
                'id_siswa' => $siswa->id_siswa,
                'tgl_masuk' => date('Y-m-d')
            ];

            $cek = $this->m_crud->edit_data($where, 'tb_hadir')->num_rows();
            if ($cek > 0) {
                if (date('H:i:s') > "14:00:00" && date('H:i:s') < "23:59:59") {
                    $data = [
                        'jam_keluar' => date('H:i:s'),
                        'status' => $status

                    ];
                    $this->m_crud->update_data($where, $data, 'tb_hadir');
                    $this->session->set_flashdata('success',  'Data telah diperbarui : ' . $siswa->nama_siswa . ', ' .  $status);
                } else {
                    $data = [
                        'tgl_masuk' => date('Y-m-d'),
                        'jam_masuk' => date('H:i:s'),
                        'status' => $status
                    ];
                    $this->m_crud->update_data($where, $data, 'tb_hadir');
                    $this->session->set_flashdata('success', 'Data telah diperbarui : ' . $siswa->nama_siswa . ', ' .  $status);
                }
            } else {
                
                // cek apakah tgl hari ini sudah ada
                $today = date('Y-m-d');
                $where = ['tgl' => $today];
                $cek = $this->m_crud->edit_data($where, 'tb_hari')->row();

                if (!$cek) {
                    $data_hari = [
                        'tgl' => $today
                    ];
                    $this->m_crud->insert_data($data_hari, 'tb_hari');
                }

                $data = [
                    'id_siswa' => $siswa->id_siswa,
                    'status' => $status,
                    'status_data' => 'on',
                    'tgl_masuk' => date('Y-m-d'),
                    'jam_masuk' => date('H:i:s')
                ];
                $this->m_crud->insert_data($data, 'tb_hadir');
                $this->session->set_flashdata('success', 'Data telah ditambahkan : ' . $siswa->nama_siswa . ', ' .  $status);
            }
        } else {
            $this->session->set_flashdata('failed', 'PIN tidak terdaftar');
        }
        redirect(base_url('administrator/dashboard'));
    }

    // jika hari ini libur, maka akan menhapus data "hari ini" pada tabel "tb_hari", serta menghapus semua data absensi pada hari ini pada tabel "tb_hadir"
    public function hari_libur()
    {
        $where_tb_hari = [
            'tgl' => date('Y-m-d')
        ];

        $where_tb_hadir = [
            'tgl_masuk' => date('Y-m-d')
        ];

        $this->m_crud->delete_data($where_tb_hari, 'tb_hari');
        $this->m_crud->delete_data($where_tb_hadir, 'tb_hadir');
        $this->session->set_flashdata('success', 'Hari ini dinyatakan Libur.');
        redirect(base_url() . 'administrator/dashboard');
    }

    // public function mulai_absensi()
    // {
    //     $data = [
    //         'tgl' => date('Y-m-d')
    //     ];

    //     $this->m_crud->insert_data($data, 'tb_hari');
    //     $this->session->set_flashdata('success', 'Absensi telah Dimulai.');
    //     redirect(base_url() . 'administrator/dashboard');
    // }

    public function aksi_filter()
    {
        // rules for form validation
        $this->form_validation->set_rules('dari_tgl', 'Dari Tanggal', 'required|trim');
        $this->form_validation->set_rules('sampai_tgl', 'Sampai Tanggal', 'required|trim');

        // jika validasi form gagal
        if ($this->form_validation->run() != false) {
            // tangkap setiap data yang dikirim
            $id_jurusan = $this->input->post('id_jurusan');
            $id_kelas = $this->input->post('id_kelas');
            $dari_tgl = $this->input->post('dari_tgl');
            $sampai_tgl = $this->input->post('sampai_tgl');
            $status = $this->input->post('status');

            if (empty($id_jurusan)) {
                $id_jurusan = 'kosong';
            }

            if (empty($id_kelas)) {
                $id_kelas = 'kosong';
            }

            if (empty($status)) {
                $status = 'kosong';
            }

            redirect(base_url('administrator/dashboard/hasil_filter/'  . $id_jurusan . '/' . $id_kelas . '/' . $dari_tgl . '/' . $sampai_tgl . '/' . $status));
        } else {
            $this->session->set_flashdata('failed', validation_errors());
            redirect(base_url() . 'administrator/dashboard');
        }
    }

    public function hasil_filter($id_jurusan, $id_kelas, $dari_tgl, $sampai_tgl, $status)
    {
        $data = array(
            'judul' => "Dashboard",
            'pesan' => 'Data di Filter Dari Tanggal ' . $dari_tgl . ' Sampai Tanggal ' . $sampai_tgl . ', Status: ' . ($status == 'kosong' ? 'Semua' : $status),
            'id_jurusan' => $id_jurusan,
            'status' => $status,
            'id_kelas' => $id_kelas,
            'dari_tgl' => $dari_tgl,
            'sampai_tgl' => $sampai_tgl,
        );
        $data['hadir'] = $this->m_data->filter_absensi($id_jurusan, $id_kelas, $dari_tgl, $sampai_tgl, $status)->result();

        $data['jurusan'] = $this->m_crud->get_data('id_jurusan', 'tb_jurusan')->result();

        $this->load->view('template/sidebar', $data);
        $this->load->view('template/header');
        $this->load->view('filter/absensi', $data);
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
        $sheet->setCellValue('B1', "Data Absensi Siswa");
        $sheet->mergeCells('B1:F1');
        $sheet->getStyle('B1')->getFont()->setBold(true);
        $sheet->setCellValue('B3', "Dari Tanggal : " . $dari_tgl . "");
        $sheet->mergeCells('B3:C3');
        $sheet->getStyle('B3')->getFont()->setBold(true);
        $sheet->setCellValue('B4', "Sampai Tanggal : " . $sampai_tgl . "");
        $sheet->mergeCells('B4:C4');
        $sheet->getStyle('B4')->getFont()->setBold(true);
        $sheet->setCellValue('D3', "Status : " . ($status == 'kosong' ? 'Semua' : $status));
        $sheet->mergeCells('D3:E3');
        $sheet->getStyle('D3')->getFont()->setBold(true);
        // Buat header tabel nya pada baris ke 3
        $sheet->setCellValue('B6', "No"); // Set kolom A6 dengan tulisan "No"
        $sheet->setCellValue('C6', "Siswa"); // Set kolom B6 dengan tulisan "Siswa"
        $sheet->setCellValue('D6', "NIS"); // Set kolom C6 dengan tulisan "NIS"
        $sheet->setCellValue('E6', "Kelas"); // Set kolom D6 dengan tulisan "Kelas"
        $sheet->setCellValue('F6', "Wali Kelas"); // Set kolom E6 dengan tulisan "Wali Kelas"
        $sheet->setCellValue('G6', "Status"); // Set kolom F6 dengan tulisan "Status"
        $sheet->setCellValue('H6', "Tanggal"); // Set kolom G6 dengan tulisan "Tanggal"
        $sheet->setCellValue('I6', "Masuk"); // Set kolom G6 dengan tulisan "Masuk"
        $sheet->setCellValue('J6', "Pulang"); // Set kolom G6 dengan tulisan "Pulang"
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

        $hadir = $this->m_data->filter_absensi($id_jurusan, $id_kelas, $dari_tgl, $sampai_tgl, $status)->result();

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya

        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 7; // Set baris pertama untuk isi tabel adalah baris ke 7
        foreach ($hadir as $data) { // Lakukan looping pada variabel siswa
            $sheet->setCellValue('B' . $numrow, $no);

            $where_siswa = array(
                'id_siswa' => $data->id_siswa
            );
            $siswa = $this->m_crud->edit_data($where_siswa, 'tb_siswa')->result();
            foreach ($siswa as $row) {
                $sheet->setCellValue('C' . $numrow, $row->nama_siswa);
                $sheet->setCellValue('D' . $numrow, " " . $row->nis);

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
            $sheet->setCellValue('G' . $numrow, $data->status);
            $sheet->setCellValue('H' . $numrow, date('d-m-Y', strtotime($data->tgl_masuk)));

            $sheet->setCellValue('I' . $numrow, $data->jam_masuk);
            $sheet->setCellValue('J' . $numrow, $data->jam_keluar);

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

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }
        // Set width kolom
        $sheet->getColumnDimension('B')->setWidth(5); // Set width kolom B
        $sheet->getColumnDimension('C')->setWidth(35); // Set width kolom C
        $sheet->getColumnDimension('D')->setWidth(15); // Set width kolom D
        $sheet->getColumnDimension('E')->setWidth(15); // Set width kolom E
        $sheet->getColumnDimension('F')->setWidth(35); // Set width kolom F
        $sheet->getColumnDimension('G')->setWidth(15); // Set width kolom G
        $sheet->getColumnDimension('H')->setWidth(15); // Set width kolom H
        $sheet->getColumnDimension('I')->setWidth(15); // Set width kolom I
        $sheet->getColumnDimension('J')->setWidth(15); // Set width kolom J

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
