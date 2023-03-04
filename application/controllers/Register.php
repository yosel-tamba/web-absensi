<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_register');
    }
    public function index()
    {
        // rules for form validation
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tb_user.email]');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        $this->form_validation->set_rules('level', 'Level', 'required');

        // jika validasi form gagal
        if ($this->form_validation->run() == false) {
            // tampilkan kembali halaman register
            $data['title'] = 'Form Register';
            $this->load->view('register', $data);
        } else {
            // tangkap setiap data yang dikirim
            $where = [
                'email' => $this->input->post('email'),
                'username' => $this->input->post('username'),
                'password' => md5($this->input->post('password')),
                'passconf' => $this->input->post('password'),
                'nama_user' => $this->input->post('nama'),
                'level' => $this->input->post('level')
            ];
            $this->m_register->cek_register('tb_user', $where);
            redirect(base_url() . 'login?alert=berhasil');
        }
    }
}
