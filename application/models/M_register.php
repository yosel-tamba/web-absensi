<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_register extends CI_Model {
    function cek_register($table,$where)
    {
        return $this->db->insert($table,$where);
    }
}