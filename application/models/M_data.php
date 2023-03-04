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
}
