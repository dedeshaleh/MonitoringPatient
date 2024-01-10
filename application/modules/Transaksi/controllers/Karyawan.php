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
class Karyawan extends MY_Controller
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
        $this->load->model("M_karyawan");
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
        $data['judul'] = "Karyawan";
        $data['data_karyawan'] = $this->M_karyawan->Get_karyawan();
        // $data['data_level'] = $this->db->query("SELECT * FROM tbl_userlevel")->result();
        $this->template->backend('karyawan/index',$data);
    }
    public function GetData()
    {
        $nik = $this->input->post("nik");
        $q = $this->db->query("SELECT * FROM mst_karyawan_pei where nik = '$nik'")->row();
        echo json_encode($q);
    }
    public function Tambah()
    {

        $nik = $this->input->post('nik');
        $q = $this->db->query("SELECT * FROM mst_karyawan_pei where nik = '$nik' ")->num_rows();
       
        if ($q <= 0) {
            $data = array(
                'nik' => $this->input->post('nik'),
                'name' => $this->input->post('name'),
                'jabatan' => $this->input->post('jabatan'),
                'bisnis_unit' => $this->input->post('bisnis_unit'),
                'tgl_bergabung' => $this->input->post('tgl_bergabung'),
                'aktif' => "Y",
                'date_entry' => date("Y-m-d"),
                'user_entry' => $this->session->userdata("id_user"),
                'time_entry' => date("H:i:s")
            );
            $this->db->insert("mst_karyawan_pei", $data);
            redirect("Master/Karyawan");
        }else{
            echo "<script>alert('NIK Telah Ada'); window.location.href = '".base_url()."Master/Karyawan';</script>";
        }

    }

    public function Edit()
    {
        $nik = $this->input->post("nik");
       
            $data = array(
                'nik' => $this->input->post('nik'),
                'name' => $this->input->post('name'),
                'jabatan' => $this->input->post('jabatan'),
                'bisnis_unit' => $this->input->post('bisnis_unit'),
                'tgl_bergabung' => $this->input->post('tgl_bergabung'),
                'aktif' => $this->input->post('aktif'),
                'date_edit' => date("Y-m-d"),
                'user_edit' => $this->session->userdata("id_user"),
                'time_edit' => date("H:i:s")
            );
            $this->db->where('nik', $nik);
            $this->db->update("mst_karyawan_pei", $data);    
            redirect("Master/Karyawan");
    }
    
    public function Delete()
    {
        $nik = $this->input->post("nik");
        $data = array(
            
            'aktif' => "N",
            'date_edit' => date("Y-m-d"),
            'user_edit' => $this->session->userdata("id_user"),
            'time_edit' => date("H:i:s")
        );
        $this->db->where("nik", $nik);
        $this->db->update("mst_karyawan_pei", $data);
        redirect("Master/Karyawan");
    }
    
}
