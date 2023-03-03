<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Pengguna extends CI_Controller
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
            'judul' => "Pengguna"
        ];
        $data['pengguna'] = $this->m_crud->get_data('id_user', 'tb_user')->result();
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/header');
        $this->load->view('pengguna/index', $data);
        $this->load->view('template/footer');
    }

    public function aksi_tambah()
    {
        $nama_user = $this->input->post('nama_user');
        $email = $this->input->post('email');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $level = $this->input->post('level');

        $data = [
            'nama_user' => $nama_user,
            'email' => $email,
            'username' => $username,
            'password' => md5($password),
            'passconf' => $password,
            'level' => $level
        ];

        $this->m_crud->insert_data($data, 'tb_user');
        redirect(base_url() . 'administrator/pengguna');
    }

    public function aksi_ubah()
    {
        $id_user = $this->input->post('id_user');
        $nama_user = $this->input->post('nama_user');
        $email = $this->input->post('email');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $level = $this->input->post('level');

        $where = [
            'id_user' => $id_user
        ];

        $data = [
            'nama_user' => $nama_user,
            'email' => $email,
            'username' => $username,
            'password' => md5($password),
            'passconf' => $password,
            'level' => $level
        ];
        $this->m_crud->update_data($where, $data, 'tb_user');
        redirect(base_url() . 'administrator/pengguna'); //mengalihkan halaman
    }

    public function hapus($id_user)
    {
        $where = array(
            'id_user' => $id_user
        );
        $this->m_crud->delete_data($where, 'tb_user');
        redirect(base_url() . 'administrator/pengguna');
    }
}
