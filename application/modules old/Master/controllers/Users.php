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
class Users extends MY_Controller
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
        $this->load->model("M_users");
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
        $data['judul'] = "Users";
        $data['data_users'] = $this->M_users->Get_users();
        $data['data_level'] = $this->db->query("SELECT * FROM tbl_userlevel")->result();
        $this->template->backend('users/index',$data);
    }
    public function GetData()
    {
        $id = $this->input->post("id");
        $q = $this->db->query("SELECT * FROM tbl_user where id_user = '$id'")->row();
        echo json_encode($q);
    }
    public function Tambah()
    {

        $username = $this->input->post('username');
        $q = $this->db->query("SELECT * FROM tbl_user where username = '$username' ")->num_rows();
       
        if ($q <= 0) {
            $config['upload_path']          = './assets/foto/user/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 100;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;
            
            $this->load->library('upload', $config);
            if ($this->upload->do_upload("image") != null) {
                if ( ! $this->upload->do_upload('image'))
                {
                    $error = array('error' => $this->upload->display_errors());
                    echo "<script>alert('$error[error]'); window.location.href = '".base_url()."Sys/Aplikasi';</script>";
                    
                } else {
                    $data = array(
                        'username' => $this->input->post('username'),
                        'full_name' => $this->input->post('full_name'),
                        'password' => get_hash($this->input->post('password')),
                        'is_active' => $this->input->post('is_active'),
                        'id_level' => $this->input->post('id_level'),
                        'image' => $this->upload->data('file_name'),
                        'create_date' => date("Y-m-d H:i:s"),
                        'create_by' => $this->session->userdata("id_user")
                    );
                    $this->db->insert("tbl_user", $data);
                    redirect("Master/Users");

                }
            }else{
                $data = array(
                    'username' => $this->input->post('username'),
                    'full_name' => $this->input->post('full_name'),
                    'password' => get_hash($this->input->post('password')),
                    'is_active' => $this->input->post('is_active'),
                    'create_date' => date("Y-m-d H:i:s"),
                    'create_by' => $this->session->userdata("id_user")
                );
                $this->db->insert("tbl_user", $data);
                redirect("Master/Users");
            }
        }else{
            echo "<script>alert('Username Telah Ada'); window.location.href = '".base_url()."Master/Users';</script>";
        }

    }

    public function Edit()
    {
        $username = $this->input->post("username");
        $id_user = $this->input->post("id_user");
        $password = $this->input->post("password");
        $q1 = $this->db->query("SELECT * FROM tbl_user where username = '$username' AND id_user = '$id_user' ")->num_rows();
        $q2 = $this->db->query("SELECT * FROM tbl_user where username = '$username' ")->num_rows();
        $q3 = $this->db->query("SELECT * FROM tbl_user where password = '$password' AND id_user = '$id_user' ")->num_rows();
        if ($q1 == 1) {
            $config['upload_path']          = './assets/foto/user/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 100;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;
            
            $this->load->library('upload', $config);
            if ($this->upload->do_upload("image") != null) {
                if ( ! $this->upload->do_upload('image'))
                {
                    $error = array('error' => $this->upload->display_errors());
                    echo "<script>alert('$error[error]'); window.location.href = '".base_url()."Sys/Aplikasi';</script>";
                    
                } else {
                    if ($q3 > 0) {
                        $data = array(
                            'username' => $this->input->post('username'),
                            'full_name' => $this->input->post('full_name'),
                            'is_active' => $this->input->post('is_active'),
                            'id_level' => $this->input->post('id_level'),
                            'image' => $this->upload->data('file_name'),
                            'create_date' => date("Y-m-d H:i:s"),
                            'create_by' => $this->session->userdata("id_user")
                        ); 
                    }else{
                        $data = array(
                            'username' => $this->input->post('username'),
                            'full_name' => $this->input->post('full_name'),
                            'password' => get_hash($this->input->post('password')),
                            'is_active' => $this->input->post('is_active'),
                            'id_level' => $this->input->post('id_level'),
                            'image' => $this->upload->data('file_name'),
                            'create_date' => date("Y-m-d H:i:s"),
                            'create_by' => $this->session->userdata("id_user")
                        );
                    }
                    
                    $this->db->where('id_user', $id_user);
                    $this->db->update("tbl_user", $data);
                    redirect("Master/Users");

                }
            }else{
                if ($q3 > 0) {
                    $data = array(
                        'username' => $this->input->post('username'),
                        'full_name' => $this->input->post('full_name'),
                        'is_active' => $this->input->post('is_active'),
                        'id_level' => $this->input->post('id_level'),
                        'create_date' => date("Y-m-d H:i:s"),
                        'create_by' => $this->session->userdata("id_user")
                    ); 
                }else{
                    $data = array(
                        'username' => $this->input->post('username'),
                        'full_name' => $this->input->post('full_name'),
                        'password' => get_hash($this->input->post('password')),
                        'is_active' => $this->input->post('is_active'),
                        'id_level' => $this->input->post('id_level'),
                        'create_date' => date("Y-m-d H:i:s"),
                        'create_by' => $this->session->userdata("id_user")
                    );
                }
                $this->db->where('id_user', $id_user);
                $this->db->update("tbl_user", $data);
                redirect("Master/Users");
            }
        }
        
        
    }
    
    
}
