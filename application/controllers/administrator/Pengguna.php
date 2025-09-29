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
        // rules for form validation
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tb_user.email]');
        $this->form_validation->set_rules('nama_user', 'Nama', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[tb_user.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        $this->form_validation->set_rules('level', 'Level', 'required');

        // jika validasi form gagal
        if ($this->form_validation->run() != false) {
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
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan.');
        } else {
            $this->session->set_flashdata('failed', validation_errors());
        }
        redirect(base_url() . 'administrator/pengguna');
    }

    public function aksi_ubah()
    {
        // rules for form validation
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('nama_user', 'Nama', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        $this->form_validation->set_rules('level', 'Level', 'required');

        // jika validasi form gagal
        if ($this->form_validation->run() != false) {
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
            $this->session->set_flashdata('success', 'Data berhasil diubah.');
        } else {
            $this->session->set_flashdata('failed', validation_errors());
        }
        redirect(base_url() . 'administrator/pengguna');
    }

    public function hapus($id_user)
    {
        $where = array(
            'id_user' => $id_user
        );
        $this->m_crud->delete_data($where, 'tb_user');
        $this->session->set_flashdata('success', 'Data berhasil dihapus.');
        redirect(base_url() . 'administrator/pengguna');
    }
}
