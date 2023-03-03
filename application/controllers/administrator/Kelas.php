<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Kelas extends CI_Controller
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

    public function index()
    {
        $data = [
            'judul' => "Kelas"
        ];
        $data['jurusan'] = $this->m_crud->get_data('id_jurusan', 'tb_jurusan')->result();
        $data['kelas'] = $this->m_crud->get_data('id_kelas', 'tb_kelas')->result();
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/header');
        $this->load->view('kelas/index', $data);
        $this->load->view('template/footer');
    }

    public function aksi_tambah()
    {
        $id_jurusan = $this->input->post('id_jurusan');
        $nama_kelas = $this->input->post('nama_kelas');
        $wali_kelas = $this->input->post('wali_kelas');

        $data = [
            'id_jurusan' => $id_jurusan,
            'nama_kelas' => $nama_kelas,
            'wali_kelas' => $wali_kelas
        ];

        $this->m_crud->insert_data($data, 'tb_kelas');
        redirect(base_url() . 'administrator/kelas');
    }

    public function aksi_ubah()
    {
        $id_kelas = $this->input->post('id_kelas');
        $id_jurusan = $this->input->post('id_jurusan');
        $nama_kelas = $this->input->post('nama_kelas');
        $wali_kelas = $this->input->post('wali_kelas');

        $where = [
            'id_kelas' => $id_kelas
        ];

        $data = [
            'id_jurusan' => $id_jurusan,
            'nama_kelas' => $nama_kelas,
            'wali_kelas' => $wali_kelas
        ];
        $this->m_crud->update_data($where, $data, 'tb_kelas');
        redirect(base_url() . 'administrator/kelas'); //mengalihkan halaman
    }

    public function hapus($id_kelas)
    {
        $where = array(
            'id_kelas' => $id_kelas
        );
        $this->m_crud->delete_data($where, 'tb_kelas');
        redirect(base_url() . 'administrator/kelas');
    }
}
