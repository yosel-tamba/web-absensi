<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('m_crud');
        $this->load->model('m_data');

        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data = [
            'judul' => "Laporan"
        ];

        $data['laporan'] = $this->m_crud->get_data('id_user', 'tb_user')->result();

        $this->load->view('template/sidebar', $data);
        $this->load->view('template/header');
        $this->load->view('laporan/filter_laporan', $data);
        $this->load->view('template/footer');
    }
}
