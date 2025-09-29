<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Listkelas extends CI_Controller
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
        $id_jurusan = $this->input->post('id_jurusan');
        $kelas = $this->m_data->viewByJurusan($id_jurusan);
        $lists = "
        <label for='id_kelas' class='form-label'>Kelas</label>
                    <select class='custom-select' id='id_kelas' name='id_kelas'>
                        <option disabled selected>-- Pilih Kelas --</option>
                    
        ";
        foreach ($kelas as $data) {
            $where = ['id_jurusan' => $data->id_jurusan];
            $jurusans = $this->m_crud->edit_data($where, 'tb_jurusan')->result();
            foreach ($jurusans as $j) {
                $lists .= "<option value='" . $data->id_kelas . "'>" .
                    $data->tingkatan . ' ' . $j->inisial . ' ' . $data->nama_kelas
                    . "</option>";
            }
        }
        $callback = array('list_kelas' => $lists);
        echo json_encode($callback);
    }

    public function getDataForDiagram()
    {
        if (isset($_GET['id_kelas'])) {
            $id_kelas = $_GET['id_kelas'];
            $tgl_masuk = date('Y-m-d');
            $where = [
                'id_kelas' => $id_kelas
            ];
            $absensi_data = $this->m_data->getAbsensiData($id_kelas, $tgl_masuk);
            $total_siswa = $this->m_crud->edit_data($where, 'tb_siswa')->num_rows();

            // Initialize variables
            $hadir = 0;
            $sakit = 0;
            $izin = 0;
            $dispen = 0;
            $alpha = 0;

            if (!empty($absensi_data)) {
                $absensi_record = $absensi_data[0];

                // Extract data from the record
                $hadir = $absensi_record->total_hadir;
                $sakit = $absensi_record->total_sakit;
                $izin = $absensi_record->total_izin;
                $dispen = $absensi_record->total_dispen;
                $alpha = $total_siswa - ($hadir + $sakit + $izin + $dispen);
            }

            $data = [
                'hadir' => $hadir,
                'sakit' => $sakit,
                'izin' => $izin,
                'dispen' => $dispen,
                'alpha' => $alpha,
            ];

            echo json_encode($data);
        } else {
            echo "Invalid request";
        }
    }
}
