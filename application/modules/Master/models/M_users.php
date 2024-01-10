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
        $this->db->join("tbl_userlevel", 'tbl_userlevel.id_level = tbl_user.id_level', 'LEFT');
        $q = $this->db->get();
        return $q->result();
    }

    public function DelMaster($id_user)
    {
        $this->db->where('id_user', $id_user);
        $this->db->delete('tbl_user');
    }

    public function DelHakAkses($id_user)
    {
        $this->db->where('id_user', $id_user);
        $this->db->delete('tbl_akses_menu');
    }

}

/* End of file Mod_login.php */
