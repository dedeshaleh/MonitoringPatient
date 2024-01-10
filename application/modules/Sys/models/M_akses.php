<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_akses extends CI_Model {
    function Aplikasi()
    {
        return $this->db->get('aplikasi');
    }

    function __construct()
    {
         parent::__construct();
    }
    public function GetUser()
    {
        $this->db->select();
        $this->db->from("tbl_user");
        $q = $this->db->get();
        return $q->result();
    }
    public function GetMenu($id=null)
    {
        if ($id!=null) {
            $q = $this->db->query("
            SELECT * FROM (
                SELECT a.id_menu AS id_menu, a.nama_menu AS nama_menu, a.parent_id, b.view_level, b.add_level, b.edit_level, b.delete_level
                            FROM tbl_menu a
                            LEFT JOIN tbl_akses_menu b ON a.id_menu=b.id_menu 
                            WHERE (b.id_user = '$id' OR (b.id_user = '' OR b.id_user IS NULL))
                            AND a.status_menu = '1'
                          
                 UNION
                 SELECT a.id_menu AS id_menu, a.nama_menu AS nama_menu, a.parent_id, b.view_level, b.add_level, b.edit_level, b.delete_level
                            FROM tbl_menu a
                            LEFT JOIN tbl_akses_menu b ON a.id_menu=b.id_menu 
                            WHERE a.status_menu = '1' 
                 ) AS c
                 GROUP BY id_menu, nama_menu, parent_id
                 ORDER BY nama_menu ASC
    
            ");
        }else{
            $q = $this->db->query("SELECT a.id_menu, a.nama_menu, a.parent_id 
            FROM tbl_menu a 
             WHERE a.status_menu = '1'");
        }
        
        return $q->result();
    }
    public function GetMenu2($id=null)
    {
        if ($id!=null) {
            $q = $this->db->query("
            SELECT * FROM (
                SELECT a.id_menu AS id_menu, a.nama_menu AS nama_menu, a.parent_id, b.view_level, b.add_level, b.edit_level, b.delete_level
                            FROM tbl_menu a
                            LEFT JOIN tbl_akses_menu b ON a.id_menu=b.id_menu 
                            WHERE (b.id_user = '$id' OR (b.id_user = '' OR b.id_user IS NULL))
                            AND a.status_menu = '2'
                          
                 UNION
                 SELECT a.id_menu AS id_menu, a.nama_menu AS nama_menu, a.parent_id, b.view_level, b.add_level, b.edit_level, b.delete_level
                            FROM tbl_menu a
                            LEFT JOIN tbl_akses_menu b ON a.id_menu=b.id_menu 
                            WHERE a.status_menu = '2' 
                 ) AS c
                 GROUP BY id_menu, nama_menu, parent_id
                 ORDER BY nama_menu ASC
    
            ");
        }else{
            $q = $this->db->query("SELECT a.id_menu, a.nama_menu, a.parent_id 
            FROM tbl_menu a 
             WHERE a.status_menu = '2'");
        }
        return $q->result();
    }
    public function GetMenu3($id=null)
    {
        if ($id!=null) {
            $q = $this->db->query("
            SELECT * FROM (
                SELECT a.id_menu AS id_menu, a.nama_menu AS nama_menu, a.parent_id, b.view_level, b.add_level, b.edit_level, b.delete_level
                            FROM tbl_menu a
                            LEFT JOIN tbl_akses_menu b ON a.id_menu=b.id_menu 
                            WHERE (b.id_user = '$id' OR (b.id_user = '' OR b.id_user IS NULL))
                            AND a.status_menu = '3'
                          
                 UNION
                 SELECT a.id_menu AS id_menu, a.nama_menu AS nama_menu, a.parent_id, b.view_level, b.add_level, b.edit_level, b.delete_level
                            FROM tbl_menu a
                            LEFT JOIN tbl_akses_menu b ON a.id_menu=b.id_menu 
                            WHERE a.status_menu = '3' 
                 ) AS c
                 GROUP BY id_menu, nama_menu, parent_id
                 ORDER BY nama_menu ASC
    
            "); 
        }else{
            $q = $this->db->query("SELECT a.id_menu, a.nama_menu, a.parent_id 
            FROM tbl_menu a 
             WHERE a.status_menu = '3'");
        }
        return $q->result();
    }
    public function UpdateData($id_user,$id_menu, $data)
    {
        $this->db->where('id_user', $id_user);
        $this->db->where('id_menu', $id_menu);
        $this->db->update('tbl_akses_menu', $data);
    }
}

/* End of file Mod_login.php */
