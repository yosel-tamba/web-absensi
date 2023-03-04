<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_data extends CI_Model
{
    public function viewByJurusan($id_jurusan)
    {
        $this->db->where('id_jurusan', $id_jurusan);
        $result = $this->db->get('tb_kelas')->result();

        return $result;
    }

    public function kehadiran()
    {
        $this->db->order_by('id_hadir', 'desc');
        return $this->db->from('tb_hadir')
            ->join('tb_siswa', 'tb_siswa.id_siswa = tb_siswa.id_siswa')
            ->get();
    }
}
