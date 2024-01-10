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
class Aplikasi extends MY_Controller
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
        $this->load->model("M_aplikasi");
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
        $data['judul'] = "Aplikasi";
        $data['data_aplikasi'] = $this->M_aplikasi->Get_aplikasi();
        $this->template->backend('aplikasi/index',$data);
    }
    public function GetData()
    {
        $id = $this->input->post("id");
        $q = $this->db->query("SELECT * FROM aplikasi where id = '$id'")->row();
        echo json_encode($q);
    }
    public function Edit()
    {
        $config['upload_path']          = './assets/foto/logo/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg|ico|icon';
        $config['max_size']             = 10000;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;
        
        $this->load->library('upload', $config);
        if ($this->upload->do_upload("logo") != null) {
            if ( ! $this->upload->do_upload('logo'))
            {
                $error = array('error' => $this->upload->display_errors());
                echo "<script>alert('$error[error]'); window.location.href = '".base_url()."Sys/Aplikasi';</script>";
                
            } else {
                
                $data = array(
                    'nama_owner' => $this->input->post('nama_owner'),
                    'alamat' => $this->input->post('alamat'),
                    'tlp' => $this->input->post('tlp'),
                    'title' => $this->input->post('title'),
                    'nama_aplikasi' => $this->input->post('nama_aplikasi'),
                    'logo' => $this->upload->data('file_name'),
                    'copy_right' => $this->input->post('copy_right'),
                    'versi' => $this->input->post('versi'),
                    'tahun' => $this->input->post('tahun'),
                    'nama_owner' => $this->input->post('nama_owner'),
                    'update_date' => date("Y-m-d H:i:s"),
                    'update_by' => $this->session->userdata("id_user")
                );
                $id = $this->input->post("id");
                $this->db->where("id", $id);
                $this->db->update("aplikasi", $data);
                redirect("Sys/Aplikasi");

            }
        }else{
           
            $data = array(
                'nama_owner' => $this->input->post('nama_owner'),
                'alamat' => $this->input->post('alamat'),
                'tlp' => $this->input->post('tlp'),
                'title' => $this->input->post('title'),
                'nama_aplikasi' => $this->input->post('nama_aplikasi'),
                
                'copy_right' => $this->input->post('copy_right'),
                'versi' => $this->input->post('versi'),
                'tahun' => $this->input->post('tahun'),
                'nama_owner' => $this->input->post('nama_owner'),
                'update_date' => date("Y-m-d H:i:s"),
                'update_by' => $this->session->userdata("id_user")
            );
            $id = $this->input->post("id");
            $this->db->where("id", $id);
            $this->db->update("aplikasi", $data);
            redirect("Sys/Aplikasi");
        }
        
    }
    
}
