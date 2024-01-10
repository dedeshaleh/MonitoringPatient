<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_users extends CI_Model {
    function Aplikasi()
    {
        return $this->db->get('aplikasi');
    }

    function __construct()
    {
         parent::__construct();
    }
    public function Get_users()
    {
        $this->db->select();
        $this->db->from("tbl_user");
        $this->db->join("tbl_userlevel", 'tbl_userlevel.id_level = tbl_user.id_level', 'LEFT JOIN');
        $q = $this->db->get();
        return $q->result();
    }

}

/* End of file Mod_login.php */
