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
class Bed extends MY_Controller
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
		if (!$this->session->userdata('logStatus') == 'MPLogin') {
            redirect();
        }
        // To inherit directly the attributes of the parent class.
        parent::__construct();
        $this->load->model("M_bed");
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
        $data['judul'] = "Data Kamar";
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
            'recordsTotal' => $this->M_bed->count_all($date_awal,$date_akhir),
            'recordsFiltered' => $this->M_bed->count_filtered($date_awal,$date_akhir, $data_search, $data_payer),
            "data" => $this->M_bed->get_datatables($date_awal,$date_akhir, $data_search, $data_payer),
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
        $q = $this->dbProd23->query("SELECT * FROM View_Journey_RI AS a WHERE IP_Registration_No = '$IP_Registration_No'")->row();
        $q2 = $this->dbProd23->query("SELECT  DISTINCT(ax.Doctor), ax.IP_Registration_No, ax.DoctorType, bx.Doctor_Name FROM (
            SELECT 'DPJP' AS DoctorType, a.IP_Registration_No, a.Doctor_In_Charge AS Doctor FROM dbo.RI_Tran_Registrasi a
            WHERE a.IP_Registration_No = '$IP_Registration_No'
            UNION 
            SELECT 'Doktor Praktek' AS DoctorType, b.Tran_No, b.Doctor_Pratice FROM dbo.RI_Tran_FAC_Detail b 
            WHERE b.Tran_No = '$IP_Registration_No'
            UNION
            SELECT 'Doktor Refferal' AS DoctorType, c.IP_Registration_No, c.Referring_Doctors FROM dbo.RI_Tran_Registrasi c
            WHERE c.IP_Registration_No = '$IP_Registration_No'
            UNION
            SELECT 'Doktor Join' AS DoctorType, d.Registratiion_No, d.Doctor_Code FROM dbo.RI_Tran_Join_Care d 
            WHERE d.Registratiion_No = '$IP_Registration_No' AND d.Doctor_Code NOT IN (SELECT a.Doctor_In_Charge AS Doctor FROM dbo.RI_Tran_Registrasi a
            WHERE a.IP_Registration_No = '$IP_Registration_No')
            ) AS ax
            LEFT JOIN DB_Master_Fix.dbo.Dokter bx ON bx.Doctor_Code = ax.Doctor
            ")->result();
        $data = array(
            'Detail' => $q,
            'Dokter' => $q2
        );
        echo json_encode($data);
    }

    public function CekKamar()
    {
        $data = $this->dbProd23->query("SELECT A.Ward_Code,  C.Description, (SELECT COUNT(*) FROM DB_Master_Fix.dbo.RI_Bed_Per_Room B WHERE B.Ward = A.Ward_Code AND Mr_No <> '' ) AS Terpakai, A.Bed 
        FROM DB_Master_Fix.dbo.Master_Total_Bed A
        LEFT JOIN DB_Master_Fix.dbo.RI_Ward C ON C.Ward_Code = A.Ward_Code
        WHERE A.Active = '1' AND A.Ward_Code NOT IN ('IC', 'NC', 'HCU', 'EMM', 'ISOL')  
      ")->result();
        $TotalKamar = $this->dbProd23->query("SELECT SUM(Bed) AS TotalKamar FROM DB_Master_Fix.dbo.Master_Total_Bed WHERE Active = 1 AND Ward_Code NOT IN ('PHANTOM', 'EMM', 'IC', 'NC', 'HCU', 'EMM', 'ISOL')")->row();
        $Terpakai = $this->dbProd23->query("SELECT COUNT(*) AS TotalTerpakai FROM DB_Master_Fix.dbo.RI_Bed_Per_Room B WHERE MR_No <> '' AND B.Ward NOT IN ('PHANTOM', 'EMM', 'IC', 'NC', 'HCU', 'EMM', 'ISOL')")->row();
        $arr = array(
            'Kamar' => $data,
            "totalKamar" => $TotalKamar,
            "TotalTerpakai" => $Terpakai
        );
        echo json_encode($arr);
    }

    public function CekDetail()
    {
        $json = file_get_contents("php://input"); // json string
        $object = json_decode($json); // php object

        if ($object->Ward_Code == 'ICU/ICCU/HCU') {
            $Obj = " 'ICU', 'ICCU', 'HCU' ";
            $data = $this->dbProd23->query("SELECT B.*, ('ICU/ICCU/HCU') AS Description FROM DB_Master_Fix.dbo.RI_Bed_Per_Room B LEFT JOIN DB_Master_Fix.dbo.RI_Ward C ON C.Ward_Code = B.Room WHERE B.Room IN ($Obj) ORDER BY B.Room ASC")->result();
        }else if ($object->Ward_Code == "ISOL   ") {
            $data = $this->dbProd23->query("SELECT B.*, ('Isolasi') AS Description FROM DB_Master_Fix.dbo.RI_Bed_Per_Room B LEFT JOIN DB_Master_Fix.dbo.RI_Ward C ON C.Ward_Code = B.Room WHERE B.Class LIKE '%ISO%' ORDER BY B.Room ASC")->result();
        }else if ($object->Ward_Code == 'NICU/PICU') {
            $Obj = " 'PICU', 'NICU' ";
            $data = $this->dbProd23->query("SELECT B.*, ('NIPU/PICU') AS Description FROM DB_Master_Fix.dbo.RI_Bed_Per_Room B LEFT JOIN DB_Master_Fix.dbo.RI_Ward C ON C.Ward_Code = B.Room WHERE B.Room IN ($Obj) ORDER BY B.Room ASC")->result();
        }else{
            $Obj = $object->Ward_Code;
            $data = $this->dbProd23->query("SELECT B.*, C.Description FROM DB_Master_Fix.dbo.RI_Bed_Per_Room B LEFT JOIN DB_Master_Fix.dbo.RI_Ward C ON C.Ward_Code = B.Ward WHERE B.Ward = '$Obj' AND B.Class NOT IN ('', 'ISO', 'PHANTOM') ORDER BY B.Room ASC")->result();
        }
    //    echo $object->Ward_Code;
    //    exit();/
        echo json_encode($data);
    }

    public function CekKamarChart()
    {
        $data = $this->dbProd23->query("SELECT A.Ward_Code, A.Bed
        FROM DB_Master_Fix.dbo.Master_Total_Bed A
        LEFT JOIN DB_Master_Fix.dbo.RI_Ward C ON C.Ward_Code = A.Ward_Code
        WHERE A.Active = '1' AND A.Ward_Code NOT IN ('IC', 'NC', 'HCU', 'EMM', 'ISOL')  
     
        ")->result();
        
        foreach ($data as $x) {
            $dataGet[] = $x->Ward_Code;
            if ($x->Ward_Code == 'ICU/ICCU/HCU') {
                $tot = $this->dbProd23->query("SELECT COUNT(*) AS Total FROM DB_Transaction_Fix.dbo.RI_Tran_Registrasi A WHERE A.Class_Location IN ('ICU', 'ICCU', 'HCU') AND MONTH(A.Check_Out_Date) = '03' AND YEAR(A.Check_Out_Date) = '2023'")->row();
            }else if ($x->Ward_Code == "ISOL   ") {
                $tot = 0;
            }else if ($x->Ward_Code == 'NICU/PICU') {
                $tot = $this->dbProd23->query("SELECT COUNT(*) AS Total FROM DB_Transaction_Fix.dbo.RI_Tran_Registrasi A WHERE A.Class_Location IN ('NICU', 'PICU') AND MONTH(A.Check_Out_Date) = '03' AND YEAR(A.Check_Out_Date) = '2023'")->row();

            }else{
                $tot = $this->dbProd23->query("SELECT COUNT(*) AS Total FROM DB_Master_Fix.dbo.RI_Bed_Per_Room A WHERE MR_No <> '' AND A.Ward = '$x->Ward_Code' ")->row();
            }
            $dataPasien['data']['Terpakai'][] = $tot->Total;
        }

        foreach ($data as $x) {
            if ($x->Ward_Code == 'ICU/ICCU/HCU') {
                $tot = $this->dbProd23->query("SELECT COUNT(*) AS Total FROM DB_Transaction_Fix.dbo.RI_Tran_Registrasi A WHERE A.Class_Location IN ('ICU', 'ICCU', 'HCU') AND MONTH(A.Check_Out_Date) = '03' AND YEAR(A.Check_Out_Date) = '2023'")->row();
            }else if ($x->Ward_Code == "ISOL   ") {
                $tot = 0;
            }else if ($x->Ward_Code == 'NICU/PICU') {
                $tot = $this->dbProd23->query("SELECT COUNT(*) AS Total FROM DB_Transaction_Fix.dbo.RI_Tran_Registrasi A WHERE A.Class_Location IN ('NICU', 'PICU') AND MONTH(A.Check_Out_Date) = '03' AND YEAR(A.Check_Out_Date) = '2023'")->row();

            }else{
                $tot = $this->dbProd23->query("SELECT COUNT(*) AS Total FROM DB_Master_Fix.dbo.RI_Bed_Per_Room A WHERE MR_No <> '' AND A.Ward = '$x->Ward_Code' ")->row();
            }
            $dataPasien['data']['Tersedia'][] = $x->Bed - $tot->Total;
        }
        foreach ($data as $x) {
            $tot = $this->dbProd23->query("SELECT A.Bed FROM DB_Master_Fix.dbo.Master_Total_Bed A WHERE A.Ward_Code = '$x->Ward_Code' ")->row();
            $dataPasien['data']['Total'][] = $tot->Bed;
        }
        
        $arr = array(
            'Kamar' => $dataGet,
            'TotalPemakaian' => $dataPasien['data']
        );
        echo json_encode($arr);
    }
}
