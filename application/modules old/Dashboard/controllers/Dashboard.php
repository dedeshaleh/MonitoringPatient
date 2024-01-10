<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * CodeIgniter-HMVC
 *
 * @package    CodeIgniter-HMVC
 * @author     N3Cr0N (N3Cr0N@list.ru)
 * @copyright  2019 N3Cr0N
 * @license    https://opensource.org/licenses/MIT  MIT License
 * @link       <URI> (description)
 * @version    GIT: $Id$
 * @since      Version 0.0.1
 * @filesource
 *
 */

// class Webcontrol extends BackendController
class Dashboard extends MY_Controller
{
    //
    public $CI;

    /**
     * An array of variables to be passed through to the
     * view, layout,....
     */
    protected $data = array();

    /**
     * [__construct description]
     *
     * @method __construct
     */
    public function __construct()
    {
        // To inherit directly the attributes of the parent class.
        parent::__construct();
        $this->load->model("M_Dashboard");
        $this->dbProd23 = $this->load->database('dbProd23', TRUE);
    }

    /**
     * [index description]
     *
     * @method index
     *
     * @return [type] [description]
     */
    public function index()
    {
        // Example
        $data['judul'] = "Dashboard";
        $this->template->backend('index', $data);
    }
    public function data_detail()
    {
       
        // $start = $this->input->post("start");
        // echo $start."test";
        $date_awal = $this->input->post("date_awal");
        $date_akhir = $this->input->post("date_akhir");
        $data_search = $this->input->post("data_search");
        $data_payer = $this->input->post("data_payer");
        // var_dump($data_payer);
        
        $hasil = array(
            'draw' => $_POST['draw'],
            'recordsTotal' => $this->M_Dashboard->count_all($date_awal,$date_akhir),
            'recordsFiltered' => $this->M_Dashboard->count_filtered($date_awal,$date_akhir, $data_search, $data_payer),
            "data" => $this->M_Dashboard->get_datatables($date_awal,$date_akhir, $data_search, $data_payer),
        );
        echo json_encode($hasil);

    }
    public function DataChart()
    {
        $Bulan = $this->input->post("Bulan")+1;
        $Tahun = $this->input->post("Tahun");
        $q1 = $this->dbProd23->query("SELECT COUNT(*) AS Total FROM DB_Transaction_Fix.dbo.View_TrackingPatient WHERE Perintah_Pulang_To_Discharge > 120 AND ( MONTH(Date_Registration) = $Bulan and YEAR(Date_Registration) = $Tahun )")->row();
        $q2 = $this->dbProd23->query("SELECT COUNT(*) AS Total FROM DB_Transaction_Fix.dbo.View_TrackingPatient WHERE Discharge_To_Terima_Jaminan > 60 AND ( MONTH(Date_Registration) = $Bulan and YEAR(Date_Registration) = $Tahun)")->row();
        $q3 = $this->dbProd23->query("SELECT COUNT(*) AS Total FROM DB_Transaction_Fix.dbo.View_TrackingPatient WHERE (Perintah_Pulang_To_Discharge <= 120 AND Discharge_To_Terima_Jaminan <= 60) AND ( MONTH(Date_Registration) = $Bulan and YEAR(Date_Registration) = $Tahun )")->row();
        $q4 = $this->dbProd23->query("SELECT COUNT(*) AS Total FROM DB_Transaction_Fix.dbo.View_TrackingPatient WHERE MONTH(Date_Registration) = $Bulan and YEAR(Date_Registration) = $Tahun ")->row();
        $q5 = $this->dbProd23->query("SELECT COUNT(*) AS Total FROM DB_Transaction_Fix.dbo.View_TrackingPatient WHERE (Perintah_Pulang_To_Discharge > 120 OR Discharge_To_Terima_Jaminan > 60) AND MONTH(Date_Registration) = $Bulan and YEAR(Date_Registration) = $Tahun ")->row();
        $data = array(
            'SLA1' => $q1->Total,
            'SLA2' => $q2->Total,
            'SLA3' => $q3->Total,
            'SLA4' => $q4->Total,
            'SLA5' => $q5->Total,
        );
        echo json_encode($data);
    }
    public function DataDetailPasien()
    {
        $IP_Registration_No = $this->input->post("IP_Registration_No");
        $q = $this->dbProd23->query("SELECT a.IP_Registration_No, a.Patient_Name, a.Date_Perintah_Pulang, a.Date_Discharge, a.Date_Terima_Jaminan, a.MR, a.Company_Name FROM View_Journey_RI AS a WHERE IP_Registration_No = '$IP_Registration_No'")->row();
        echo json_encode($q);
    }
}
