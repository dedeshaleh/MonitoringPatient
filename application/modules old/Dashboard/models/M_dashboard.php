<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dashboard extends CI_Model {


    function __construct()
    {
         parent::__construct();
         $this->dbProd23 = $this->load->database('dbProd23', TRUE);
         $this->dbProd66 = $this->load->database('dbProd66', TRUE);
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
        $this->dbProd23->from("dbo.View_Journey_RI");
        if ($date_awal != null && $date_akhir != null) {
            $this->dbProd23->where("( convert(varchar, Date_Registration, 23) BETWEEN '$date_awal' AND '$date_akhir')");
        }else if ($date_awal != null) {
            $this->dbProd23->where(" convert(varchar, Date_Registration, 23) = '$date_awal'");
        }else if ($date_akhir != null) {
            $this->dbProd23->where(" convert(varchar, Date_Registration, 23) = '$date_akhir'");
        }
        return $this->dbProd23->count_all_results();
    }

    var $order = array('a.Date_Registration' => 'DESC'); // default order 
    private function _get_datatables_query($term = '',$date_awal=null,$date_akhir=null,$data_search=null,$data_payer=null)
    {
       
        $column = array("", "a.Patient_Name", "a.Date_Perintah_Pulang", "a.Date_Discharge", "a.Date_Terima_Jaminan", "a.MR", "a.Company_Name"); //Sesuaikan dengan field
        $this->dbProd23->select("a.IP_Registration_No, a.Patient_Name, a.Date_Perintah_Pulang, a.Date_Discharge, a.Date_Terima_Jaminan, a.MR, a.Company_Name");
        $this->dbProd23->from("View_Journey_RI AS a");
        // if ($this->session->userdata('level') == '2' OR $this->session->userdata('level') == "karyawan") {
        //     $this->db->where("(peserta.nik = '$nik' OR training.pembicara like '%$karyawan%')");
        // }
        // if ($karyawan != null) {
        //     $this->db->where("(peserta.nik = '$karyawan' OR training.pembicara like '%$karyawan%')");
        // }
        if ($date_awal != null && $date_akhir != null) {
            $this->dbProd23->where("( convert(varchar, Date_Registration, 23) BETWEEN '$date_awal' AND '$date_akhir')");
        }else if ($date_awal != null) {
            $this->dbProd23->where(" convert(varchar, Date_Registration, 23) = '$date_awal'");
        }else if ($date_akhir != null) {
            $this->dbProd23->where(" convert(varchar, Date_Registration, 23) = '$date_akhir'");
        }
        
        $this->dbProd23->where(" a.Patient_Name LIKE '%$data_search%'");
        $this->dbProd23->where(" a.Company_Name LIKE '%$data_payer%' ");
        // $this->dbProd23->where(" convert(varchar, Date_Terima_Jaminan, 23) != '1901'");
        // $this->db->like('training.topik', $term);
        // $this->db->or_like('training.pembicara', $term);

        if (isset($_REQUEST['order'])) {
            $this->dbProd23->order_by($column[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->dbProd23->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables($date_awal=null,$date_akhir=null,$data_search=null,$data_payer=null)
    {
        $term = $_REQUEST['search']['value'];
        $this->_get_datatables_query($term,$date_awal,$date_akhir,$data_search,$data_payer);
        if ($_POST['length'] != -1)
            $this->dbProd23->limit($_REQUEST['length'], $_REQUEST['start']);
        
        $query = $this->dbProd23->get();
        return $query->result();
    }

    function count_filtered($date_awal=null,$date_akhir=null,$data_search=null,$data_payer=null)
    {
        $term = $_REQUEST['search']['value'];
        $this->_get_datatables_query($term,$date_awal,$date_akhir,$data_search,$data_payer);
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

}

/* End of file Mod_login.php */
