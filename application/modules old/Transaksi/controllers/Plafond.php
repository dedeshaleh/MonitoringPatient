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
class Plafond extends MY_Controller
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
        $this->load->model("M_plafond");
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
        $data['judul'] = "Plafond";
        // $data['data_plafond'] = $this->M_plafond->Get_plafond();
        $data['data_plafond'] = $this->M_plafond->Get_karyawan();
        // $data['data_level'] = $this->db->query("SELECT * FROM tbl_userlevel")->result();
        $this->template->backend('plafond/index',$data);
    }
    public function data_detail()
    {
        // $start = $this->input->post("start");
        // echo $start."test";
        $date_awal = $this->input->post("date_awal");
        $date_akhir = $this->input->post("date_akhir");
        $karyawan = $this->input->post("karyawan");
        
        $nik = $this->session->userdata('username');
        $hasil = array(
            'draw' => $_POST['draw'],
            'recordsTotal' => $this->M_plafond->count_all(),
            'recordsFiltered' => $this->M_plafond->count_filtered(),
            "data" => $this->M_plafond->get_datatables(),
        );
        echo json_encode($hasil);

    }
    public function GetRelasi()
    {
        $nik = $this->input->post("nik");
        $q = $this->db->queyr("SELECT * FROM mst_relasi_karyawan_pei WHERE nik = '$nik'")->result();
        echo json_encode($q);
    }
    public function GetData()
    {
        $id_trx = $this->input->post("id_trx");
        $q = $this->db->query("SELECT * FROM trn_karyawan_plafon where id_trx = '$id_trx'")->row();
        echo json_encode($q);
    }
    public function Tambah()
    {

        $data = array(
            'nik' => $this->input->post('nik'),
            'relasi' => $this->input->post('relasi'),
            'effective_date' => $this->input->post('effective_date'),
            'expired_date' => $this->input->post('expired_date'),
            'plafon_rwj' => $this->input->post('plafon_rwj'),
            'plafon_rwi' => $this->input->post('plafon_rwi'),
            'date_entry' => date("Y-m-d"),
            'user_entry' => $this->session->userdata("full_name"),
            'time_entry' => date("H:i:s")
        );
        $this->db->insert("trn_karyawan_plafon", $data);
        redirect("Transaksi/Plafond");
        // $nik = $this->input->post('nik');
        // $q = $this->db->query("SELECT * FROM mst_karyawan_pei where nik = '$nik' ")->num_rows();
       
        // if ($q <= 0) {
        //     $data = array(
        //         'nik' => $this->input->post('nik'),
        //         'name' => $this->input->post('name'),
        //         'jabatan' => $this->input->post('jabatan'),
        //         'bisnis_unit' => $this->input->post('bisnis_unit'),
        //         'tgl_bergabung' => $this->input->post('tgl_bergabung'),
        //         'aktif' => "Y",
        //         'date_entry' => date("Y-m-d"),
        //         'user_entry' => $this->session->userdata("id_user"),
        //         'time_entry' => date("H:i:s")
        //     );
        //     $this->db->insert("mst_karyawan_pei", $data);
        //     redirect("Master/Karyawan");
        // }else{
        //     echo "<script>alert('NIK Telah Ada'); window.location.href = '".base_url()."Master/Karyawan';</script>";
        // }

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
