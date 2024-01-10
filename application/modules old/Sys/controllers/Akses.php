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
class Akses extends MY_Controller
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
        $this->load->model("M_akses");
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
        $data['judul'] = "Hak Akses";
        $data['data_user'] = $this->M_akses->GetUser();
        
        $data['akses'] = $this;
        $this->template->backend('akses/index',$data);
    }
    public function Data_Detail()
    {
        $q = $this->M_akses->GetUser();
        $data = array(
            'data' => $q,
        );
        echo json_encode($data);
    }
    public function GetData()
    {
        $id = $this->input->post("id");
        $q1 = $this->db->query("SELECT * FROM tbl_akses_menu where id_user = '$id'")->num_rows();
        if ($q1 > 0) {
            // exit();
            $q_menu = $this->M_akses->GetMenu($id);
            $q_submenu = $this->M_akses->GetMenu2($id);
            $q_submenu3 = $this->M_akses->GetMenu3($id);
        }else{
            // exit();
            $q_menu = $this->M_akses->GetMenu();
            $q_submenu = $this->M_akses->GetMenu2();
            $q_submenu3 = $this->M_akses->GetMenu3();
        }
        $data = array(
            'menu' => $q_menu,
            'submenu' => $q_submenu,
            'submenu3' => $q_submenu3,
        );
        echo json_encode($data);
    }
    public function GetAkses()
    {
        $id_user = $this->input->post('id_user');
        $id_menu = $this->input->post('id_menu');
        $q = $this->db->query("SELECT * FROM tbl_akses_menu where id_user = '$id_user' AND id_menu = '$id_menu'")->row();
        echo json_encode($q);
    }
    public function get_menu($id_menu)
    {
        $q = $this->db->query("SELECT * FROM tbl_menu where id_menu = '$id_menu'")->row();
        return $q->nama_menu;
    }
    public function Tambah()
    {
        $data = array(
            'nama_menu' => $this->input->post('nama_menu'),
            'link' => $this->input->post('link'),
            'icon' => $this->input->post('icon'),
            'urutan' => $this->input->post('urutan'),
            'is_active' => $this->input->post('is_active'),
            'status_menu' => $this->input->post('status_menu'),
            'parent_id' => $this->input->post('parent_id'),
        );
        $this->db->insert("tbl_menu", $data);
        redirect("Sys/Menu");
    }

    public function Edit()
    {
        $q_menu = $this->db->query("SELECT * FROM tbl_menu")->result();
        $id_user = $this->input->post('id_user');
        foreach ($q_menu as $val) {
            $q_cek = $this->db->query("SELECT * FROM tbl_akses_menu WHERE id_user = '$id_user' and id_menu = '$val->id_menu'")->num_rows();
            $view_level = $this->input->post('view_'.$val->id_menu);
            $add_level = $this->input->post('add_'.$val->id_menu);
            $edit_level = $this->input->post('edit_'.$val->id_menu);
            $delete_level = $this->input->post('delete_'.$val->id_menu);
            if ($q_cek > 0) {

                $this->db->query("UPDATE tbl_akses_menu SET view_level = '$view_level', add_level = '$add_level', edit_level = '$edit_level', delete_level = '$delete_level' 
                                  WHERE id_user = '$id_user' AND id_menu = '$val->id_menu'
                ");
            }else{
                $this->db->query("INSERT INTO tbl_akses_menu (id_menu, id_user, view_level, add_level, edit_level, delete_level )
                VALUES ('$val->id_menu', '$id_user', '$view_level', '$add_level', '$edit_level', '$delete_level' ) ");
            }
        }
        redirect("Sys/Akses");
        
    }
    public function Delete()
    {
        $id_menu = $this->input->post('id_menu');
        $this->db->where('id_menu', $id_menu);
        $this->db->delete("tbl_menu");
        redirect("Sys/Menu");
        
    }
    
}
