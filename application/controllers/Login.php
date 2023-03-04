<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Login extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_data');
        $this->load->model('m_crud');
    }

    public function index()
    {
        $data['siswa'] = $this->m_data->kehadiran()->result();
        $this->load->view('login', $data);
    }

    public function ceklogin()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $where = array(
            'username' => $username,
            'password' => md5($password)
        );
        // var_dump($where);
        // die;
        $this->load->model('m_login');
        $cek = $this->m_login->cek_login('tb_user', $where)->num_rows();
        if ($cek > 0) {
            $data = $this->m_login->cek_login('tb_user', $where)->row();
            $level = $data->level;
            if ($level == '0') {
                $data_session = array(
                    'id' => $data->id_user,
                    'nama' => $data->nama_user,
                    'username' => $data->username,
                    'level' => 'Administrator',
                    'status' => 'telah_login'
                );
                $this->session->set_userdata($data_session);
                redirect(base_url() . 'administrator/dashboard');
            } elseif ($level == '1') {
                $data_session = array(
                    'id' => $data->id_user,
                    'nama' => $data->nama_user,
                    'username' => $data->username,
                    'level' => 'Guru',
                    'status' => 'telah_login'
                );
                $this->session->set_userdata($data_session);
                redirect(base_url() . 'guru/dashboard');
            }
        } else {
            redirect(base_url() . 'login?alert=gagal');
        }
    }

    public function keluar()
    {
        $this->session->sess_destroy();
        redirect(base_url() . 'login?alert=logout');
    }
}
