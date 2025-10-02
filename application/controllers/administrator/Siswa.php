<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Siswa extends CI_Controller
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
            'judul' => "Siswa"
        ];
        $data['siswa'] = $this->m_crud->get_data('id_siswa', 'tb_siswa')->result();
        $data['jurusan'] = $this->m_crud->get_data('id_jurusan', 'tb_jurusan')->result();
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/header');
        $this->load->view('siswa/index', $data);
        $this->load->view('template/footer');
    }

    public function aksi_tambah()
    {
        // rules for form validation
        $this->form_validation->set_rules('id_jurusan', 'Nama Jurusan', 'required|trim');
        $this->form_validation->set_rules('id_kelas', 'Nama Kelas', 'required|trim');
        $this->form_validation->set_rules('nama_siswa', 'Nama Siswa', 'required|trim');
        $this->form_validation->set_rules(
            'nis',
            'NIS',
            'required|trim|is_unique[tb_siswa.nis]',
            ['is_unique' => 'NIS sudah terdaftar, gunakan NIS lain.']
        );
        $this->form_validation->set_rules(
            'pin',
            'PIN',
            'required|trim|is_unique[tb_siswa.pin]',
            ['is_unique' => 'PIN sudah terdaftar, gunakan PIN lain.']
        );

        // jika validasi form gagal
        if ($this->form_validation->run() != false) {
            $id_jurusan = $this->input->post('id_jurusan');
            $id_kelas = $this->input->post('id_kelas');
            $nama_siswa = $this->input->post('nama_siswa');
            $nis = $this->input->post('nis');
            $pin = $this->input->post('pin');

            $where = [
                'pin' => $pin
            ];

            $cek = $this->m_crud->edit_data($where, 'tb_siswa')->num_rows();
            if ($cek == 0) {
                $where = [
                    'nis' => $nis
                ];
                $cek = $this->m_crud->edit_data($where, 'tb_siswa')->num_rows();
                if ($cek == 0) {
                    if (isset($_FILES['foto']['name']) && $_FILES['foto']['name'] != '') {

                        $nama = str_replace(' ', '_', $nama_siswa);
                        $nama_safe = preg_replace('/[^\p{L}\p{N}_\-]/u', '', $nama);
                        if ($nama_safe === '') {
                            $nama_safe = 'user';
                        }
                        $foto = rand() . "_" . $nama_safe . ".jpg";

                        $config['upload_path'] = './assets/images/foto_profil/';
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
                            redirect(base_url() . 'administrator/siswa');
                        } else {
                            $this->upload->data();
                        }
                    } else {
                        $foto = $this->input->post('foto_default');
                    }
                    $data = [
                        'foto' => $foto,
                        'nama_siswa' => $nama_siswa,
                        'id_jurusan' => $id_jurusan,
                        'id_kelas' => $id_kelas,
                        'pin' => $pin,
                        'nis' => $nis
                    ];

                    $this->m_crud->insert_data($data, 'tb_siswa');
                    $this->session->set_flashdata('success', 'Data berhasil ditambahkan.');
                } else {
                    $this->session->set_flashdata('failed', 'NIS Sudah Terdaftar/Digunakan');
                }
            } else {
                $this->session->set_flashdata('failed', 'PIN Sudah Terdaftar/Digunakan');
            }
        } else {
            $this->session->set_flashdata('failed', validation_errors());
        }
        redirect(base_url() . 'administrator/siswa');
    }

    public function ubah($id_siswa)
    {
        $where = array(
            'id_siswa' => $id_siswa,
        );

        $data = array(
            'judul' => "Siswa"
        );

        $data['kelas'] = $this->m_crud->get_data('id_kelas', 'tb_kelas')->result();
        $data['jurusan'] = $this->m_crud->get_data('id_jurusan', 'tb_jurusan')->result();
        $data['siswa'] = $this->m_crud->edit_data($where, 'tb_siswa')->result();
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/header');
        $this->load->view('siswa/ubah', $data);
        $this->load->view('template/footer');
    }

    public function aksi_ubah()
    {
        $id_siswa = $this->input->post('id_siswa');
        // rules for form validation
        $this->form_validation->set_rules('id_jurusan', 'Nama Jurusan', 'required|trim');
        $this->form_validation->set_rules('id_kelas', 'Nama Kelas', 'required|trim');
        $this->form_validation->set_rules('nama_siswa', 'Nama Siswa', 'required|trim');
        $this->form_validation->set_rules('nis', 'NIS', 'required|trim|callback_check_nis_unique[' . $id_siswa . ']');
        $this->form_validation->set_rules('pin', 'PIN', 'required|trim|callback_check_pin_unique[' . $id_siswa . ']');

        // jika validasi form gagal
        if ($this->form_validation->run() != false) {
            $id_jurusan = $this->input->post('id_jurusan');
            $id_kelas = $this->input->post('id_kelas');
            $nama_siswa = $this->input->post('nama_siswa');
            $nis = $this->input->post('nis');
            $pin = $this->input->post('pin');

            $where = [
                'id_siswa' => $id_siswa
            ];

            $cek = $this->m_data->getSiswa('pin', $id_siswa, $pin)->num_rows();
            if ($cek == 0) {
                $cek = $this->m_data->getSiswa('nis', $id_siswa, $nis)->num_rows();
                if ($cek == 0) {
                    if (isset($_FILES['foto']['name']) && $_FILES['foto']['name'] != '') {
                        
                        $nama = str_replace(' ', '_', $nama_siswa);
                        $nama_safe = preg_replace('/[^\p{L}\p{N}_\-]/u', '', $nama);
                        if ($nama_safe === '') {
                            $nama_safe = 'user';
                        }
                        $foto = rand() . "_" . $nama_safe . ".jpg";
                        
                        $config['upload_path'] = './assets/images/foto_profil/';
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
                            redirect(base_url() . 'administrator/siswa/ubah/' . $id_siswa);
                        } else {

                            $siswa = $this->m_crud->edit_data($where, 'tb_siswa')->result();
                            foreach ($siswa as $row) {
                                $path_file = 'assets/images/foto_profil/'; // path file
                                $nama_file = $row->foto; // nama file
                                if ($nama_file != 'user.png') {
                                    unlink($path_file . $nama_file); // hapus file
                                }
                            }
                            $this->upload->data();
                        }
                    } else {
                        $foto = $this->input->post('foto_default');
                    }

                    $data = [
                        'foto' => $foto,
                        'nama_siswa' => $nama_siswa,
                        'id_jurusan' => $id_jurusan,
                        'id_kelas' => $id_kelas,
                        'pin' => $pin,
                        'nis' => $nis
                    ];
                    $this->m_crud->update_data($where, $data, 'tb_siswa');
                    $this->session->set_flashdata('success', 'Data berhasil diubah.');
                    redirect(base_url() . 'administrator/siswa');
                } else {
                    $this->session->set_flashdata('failed', 'NIS Sudah Terdaftar/Digunakan');
                    redirect(base_url() . 'administrator/siswa/ubah/' . $this->input->post('id_siswa'));
                }
            } else {
                $this->session->set_flashdata('failed', 'PIN Sudah Terdaftar/Digunakan');
                redirect(base_url() . 'administrator/siswa/ubah/' . $this->input->post('id_siswa'));
            }
        } else {
            $this->session->set_flashdata('failed', validation_errors());
            redirect(base_url() . 'administrator/siswa/ubah/' . $this->input->post('id_siswa'));
        }
    }

    public function check_nis_unique($nis, $id_siswa)
    {
        $siswa = $this->db->get_where('tb_siswa', ['nis' => $nis, 'id_siswa !=' => $id_siswa])->row();

        if ($siswa) {
            $this->form_validation->set_message('check_nis_unique', 'NIS sudah terdaftar, gunakan NIS lain.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function check_pin_unique($pin, $id_siswa)
    {
        $siswa = $this->db->get_where('tb_siswa', ['pin' => $pin, 'id_siswa !=' => $id_siswa])->row();

        if ($siswa) {
            $this->form_validation->set_message('check_pin_unique', 'PIN sudah terdaftar, gunakan PIN lain.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function hapus($id_siswa)
    {
        $where = [
            'id_siswa' => $id_siswa
        ];
        $siswa = $this->m_crud->edit_data($where, 'tb_siswa')->result();

        foreach ($siswa as $row) {
            $path_file = 'assets/images/foto_profil/'; // path file
            $nama_file = $row->foto; // nama file
            if ($nama_file != 'user.png') {
                unlink($path_file . $nama_file); // hapus file
            }
        }

        $this->m_crud->delete_data($where, 'tb_siswa');
        $this->session->set_flashdata('success', 'Data berhasil dihapus.');
        redirect(base_url() . 'administrator/siswa');
    }
}
