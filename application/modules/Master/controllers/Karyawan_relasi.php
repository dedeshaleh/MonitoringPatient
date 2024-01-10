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
class Karyawan_relasi extends MY_Controller
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
        $data['judul'] = "Karyawan Relasi";
        $data['data_karyawan_pei'] = $this->db->query("SELECT * FROM mst_karyawan_pei ")->result();
        $data['data_karyawan'] = $this->M_karyawan->Get_karyawan_relasi();
        // $data['data_level'] = $this->db->query("SELECT * FROM tbl_userlevel")->result();
        $this->template->backend('karyawan_relasi/index',$data);
    }
    public function GetData()
    {
        $id_relasi = $this->input->post("id_relasi");
        $q = $this->db->query("SELECT * FROM mst_relasi_karyawan_pei a LEFT JOIN mst_karyawan_pei b ON b.nik = a.nik  where a.id_relasi = '$id_relasi' ")->row();
        echo json_encode($q);
    }
    public function Tambah()
    {

        $nik = $this->input->post('nik');
        $relasi = $this->input->post('relasi');
        $q = $this->db->query("SELECT * FROM mst_relasi_karyawan_pei where relasi = '$relasi' AND nik = '$nik' AND flag_plafond = '1'")->num_rows();
       
        if ($q <= 0) {
            $data = array(
                'id_relasi' => uniqid(true),
                'nik' => $this->input->post('nik'),
                'nama_relasi' => $this->input->post('nama_relasi'),
                'relasi' => $this->input->post('relasi'),
                'flag_plafond' => "1",
                'date_entry' => date("Y-m-d"),
                'user_entry' => $this->session->userdata("id_user"),
                'time_entry' => date("H:i:s")
            );
            $this->db->insert("mst_relasi_karyawan_pei", $data);
            redirect("Master/Karyawan_relasi");
        }else{
            echo "<script>alert('Relasi Tidak Boleh Lebih Dari 1'); window.location.href = '".base_url()."Master/Karyawan_relasi';</script>";
        }

    }

    public function Edit()
    {
        $id_relasi = $this->input->post("id_relasi");
        $nik = $this->input->post('nik');
        $relasi = $this->input->post('relasi');
        $q = $this->db->query("SELECT * FROM mst_relasi_karyawan_pei where id_relasi = '$id_relasi' AND nik = '$nik' AND relasi = '$relasi' AND flag_plafond = '1'")->num_rows();
       
        if ($q <= 0) {
            $q2 = $this->db->query("SELECT * FROM mst_relasi_karyawan_pei where nik = '$nik' AND relasi = '$relasi' AND flag_plafond = '1'")->num_rows();
            
            if ($q2 > 0) {
                echo "<script>alert('Relasi Tidak Boleh Lebih Dari 1 yang sedang aktif!!'); window.location.href = '".base_url()."Master/Karyawan_relasi';</script>";
            }else{
                
                $data = array(
                    'nik' => $this->input->post('nik'),
                    'nama_relasi' => $this->input->post('nama_relasi'),
                    'relasi' => $this->input->post('relasi'),
                    'flag_plafond' => $this->input->post('flag_plafond'),
                    'date_edit' => date("Y-m-d"),
                    'user_edit' => $this->session->userdata("id_user"),
                    'time_edit' => date("H:i:s")
                );
                $this->db->where('id_relasi', $id_relasi);
                $this->db->where('nik', $nik);
                $this->db->update("mst_relasi_karyawan_pei", $data);    
                redirect("Master/Karyawan_relasi");
            }
            
        }else{
           
                $data = array(
                    'nik' => $this->input->post('nik'),
                    'nama_relasi' => $this->input->post('nama_relasi'),
                    'relasi' => $this->input->post('relasi'),
                    'flag_plafond' => $this->input->post('flag_plafond'),
                    'date_edit' => date("Y-m-d"),
                    'user_edit' => $this->session->userdata("id_user"),
                    'time_edit' => date("H:i:s")
                );
                $this->db->where('id_relasi', $id_relasi);
                $this->db->where('nik', $nik);
                $this->db->update("mst_relasi_karyawan_pei", $data);    
                redirect("Master/Karyawan_relasi");
            
        }
            
    }
    
    public function Delete()
    {
        $id_relasi = $this->input->post("id_relasi");
        $data = array(
            
            'flag_plafond' => "N",
            'date_edit' => date("Y-m-d"),
            'user_edit' => $this->session->userdata("id_user"),
            'time_edit' => date("H:i:s")
        );
        $this->db->where("id_relasi", $id_relasi);
        $this->db->delete("mst_relasi_karyawan_pei");
        redirect("Master/Karyawan_relasi");
    }
    
}
