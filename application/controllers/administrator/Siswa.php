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
            redirect(base_url() . 'home?alert=belum_login#contact');
        } else if ($this->session->userdata('level') != "Administrator") {
            redirect(base_url() . 'home?alert=bukan_admin#contact');
        }
    }

    public function listKelas()
    {
        $id_jurusan = $this->input->post('id_jurusan');
        $kelas = $this->m_data->viewByJurusan($id_jurusan);
        $lists = "
        <label for='id_kelas' class='form-label'>Kelas</label>
                    <select class='custom-select' id='id_kelas' name='id_kelas'>
                        <option disabled selected>-- Pilih Kelas --</option>
                    
        ";
        foreach ($kelas as $data) {
            $lists .= "<option value='" . $data->id_kelas . "'>" . $data->nama_kelas . "</option>";
        }
        $callback = array('list_kelas' => $lists);
        echo json_encode($callback);
    }

    public function index()
    {
        $data = [
            'judul' => "Siswa"
        ];
        $data['siswa'] = $this->m_crud->get_data('id_siswa', 'tb_siswa')->result();
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/header');
        $this->load->view('siswa/index', $data);
        $this->load->view('template/footer');
    }

    public function tambah()
    {
        $data = array(
            'judul' => "Siswa"
        );

        $data['jurusan'] = $this->m_crud->get_data('id_jurusan', 'tb_jurusan')->result();
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/header');
        $this->load->view('siswa/tambah', $data);
        $this->load->view('template/footer');
    }

    public function aksi_tambah()
    {
        $id_jurusan = $this->input->post('id_jurusan');
        $id_kelas = $this->input->post('id_kelas');
        $nama_siswa = $this->input->post('nama_siswa');
        $nis = $this->input->post('nis');
        $pin = $this->input->post('pin');

        if (isset($_FILES['foto']['name']) && $_FILES['foto']['name'] != '') {
            $nama = str_replace(' ', '_', $nama_siswa);
            $foto = rand() . "-" . $nama . ".jpg";
            $config['upload_path'] = './assets/images/foto_profil/';
            $config['allowed_types'] = 'jpeg|jpg|png';
            $config['max_size'] = 5000;
            $config['max_width'] = 2000;
            $config['max_height'] = 2000;
            $config['file_name'] = $foto;

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('foto')) //jika gagal upload
            {
                $error = array('error' => $this->upload->display_errors()); //tampilkan error
                redirect(base_url() . 'administrator/siswa', $error);
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
        $id_jurusan = $this->input->post('id_jurusan');
        $id_kelas = $this->input->post('id_kelas');
        $nama_siswa = $this->input->post('nama_siswa');
        $nis = $this->input->post('nis');
        $pin = $this->input->post('pin');

        if (isset($_FILES['foto']['name']) && $_FILES['foto']['name'] != '') {
            $nama = str_replace(' ', '_', $nama_mahasiswa);
            $foto = rand() . "-" . $nama . ".jpg";
            $config['upload_path'] = './assets/images/foto_profil/';
            $config['allowed_types'] = 'jpeg|jpg|png';
            $config['max_size'] = 5000;
            $config['max_width'] = 6000;
            $config['max_height'] = 6000;
            $config['file_name'] = $foto;

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('foto')) //jika gagal upload
            {
                echo "gagal";
                die;
                $error = array('error' => $this->upload->display_errors()); //tampilkan error
                redirect(base_url() . 'administrator/data_pengguna/guru', $error);
            } else {
                $this->upload->data();
            }
        } else {
            $foto = $this->input->post('foto_default');
        }

        $where = [
            'id_siswa' => $id_siswa
        ];

        $data = [
            'foto' => $foto,
            'nama_siswa' => $nama_siswa,
            'id_jurusan' => $id_jurusan,
            'id_kelas' => $id_kelas,
            'pin' => $pin,
            'nis' => $nis
        ];
        $this->m_crud->update_data($where, $data, 'tb_siswa');
        redirect(base_url() . 'administrator/siswa'); //mengalihkan halaman
    }

    public function hapus($id_siswa)
    {
        $where = array(
            'id_siswa' => $id_siswa
        );
        $this->m_crud->delete_data($where, 'tb_siswa');
        redirect(base_url() . 'administrator/siswa');
    }
}
