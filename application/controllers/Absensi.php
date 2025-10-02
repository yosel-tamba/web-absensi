<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absensi extends CI_Controller
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
        $pin = $this->input->post('pin');

        $where = [
            'pin' => $pin
        ];

        $cek_siswa = $this->m_crud->edit_data($where, 'tb_siswa')->num_rows();
        $siswa = $this->m_crud->edit_data($where, 'tb_siswa')->row();
        if ($cek_siswa > 0) {
            $where = [
                'id_siswa' => $siswa->id_siswa,
                'tgl_masuk' => date('Y-m-d')
            ];

            $cek = $this->m_crud->edit_data($where, 'tb_hadir')->num_rows();
            if ($cek > 0) {
                if (date('H:i:s') > "14:00:00" && date('H:i:s') < "23:59:59") {
                    $data = [
                        'jam_keluar' => date('H:i:s')
                    ];
                    $this->m_crud->update_data($where, $data, 'tb_hadir');
                    $this->session->set_flashdata('success', $siswa->nama_siswa . ' Sudah Pulang');
                } else {
                    $data = [
                        'tgl_masuk' => date('Y-m-d'),
                        'jam_masuk' => date('H:i:s')
                    ];
                    $this->m_crud->update_data($where, $data, 'tb_hadir');
                    $this->session->set_flashdata('success', $siswa->nama_siswa . ' Sudah Hadir');
                }
            } else {
                $data = [
                    'id_siswa' => $siswa->id_siswa,
                    'status' => 'Hadir',
                    'tgl_masuk' => date('Y-m-d'),
                    'jam_masuk' => date('H:i:s')
                ];
                $this->m_crud->insert_data($data, 'tb_hadir');
                $this->session->set_flashdata('success', $siswa->nama_siswa . ' Baru Saja Hadir');
            }
        } else {
            $this->session->set_flashdata('failed', 'PIN tidak terdaftar');
        }
        redirect(base_url());
    }

    public function getStatus()
    {
        // misalnya $hari diambil dari database
        $hari = $this->db->get_where('hari_libur', ['status' => 1])->row();
        $status = empty($hari) ? 'disabled' : '';
        
        echo json_encode(['status' => $status]);
    }
    
}
