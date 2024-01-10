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
class CekSessionPasien extends MY_Controller
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
        $data['NamaPasien'] = "TESt";
        // $dataCon = hash('sha256', 'IP20230201-0002');
        // echo $dataCon;
        // $this->template->Pasien('index', $data);
        $this->template->Pasien('Close', $data);

    }
    public function Cek($Key)
    {
		$decode =  base64_decode(str_pad(strtr($Key, '-_', '+/'), strlen($Key) % 4, '=', STR_PAD_RIGHT));
        
        // $cek = $this->db->query("SELECT * FROM tbl_key_pasien where KeyPasien = '$decode' AND Status = '1'")->num_rows();
        
        $userdata = array(
            'KeyPasien'  => $decode,
            'StatusLoginPasien' => "Sukses"
        );

        $this->session->set_userdata($userdata);
		redirect("DataPasien");
        //if ($cek < 1) {
        //    redirect("DataPasien/CekSessionPasien");
        //}else{
        //   redirect("DataPasien");
        //}
  }
}
