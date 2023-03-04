<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array(
            'judul' => "Dashboard"
        );
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/header');
        $this->load->view('dashboard', $data);
        $this->load->view('template/footer');
    }
}
