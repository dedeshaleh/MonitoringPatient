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
class Menu extends MY_Controller
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
        $this->load->model("M_menu");
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
        $data['judul'] = "Menu";
        $data['data_menu'] = $this->M_menu->Get_menu();
        $data['menu'] = $this;
        $this->template->backend('menu/index',$data);
    }
    public function GetData()
    {
        $id = $this->input->post("id");
        $q = $this->db->query("SELECT * FROM tbl_menu where id_menu = '$id'")->row();
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
        $id_menu = $this->input->post('id_menu');
        $data = array(
            'nama_menu' => $this->input->post('nama_menu'),
            'link' => $this->input->post('link'),
            'icon' => $this->input->post('icon'),
            'urutan' => $this->input->post('urutan'),
            'is_active' => $this->input->post('is_active'),
            'status_menu' => $this->input->post('status_menu'),
            'parent_id' => $this->input->post('parent_id'),
        );
        $this->db->where('id_menu', $id_menu);
        $this->db->update("tbl_menu", $data);
        redirect("Sys/Menu");
        
    }
    public function Delete()
    {
        $id_menu = $this->input->post('id_menu');
        $this->db->where('id_menu', $id_menu);
        $this->db->delete("tbl_menu");
        redirect("Sys/Menu");
        
    }
    
}
