<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Pengaturan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_crud');
        $this->load->model('m_data');

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
        $data = [
            'judul' => "Pengaturan"
        ];
        $data['sekolah'] = $this->m_crud->get_data('id_sekolah', 'tb_sekolah')->result();
        $data['berita'] = $this->m_crud->get_data('id_berita', 'tb_berita')->result();

        $where = [
            'status_data' => 'on'
        ];
        $data['total_hadir'] = $this->m_crud->edit_data($where, 'tb_hadir')->num_rows();
        $data['total_hari'] = $this->m_crud->get_data('id_hari', 'tb_hari')->num_rows();
        $data['tgl_awal'] = $this->m_data->get_tgl('ASC')->row();
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/header');
        $this->load->view('pengaturan/index', $data);
        $this->load->view('template/footer');
    }

    public function aksi_ubah_logo()
    {
        // rules for form validation
        $id_sekolah = $this->input->post('id_sekolah');

        $where = [
            'id_sekolah' => $id_sekolah
        ];

        if (isset($_FILES['foto']['name']) && $_FILES['foto']['name'] != '') {
            // $nama = str_replace(' ', '_', $nama_sekolah);
            $foto = rand() . "_Sekolah1.jpg";
            $config['upload_path'] = './assets/images/';
            $config['allowed_types'] = 'jpeg|jpg|png';
            $config['max_size'] = 3000;
            $config['max_width'] = 2000;
            $config['max_height'] = 2000;
            $config['file_name'] = $foto;

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('foto')) //jika gagal upload
            {
                $error = $this->upload->display_errors(); //tampilkan error
                $this->session->set_flashdata('failed', $error);
                redirect(base_url() . 'administrator/pengaturan/' . $id_sekolah);
            } else {
                $this->upload->data();
            }
        } else {
            $foto = $this->input->post('foto_default');
        }

        $sekolah = $this->m_crud->edit_data($where, 'tb_sekolah')->result();

        foreach ($sekolah as $row) {
            $path_file = 'assets/images/'; // path file
            $nama_file = $row->foto_sekolah; // nama file
            if ($nama_file != 'sekolah.png') {
                unlink($path_file . $nama_file); // hapus file
            }
        }

        $data = [
            'foto_sekolah' => $foto,
        ];
        $this->m_crud->update_data($where, $data, 'tb_sekolah');
        $this->session->set_flashdata('success', 'Data Berhasil Diubah.');
        redirect(base_url() . 'administrator/pengaturan');
    }

    public function hapus_logo($id_sekolah)
    {
        $where = [
            'id_sekolah' => $id_sekolah
        ];

        $sekolah = $this->m_crud->edit_data($where, 'tb_sekolah')->result();

        foreach ($sekolah as $row) {
            $path_file = 'assets/images/'; // path file
            $nama_file = $row->foto_sekolah; // nama file
            if ($nama_file != 'sekolah.png') {
                unlink($path_file . $nama_file); // hapus file
            }
        }

        $data = [
            'foto_sekolah' => 'sekolah.png',
        ];
        $this->m_crud->update_data($where, $data, 'tb_sekolah');
        $this->session->set_flashdata('success', 'Data Berhasil Dihapus.');
        redirect(base_url() . 'administrator/pengaturan');
    }

    public function aksi_ubah_berita()
    {
        // rules for form validation
        $id_berita = $this->input->post('id_berita');
        $isi_berita = $this->input->post('isi_berita');


        $where = [
            'id_berita' => $id_berita
        ];

        $data = [
            'isi_berita' => $isi_berita,
        ];
        $this->m_crud->update_data($where, $data, 'tb_berita');
        $this->session->set_flashdata('success', 'Data Berhasil Diubah.');
        redirect(base_url() . 'administrator/pengaturan');
    }

    public function status_berita($id_berita, $status)
    {
        $where = [
            'id_berita' => $id_berita
        ];

        $data = [
            'status' => $status,
        ];

        $this->m_crud->update_data($where, $data, 'tb_berita');
        $this->session->set_flashdata('success', 'Data Berhasil Diubah.');
        redirect(base_url() . 'administrator/pengaturan');
    }

    public function ganti_kelas()
    {
        $hadir = $this->m_crud->get_data('id_hadir', 'tb_hadir')->result();
        foreach ($hadir as $key) {
            $hadir_num = $this->m_crud->get_data('id_hadir', 'tb_hadir')->num_rows();
            for ($i = 0; $i < $hadir_num; $i++) {
                $where = [
                    'id_hadir' => $key->id_hadir
                ];

                $data = [
                    'status_data' => 'off'
                ];
                $this->m_crud->update_data($where, $data, 'tb_hadir');
            }
        }

        // kelas XII di hapus
        $whereXII = [
            'tingkatan' => 'XII'
        ];
        $kelasXII = $this->m_crud->edit_data($whereXII, 'tb_kelas')->result();
        foreach ($kelasXII as $k) {
            $whereXII = [
                'id_kelas' => $k->id_kelas
            ];
            $siswaXII = $this->m_crud->edit_data($whereXII, 'tb_siswa')->result();
            $siswaXII_num = $this->m_crud->edit_data($whereXII, 'tb_siswa')->num_rows();
            foreach ($siswaXII as $s) {
                for ($i = 0; $i < $siswaXII_num; $i++) {
                    $where = [
                        'id_siswa' => $s->id_siswa
                    ];
                    $path_file = 'assets/images/foto_profil/'; // path file
                    $nama_file = $s->foto; // nama file
                    if ($nama_file != 'user.png') {
                        unlink($path_file . $nama_file); // hapus file
                    }

                    $this->m_crud->delete_data($where, 'tb_siswa');
                }
            }
        }

        // Fetch all classes with tingkatan XI
        $whereXI = ['tingkatan' => 'XI'];
        $kelasXI = $this->m_crud->edit_data($whereXI, 'tb_kelas')->result();

        foreach ($kelasXI as $k) {
            // Fetch all students from the current XI class
            $whereXI = ['id_kelas' => $k->id_kelas];
            $siswaXI = $this->m_crud->edit_data($whereXI, 'tb_siswa')->result();

            // Fetch the corresponding XII class with the same jurusan and class name
            $whereXII = [
                'tingkatan' => 'XII',
                'id_jurusan' => $k->id_jurusan,
                'nama_kelas' => $k->nama_kelas // Ensure it maps to the same class name
            ];
            $kelasXII = $this->m_crud->edit_data($whereXII, 'tb_kelas')->row();

            if ($kelasXII) {
                foreach ($siswaXI as $s) {
                    $whereSiswa = ['id_siswa' => $s->id_siswa];
                    $dataUpdate = ['id_kelas' => $kelasXII->id_kelas];

                    // Update student class to XII
                    $this->m_crud->update_data($whereSiswa, $dataUpdate, 'tb_siswa');
                }
            }
        }


        // Fetch all classes with tingkatan X
        $whereX = ['tingkatan' => 'X'];
        $kelasX = $this->m_crud->edit_data($whereX, 'tb_kelas')->result();

        foreach ($kelasX as $k) {
            // Fetch all students from the current X class
            $whereX = ['id_kelas' => $k->id_kelas];
            $siswaX = $this->m_crud->edit_data($whereX, 'tb_siswa')->result();

            // Fetch the corresponding XI class with the same jurusan and class name
            $whereXI = [
                'tingkatan' => 'XI',
                'id_jurusan' => $k->id_jurusan,
                'nama_kelas' => $k->nama_kelas // Ensure it maps to the same class name
            ];
            $kelasXI = $this->m_crud->edit_data($whereXI, 'tb_kelas')->row();

            // Ensure the corresponding XI class exists
            if ($kelasXI) {
                foreach ($siswaX as $s) {
                    $whereSiswa = ['id_siswa' => $s->id_siswa];
                    $dataUpdate = ['id_kelas' => $kelasXI->id_kelas];

                    // Update student class to XI
                    $this->m_crud->update_data($whereSiswa, $dataUpdate, 'tb_siswa');
                }
            }
        }


        $this->m_data->deleteAllDataHari();

        $this->session->set_flashdata('success', 'Data Berhasil Diperbaharui.');
        redirect(base_url() . 'administrator/pengaturan');
    }

    public function reset_kehadiran()
    {
        $this->db->where('status_data', 'on');
        $this->db->delete('tb_hadir');

        $this->session->set_flashdata('success', 'Data kehadiran dengan status tahun ajaran sekarang telah dihapus.');
        redirect('administrator/pengaturan');
    }

    public function mulai_kehadiran()
    {
        $data = [
            'tgl' => date('Y-m-d')
        ];

        $this->m_crud->insert_data($data, 'tb_hari');
        $this->session->set_flashdata('success', 'Tahun Ajaran telah Dimulai.');
        redirect(base_url() . 'administrator/pengaturan');
    }
}
