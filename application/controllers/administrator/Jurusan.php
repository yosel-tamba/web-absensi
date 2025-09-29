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
        // rules for form validation
        $this->form_validation->set_rules('nama_jurusan', 'Nama Jurusan', 'required|trim');
        $this->form_validation->set_rules('inisial', 'Inisial Jurusan', 'required|trim');
        $this->form_validation->set_rules('kaprog', 'Kepala Program', 'required|trim');

        // jika validasi form gagal
        if ($this->form_validation->run() != false) {
            $nama_jurusan = $this->input->post('nama_jurusan');
            $inisial = $this->input->post('inisial');
            $kaprog = $this->input->post('kaprog');

            $data = [
                'nama_jurusan' => $nama_jurusan,
                'kaprog' => $kaprog,
                'inisial' => $inisial
            ];
            // Tampilkan pesan sukses dan redirect ke halaman utama
            $this->m_crud->insert_data($data, 'tb_jurusan');
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan.');
        } else {
            $this->session->set_flashdata('failed', validation_errors());
        }
        redirect(base_url() . 'administrator/jurusan');
    }

    public function aksi_ubah()
    {
        // rules for form validation
        $this->form_validation->set_rules('nama_jurusan', 'Nama Jurusan', 'required|trim');
        $this->form_validation->set_rules('inisial', 'Inisial Jurusan', 'required|trim');
        $this->form_validation->set_rules('kaprog', 'Kepala Program', 'required|trim');

        // jika validasi form gagal
        if ($this->form_validation->run() != false) {
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
            $this->session->set_flashdata('success', 'Data berhasil diubah.');
        } else {
            $this->session->set_flashdata('failed', validation_errors());
        }
        redirect(base_url() . 'administrator/jurusan');
    }

    public function hapus($id_jurusan)
    {
        $where = array(
            'id_jurusan' => $id_jurusan
        );
        $this->m_crud->delete_data($where, 'tb_jurusan');
        $this->session->set_flashdata('success', 'Data berhasil dihapus.');
        redirect(base_url() . 'administrator/jurusan');
    }
}
