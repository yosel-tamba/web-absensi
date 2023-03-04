<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Jurusan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_crud');
        $this->load->model('m_data');

        if ($this->session->userdata('status') != "telah_login") {
            redirect(base_url() . 'login?alert=belum_login');
        } else if ($this->session->userdata('level') != "Administrator") {
            redirect(base_url() . 'login?alert=bukan_admin');
        }
    }

    public function index()
    {
        $data = [
            'judul' => "Jurusan"
        ];
        $data['jurusan'] = $this->m_crud->get_data('id_jurusan', 'tb_jurusan')->result();
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/header');
        $this->load->view('jurusan/index', $data);
        $this->load->view('template/footer');
    }

    public function aksi_tambah()
    {
        $nama_jurusan = $this->input->post('nama_jurusan');
        $inisial = $this->input->post('inisial');
        $kaprog = $this->input->post('kaprog');

        $data = [
            'nama_jurusan' => $nama_jurusan,
            'kaprog' => $kaprog,
            'inisial' => $inisial
        ];

        $this->m_crud->insert_data($data, 'tb_jurusan');
        redirect(base_url() . 'administrator/jurusan');
    }

    public function aksi_ubah()
    {
        $id_jurusan = $this->input->post('id_jurusan');
        $inisial = $this->input->post('inisial');
        $nama_jurusan = $this->input->post('nama_jurusan');
        $kaprog = $this->input->post('kaprog');

        $where = [
            'id_jurusan' => $id_jurusan
        ];

        $data = [
            'nama_jurusan' => $nama_jurusan,
            'kaprog' => $kaprog,
            'inisial' => $inisial
        ];
        $this->m_crud->update_data($where, $data, 'tb_jurusan');
        redirect(base_url() . 'administrator/jurusan'); //mengalihkan halaman
    }

    public function hapus($id_jurusan)
    {
        $where = array(
            'id_jurusan' => $id_jurusan
        );
        $this->m_crud->delete_data($where, 'tb_jurusan');
        redirect(base_url() . 'administrator/jurusan');
    }
}
