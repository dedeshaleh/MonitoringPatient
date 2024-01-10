<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_plafond extends CI_Model {
    function Aplikasi()
    {
        return $this->db->get('aplikasi');
    }

    function __construct()
    {
         parent::__construct();
    }
    public function count_all()
    {
        $this->db->select();
        $this->db->from("trn_karyawan_plafon");
        return $this->db->count_all_results();
    }

    var $order = array('a.effective_date' => 'DESC'); // default order 
    private function _get_datatables_query($term = '')
    {
        $column = array('', 'a.nik', 'a.relasi', 'a.effective_date'); //Sesuaikan dengan field
        $this->db->select("a.id_trx, a.nik, a.relasi, a.effective_date, a.expired_date, a.plafon_rwj, a.plafon_rwi, a.pemakaian_rwj, a.pemakaian_rwi ");
        $this->db->from("trn_karyawan_plafon a");
        // if ($this->session->userdata('level') == '2' OR $this->session->userdata('level') == "karyawan") {
        //     $this->db->where("(peserta.nik = '$nik' OR training.pembicara like '%$karyawan%')");
        // }
        // if ($karyawan != null) {
        //     $this->db->where("(peserta.nik = '$karyawan' OR training.pembicara like '%$karyawan%')");
        // }
        // if ($date_awal != null && $date_akhir != null) {
        //     $this->db->where("(DATE(tgl_training) BETWEEN '$date_awal' AND '$date_akhir')");
        // }else if ($date_awal != null) {
        //     $this->db->where("DATE(tgl_training) = '$date_awal'");
        // }else if ($date_akhir != null) {
        //     $this->db->where("DATE(tgl_training) = '$date_akhir'");
        // }

        $this->db->where(" (a.nik LIKE '%$term%' OR a.relasi LIKE '%$term%') ");
        // $this->db->like('training.topik', $term);
        // $this->db->or_like('training.pembicara', $term);

        if (isset($_REQUEST['order'])) {
            $this->db->order_by($column[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $term = $_REQUEST['search']['value'];
        $this->_get_datatables_query($term);
        if ($_POST['length'] != -1)
            $this->db->limit($_REQUEST['length'], $_REQUEST['start']);
        
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $term = $_REQUEST['search']['value'];
        $this->_get_datatables_query($term);
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function Get_karyawan()
    {
        $this->db->select();
        $this->db->from("mst_karyawan_pei");
        $this->db->where("aktif", 'Y');
        $q = $this->db->get();
        return $q->result();
    }
    public function Get_karyawan_relasi()
    {
        $this->db->select("a.*, b.name");
        $this->db->from("mst_relasi_karyawan_pei a");
        $this->db->join("mst_karyawan_pei b", "b.nik = a.nik");
        $q = $this->db->get();
        return $q->result();
    }

}

/* End of file Mod_login.php */
