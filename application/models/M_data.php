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

    public function absensi_masuk()
    {
        $this->db->order_by('tgl_masuk', 'DESC');
        $this->db->order_by('jam_masuk', 'DESC');
        $this->db->where('tgl_masuk', date('Y-m-d'));
        return $this->db->get('tb_hadir');
    }

    public function absensi_keluar()
    {
        $this->db->order_by('tgl_masuk', 'DESC');
        $this->db->order_by('jam_keluar', 'DESC');
        $this->db->where('tgl_masuk', date('Y-m-d'));
        return $this->db->get('tb_hadir');
    }

    public function absensi_masuk_d()
    {
        $this->db->order_by('tgl_masuk', 'DESC');
        $this->db->order_by('jam_masuk', 'DESC');
        return $this->db->get('tb_hadir');
    }

    public function absensi_keluar_d()
    {
        $this->db->order_by('tgl_masuk', 'DESC');
        $this->db->order_by('jam_keluar', 'DESC');
        return $this->db->get('tb_hadir');
    }

    function filter_absensi($id_jurusan, $id_kelas, $dari_tgl, $sampai_tgl, $status)
    {
        $this->db->order_by('id_hadir', 'DESC')
            ->from('tb_hadir')
            ->join('tb_siswa', 'tb_siswa.id_siswa = tb_hadir.id_siswa')

            ->where('tgl_masuk >=', $dari_tgl)
            ->where('tgl_masuk <=', $sampai_tgl);
        if ($id_jurusan != 'kosong') {
            $this->db->where('id_jurusan', $id_jurusan);
        }
        if ($id_kelas != 'kosong') {
            $this->db->where('id_kelas', $id_kelas);
        }
        if ($status != 'kosong') {
            $this->db->where('status', $status);
        }
        return $this->db->get();
    }

    function filter_laporan($id_jurusan, $id_kelas, $dari_tgl, $sampai_tgl, $status)
    {
        $this->db->order_by('id_hadir', 'DESC');

        $this->db->from('tb_hadir');

        $this->db->select('nis');
        $this->db->select('nama_siswa');
        $this->db->select('id_kelas');

        $this->db->distinct('nis');

        $this->db->join('tb_siswa', 'tb_siswa.id_siswa = tb_hadir.id_siswa');

        $this->db->where('tgl_masuk >=', $dari_tgl);
        $this->db->where('tgl_masuk <=', $sampai_tgl);

        if ($id_jurusan != 'kosong') {
            $this->db->where('id_jurusan', $id_jurusan);
        }
        if ($id_kelas != 'kosong') {
            $this->db->where('id_kelas', $id_kelas);
        }
        if ($status != 'kosong') {
            $this->db->where('status', $status);
        }
        return $this->db->get();
    }

    function jumlah_hadir_bertanggal($where, $dari_tgl, $sampai_tgl)
    {
        $this->db->from('tb_hadir');
        $this->db->where($where);
        $this->db->where('tgl_masuk >=', $dari_tgl);
        $this->db->where('tgl_masuk <=', $sampai_tgl);
        return $this->db->get();
    }

    function get_hari($dari_tgl, $sampai_tgl)
    {
        $this->db->from('tb_hari');
        $this->db->where('tgl >=', $dari_tgl);
        $this->db->where('tgl <=', $sampai_tgl);
        return $this->db->get();
    }

    function getSiswa($data, $where, $not_in)
    {
        $this->db->from('tb_siswa');
        $this->db->where($data, $where);
        $this->db->where_not_in('pin', $not_in);
        return $this->db->get();
    }

    function get_tgl($order_by)
    {
        $this->db->order_by('id_hari', $order_by);
        $this->db->select('tgl');
        $this->db->from('tb_hari');
        $this->db->limit('1');
        return $this->db->get();
    }

    public function deleteAllDataHari()
    {
        $this->db->empty_table('tb_hari');
    }

    public function getAbsensiData($id_kelas, $tgl_masuk)
    {
        $this->db->select('CONCAT(tb_kelas.tingkatan, " ", tb_jurusan.inisial, " ", tb_kelas.nama_kelas) AS nama_kelas');
        $this->db->select('COUNT(CASE WHEN tb_hadir.status = "Hadir" THEN 1 END) AS total_hadir');
        $this->db->select('COUNT(CASE WHEN tb_hadir.status = "Sakit" THEN 1 END) AS total_sakit');
        $this->db->select('COUNT(CASE WHEN tb_hadir.status = "Izin" THEN 1 END) AS total_izin');
        $this->db->select('COUNT(CASE WHEN tb_hadir.status = "Dispen" THEN 1 END) AS total_dispen');
        $this->db->from('tb_kelas');
        $this->db->join('tb_jurusan', 'tb_kelas.id_jurusan = tb_jurusan.id_jurusan');
        $this->db->join('tb_siswa', 'tb_kelas.id_kelas = tb_siswa.id_kelas', 'left');
        $this->db->join('tb_hadir', 'tb_siswa.id_siswa = tb_hadir.id_siswa', 'left');
        $this->db->where('tb_kelas.id_kelas', $id_kelas);
        $this->db->where('tb_hadir.tgl_masuk', $tgl_masuk);
        $this->db->group_by('tb_kelas.id_kelas');
        $query = $this->db->get();

        return $query->result();
    }

    
}
