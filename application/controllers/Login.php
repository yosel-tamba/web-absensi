<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Login extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        date_default_timezone_set('Asia/Jakarta');

        $this->load->model('m_data');
        $this->load->model('m_crud');
    }

    public function index()
    {
        $data['sekolah'] = $this->m_crud->get_data('id_sekolah', 'tb_sekolah')->result();
        $data['berita'] = $this->m_crud->get_data('id_berita', 'tb_berita')->result();
        $where = [
            'tgl' => date('Y-m-d')
        ];
        $data['hari'] = $this->m_crud->edit_data($where, 'tb_hari')->num_rows();

        if (date('H:i:s') > "14:00:00" && date('H:i:s') < "23:59:59") {
            $data['hadir'] = $this->m_data->absensi_keluar()->result();
        } else {
            $data['hadir'] = $this->m_data->absensi_masuk()->result();
        }
        $this->load->view('login', $data);
    }

    public function ceklogin()
    {
        // rules for form validation
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        // jika validasi form gagal
        if ($this->form_validation->run() != false) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $where = array(
                'username' => $username,
                'password' => md5($password)
            );
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
                        'password' => $data->passconf,
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
                        'password' => $data->passconf,
                        'level' => 'Wali Kelas',
                        'status' => 'telah_login'
                    );
                    $this->session->set_userdata($data_session);
                    redirect(base_url() . 'wali_kelas/dashboard');
                }
            } else {
                $this->session->set_flashdata('failed_d', 'Maaf! Username dan Password Salah');
            }
        } else {
            $this->session->set_flashdata('failed_d', validation_errors());
        }
        redirect(base_url());
    }

    public function keluar()
    {
        $this->session->sess_destroy();
        redirect(base_url() . 'login/alert');
    }

    public function alert()
    {
        $this->session->set_flashdata('success_d', 'Logout Berhasil.');
        redirect(base_url());
    }
}
