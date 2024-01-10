<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_LMA extends CI_Model {


    function __construct()
    {
         parent::__construct();
         $this->dbProd23 = $this->load->database('dbProd23', TRUE);
         $this->dbProd66 = $this->load->database('dbProd66', TRUE);
         $this->dbDev = $this->load->database('dbDev', TRUE);
    }

    function Aplikasi()
    {
        return $this->db->get('aplikasi');
    }

    function Auth($username, $password)
    {

        //menggunakan active record . untuk menghindari sql injection
        $this->db->where("username", $username);
        $this->db->where("password", $password);
        $this->db->where("is_active", 'Y');
        return $this->db->get("tbl_user");    
    }
    public function UpdateDataLMA($No_Regis, $DataUpdate)
    {
        $this->dbDev->where('No_Regis', $No_Regis);
        $this->dbDev->update('Laporan_Medis_Awal', $DataUpdate);
    }

    public function UpdateDataLMAtoFix($No_Regis, $DataUpdate)
    {
        $this->dbDev->where('No_Regis', $No_Regis);
        $this->dbDev->update('Laporan_Medis_Awal', $DataUpdate);
    }

}

/* End of file Mod_login.php */
