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
        $this->form_validation->set_rules('id_jurusan', 'Nama Jurusan', 'required|trim');
        $this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'required|trim');
        $this->form_validation->set_rules('tingkatan', 'Tingkatan', 'required|trim');
        $this->form_validation->set_rules('wali_kelas', 'Nama Wali Kelas', 'required|trim');

        // jika validasi form gagal
        if ($this->form_validation->run() != false) {
            $id_jurusan = $this->input->post('id_jurusan');
            $nama_kelas = $this->input->post('nama_kelas');
            $tingkatan = $this->input->post('tingkatan');
            $wali_kelas = $this->input->post('wali_kelas');

            $data = [
                'id_jurusan' => $id_jurusan,
                'tingkatan' => $tingkatan,
                'nama_kelas' => $nama_kelas,
                'wali_kelas' => $wali_kelas
            ];

            $this->m_crud->insert_data($data, 'tb_kelas');
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan.');
        } else {
            $this->session->set_flashdata('failed', validation_errors());
        }
        redirect(base_url() . 'administrator/kelas');
    }

    public function aksi_ubah()
    {
        $this->form_validation->set_rules('id_jurusan', 'Nama Jurusan', 'required|trim');
        $this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'required|trim');
        $this->form_validation->set_rules('tingkatan', 'Tingkatan', 'required|trim');
        $this->form_validation->set_rules('wali_kelas', 'Nama Wali Kelas', 'required|trim');

        // jika validasi form gagal
        if ($this->form_validation->run() != false) {
            $id_kelas = $this->input->post('id_kelas');
            $id_jurusan = $this->input->post('id_jurusan');
            $nama_kelas = $this->input->post('nama_kelas');
            $tingkatan = $this->input->post('tingkatan');
            $wali_kelas = $this->input->post('wali_kelas');

            $where = [
                'id_kelas' => $id_kelas
            ];

            $data = [
                'id_jurusan' => $id_jurusan,
                'tingkatan' => $tingkatan,
                'nama_kelas' => $nama_kelas,
                'wali_kelas' => $wali_kelas
            ];
            $this->m_crud->update_data($where, $data, 'tb_kelas');
            $this->session->set_flashdata('success', 'Data berhasil diubah.');
        } else {
            $this->session->set_flashdata('failed', validation_errors());
        }
        redirect(base_url() . 'administrator/kelas');
    }

    public function hapus($id_kelas)
    {
        $where = array(
            'id_kelas' => $id_kelas
        );
        $this->m_crud->delete_data($where, 'tb_kelas');
        $this->session->set_flashdata('success', 'Data berhasil dihapus.');
        redirect(base_url() . 'administrator/kelas');
    }
}
