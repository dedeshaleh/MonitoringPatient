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
class DataPasien extends MY_Controller
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
        $this->load->model("M_DataPasien");
        $this->dbProd23 = $this->load->database('dbProd23', TRUE);
        // $this->dbProd66 = $this->load->database('dbProd66', TRUE);		
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

        $data['judul'] = "Data Pasien";
        $data['keyPasien'] = $this->session->userdata('KeyPasien');
        $KeyPasien = $this->session->userdata('KeyPasien');
        $q = $this->dbProd23->query("SELECT 
                                  a.Date_Perintah_Pulang , a.Last_Order_EKTM_Obat, a.Last_Terima_EKTM_Obat, 
                                  a.Date_Last_Order_Presc, a.Date_Last_Confrm_Presc,  
                                  a.Date_Last_Retur_Presc, a.Date_Confrm_Retur_Presc, 
                                  a.Date_Discharge, a.Date_Kirim_Jaminan, a.Date_Terima_Jaminan, 
                                  a.Date_Invoice, a.Date_Leave_Room 
                                  FROM View_TrackingPatient AS a 
                                  WHERE IP_Registration_No = '$KeyPasien'")->row();
        // if ($q->Date_Leave_Room == null || $q->Date_Leave_Room == '1990-01-01 00:00:00') {
            
        // }else{
        //     redirect('DataPasien/CekSessionPasien');
        // }
        $this->template->Pasien('index', $data);
    }
    public function CekDetailPasien()
    {
      $KeyPasien = $this->session->userdata('KeyPasien');
	 
      $q = $this->dbProd23->query("SELECT 
                                  a.Date_Perintah_Pulang , a.Last_Order_EKTM_Obat, a.Last_Terima_EKTM_Obat, 
                                  a.Date_Last_Order_Presc, a.Date_Last_Confrm_Presc,  
                                  a.Date_Last_Retur_Presc, a.Date_Confrm_Retur_Presc, 
                                  a.Date_Discharge, a.Date_Kirim_Jaminan, a.Date_Terima_Jaminan, 
                                  a.Date_Invoice, a.Date_Leave_Room 
                                  FROM View_TrackingPatient AS a 
                                  WHERE IP_Registration_No = '$KeyPasien'")->row();
							  
        foreach ($q as $key => $value) {
            $cekHead[] = $key;
        }
        sort($cekHead);

        for ($i=0; $i < count($cekHead); $i++) { 
            $val = $this->dbProd23->query("SELECT $cekHead[$i] FROM View_TrackingPatient AS a 
            WHERE IP_Registration_No = '$KeyPasien'")->row();
            $Vall = $cekHead[$i];
            $data[] = array(
                'Value' => $val->$Vall,
                'IIP' => $KeyPasien,
                'NamaKolom' => $cekHead[$i]
                
            );
        }
        rsort($data);

        $DataPasienLengkap = $this->dbProd23->query("SELECT A.Patient_Name, B.Patient_Name, DOB FROM DB_Transaction_Fix.dbo.RI_Tran_Registrasi A
        LEFT JOIN DB_Master_Fix.dbo.Pasien B ON A.MR_No = B.MR_No
        WHERE A.IP_Registration_No = '$KeyPasien'")->row();
        $arr =array(
            'DatePerintahPulang' => $q->Date_Perintah_Pulang,
            'DataDetail' => $data,
            'DataPasien' => $DataPasienLengkap
        );
      echo json_encode($arr);
    }
}
