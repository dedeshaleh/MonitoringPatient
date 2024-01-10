<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_LapPatientAno extends CI_Model {


    function __construct()
    {
         parent::__construct();
         $this->dbProd23 = $this->load->database('dbProd23', TRUE);
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

    function check_db($username)
    {
        return $this->db->get_where('tbl_user', array('username' => $username));
    }
    public function count_all($date_awal=null,$date_akhir=null)
    {
        $this->dbProd23->select();
        $this->dbProd23->from("dbo.View_TrackingPatient");
        if ($date_awal != null && $date_akhir != null) {
            $this->dbProd23->where("( Tgl_Regis BETWEEN '$date_awal' AND '$date_akhir')");
        }else if ($date_awal != null) {
            $this->dbProd23->where(" Tgl_Regis = '$date_awal'");
        }else if ($date_akhir != null) {
            $this->dbProd23->where(" Tgl_Regis = '$date_akhir'");
        }
        $this->dbProd23->where("status_data LIKE 'I%'");
        return $this->dbProd23->count_all_results();
    }

    var $order = array('a.Date_Registration' => 'DESC'); // default order 
    private function _get_datatables_query($term = '',$date_awal=null,$date_akhir=null)
    {
       
        $column = array("", "a.MR_No", "a.Patient_Name", "a.Ward", "a.Company_Name", "a.Date_Registration", "a.Status_Data", "a.Date_Perintah_Pulang" , "a.No_EKTM", "a.Last_Order_EKTM_Obat", "a.UserKePDS", "a.Last_Terima_EKTM_Obat", "a.UserTerimaPDS", "a.Date_Last_Order_Presc", "a.User_Last_Order_Presc", "a.Date_Last_Confrm_Presc", "a.User_Last_Confrm_Presc", "a.Date_Last_Retur_Presc", "a.User_Last_Retur_Presc", "a.Date_Confrm_Retur_Presc", "a.User_Confrm_Retur_Presc", "a.Date_Discharge", "a.User_Discharge", "a.Date_Kirim_Jaminan", "a.User_Kirim_Jaminan", "a.Date_Terima_Jaminan", "a.User_Terima_Jaminan", "a.Keterangan_Terima_Jaminan", "a.Date_Invoice", "a.User_Invoice", "a.Date_Leave_Room", "a.User_Leave_Room", "a.Perintah_Pulang_To_Discharge", "a.Discharge_To_Terima_Jaminan", "a.PerintahPulang_To_EKTM"); //Sesuaikan dengan field
        $this->dbProd23->select("a.IP_Registration_No, a.MR_No, a.Patient_Name, a.Ward, a.Company_Name, a.Date_Registration, a.Status_Data, a.Date_Perintah_Pulang , a.No_EKTM, a.Last_Order_EKTM_Obat, a.UserKePDS, a.Last_Terima_EKTM_Obat, a.UserTerimaPDS, a.Date_Last_Order_Presc, a.User_Last_Order_Presc, a.Date_Last_Confrm_Presc, a.User_Last_Confrm_Presc, a.Date_Last_Retur_Presc, a.User_Last_Retur_Presc, a.Date_Confrm_Retur_Presc, a.User_Confrm_Retur_Presc, a.Date_Discharge, a.User_Discharge, a.Date_Kirim_Jaminan, a.User_Kirim_Jaminan, a.Date_Terima_Jaminan, a.User_Terima_Jaminan, a.Keterangan_Terima_Jaminan, a.Date_Invoice, a.User_Invoice, a.Date_Leave_Room, a.User_Leave_Room, a.Perintah_Pulang_To_Discharge, a.Discharge_To_Terima_Jaminan, a.PerintahPulang_To_EKTM");
        // $this->dbProd23->select();
        $this->dbProd23->from("View_TrackingPatient AS a");
        // if ($this->session->userdata('level') == '2' OR $this->session->userdata('level') == "karyawan") {
        //     $this->db->where("(peserta.nik = '$nik' OR training.pembicara like '%$karyawan%')");
        // }
        // if ($karyawan != null) {
        //     $this->db->where("(peserta.nik = '$karyawan' OR training.pembicara like '%$karyawan%')");
        // }
        $this->dbProd23->where(" ( Discharge_To_Terima_Jaminan > 60 OR Perintah_Pulang_To_Discharge > 120 ) ");
        if ($date_awal != null && $date_akhir != null) {
            $this->dbProd23->where(" (Tgl_Regis BETWEEN '$date_awal' AND '$date_akhir' )");
        }else if ($date_awal != null) {
            $this->dbProd23->where(" Tgl_Regis = '$date_awal'");
        }else if ($date_akhir != null) {
            $this->dbProd23->where(" Tgl_Regis = '$date_akhir'");
        }
        // $this->dbProd23->where("status_data LIKE 'i%'");
        $this->dbProd23->where(" a.MR_No LIKE '%$term%' ");
        // $this->dbProd23->where(" Date_Terima_Jaminan != '1901'");
        // $this->db->like('training.topik', $term);
        // $this->db->or_like('training.pembicara', $term);
        $this->dbProd23->where("status_data LIKE 'I%'");
        if (isset($_REQUEST['order'])) {
            $this->dbProd23->order_by($column[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->dbProd23->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables($date_awal=null,$date_akhir=null)
    {
        $term = $_REQUEST['search']['value'];
        $this->_get_datatables_query($term,$date_awal,$date_akhir);
        if ($_POST['length'] != -1)
            $this->dbProd23->limit($_REQUEST['length'], $_REQUEST['start']);
        
        $query = $this->dbProd23->get();
        return $query->result();
    }

    function count_filtered($date_awal=null,$date_akhir=null)
    {
        $term = $_REQUEST['search']['value'];
        $this->_get_datatables_query($term,$date_awal,$date_akhir);
        $query = $this->dbProd23->get();
        return $query->num_rows();
    }

    public function getData()
    {
        // $data_q = $this->dbProd23->query("SELECT * FROM View_TrackingPatient WHERE Date_Registration BETWEEN '2022-10-01' AND '2022-12-12'")->result();
        $this->dbProd23->select();
        $this->dbProd23->from("View_TrackingPatient");
        $q_data = $this->dbProd23->get();
        return $q_data->result();
    }

    public function getDataAll($date_awal=null, $date_akhir=null)
    {
        // $this->dbProd23->select("a.IP_Registration_No, a.MR_No, a.Patient_Name, a.Company_Name, a.Date_Registration, a.Status_Data, a.Date_Perintah_Pulang , a.No_EKTM, a.Date_Ke_PDS, a.Date_Terima_PDS, a.Date_Last_Order_Presc, a.User_Last_Order_Presc, a.Date_Last_Confrm_Presc, a.User_Last_Confrm_Presc, a.Date_Last_Retur_Presc, a.User_Last_Retur_Presc, a.Date_Confrm_Retur_Presc, a.User_Confrm_Retur_Presc, a.Date_Discharge, a.User_Discharge, a.Date_Kirim_Jaminan, a.User_Kirim_Jaminan, a.Date_Terima_Jaminan, a.User_Terima_Jaminan, a.Keterangan_Terima_Jaminan, a.Date_Invoice, a.User_Invoice, a.Date_Leave_Room, a.User_Leave_Room");
        $this->dbProd23->select();
        $this->dbProd23->from("View_TrackingPatient a");
        $this->dbProd23->where(" ( Discharge_To_Terima_Jaminan > 60 OR Perintah_Pulang_To_Discharge > 120 ) ");
        if ($date_awal != null && $date_akhir != null) {
            $this->dbProd23->where("( Tgl_Regis BETWEEN '$date_awal' AND '$date_akhir')");
        }else if ($date_awal != null) {
            $this->dbProd23->where(" Tgl_Regis = '$date_awal'");
        }else if ($date_akhir != null) {
            $this->dbProd23->where(" Tgl_Regis = '$date_akhir'");
        }
        $this->dbProd23->where("status_data LIKE 'I%'");
        $q = $this->dbProd23->get();
        return $q->result();

    }

}

/* End of file Mod_login.php */
