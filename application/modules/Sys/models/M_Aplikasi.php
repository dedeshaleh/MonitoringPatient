<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Aplikasi extends CI_Model {
    function Aplikasi()
    {
        return $this->db->get('aplikasi');
    }

    function __construct()
    {
         parent::__construct();
    }
    public function Get_aplikasi()
    {
        $this->db->select();
        $this->db->from("aplikasi");
        $q = $this->db->get();
        return $q->result();
    }

}

/* End of file Mod_login.php */
