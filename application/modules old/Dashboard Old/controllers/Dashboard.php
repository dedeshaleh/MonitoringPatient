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
        
        $hasil = array(
            'draw' => $_POST['draw'],
            'recordsTotal' => $this->M_Dashboard->count_all($date_awal,$date_akhir),
            'recordsFiltered' => $this->M_Dashboard->count_filtered($date_awal,$date_akhir, $data_search),
            "data" => $this->M_Dashboard->get_datatables($date_awal,$date_akhir, $data_search),
        );
        echo json_encode($hasil);

    }
    
}
