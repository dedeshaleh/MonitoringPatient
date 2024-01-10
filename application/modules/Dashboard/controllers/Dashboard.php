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

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
        if (!$this->session->userdata('logStatus') == 'MPLogin') {
            redirect();
        }
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

        if ($this->session->userdata('id_level') == '5') {
            $data['Ward'] = $this->dbProd23->query("SELECT * FROM DB_Master_Fix.dbo.RI_Ward WHERE Active = '1' AND Description IN ('ICU')")->result();
        } else if ($this->session->userdata('id_level') == '6') {
            $data['Ward'] = $this->dbProd23->query("SELECT * FROM DB_Master_Fix.dbo.RI_Ward WHERE Active = '1' AND Ward_Code IN ('CAE', 'CAE2')")->result();
        } else if ($this->session->userdata('id_level') == '7') {
            $data['Ward'] = $this->dbProd23->query("SELECT * FROM DB_Master_Fix.dbo.RI_Ward WHERE Active = '1' AND Ward_Code IN ('MGD', 'EMM', 'DRB')")->result();
        } else if ($this->session->userdata('id_level') == '8') {
            $data['Ward'] = $this->dbProd23->query("SELECT * FROM DB_Master_Fix.dbo.RI_Ward WHERE Active = '1' AND Ward_Code IN ('NZR', 'JOP')")->result();
        }else{
            $data['Ward'] = $this->dbProd23->query("SELECT * FROM DB_Master_Fix.dbo.RI_Ward WHERE Active = '1' AND Description NOT IN ('BEREA', 'HCU', 'ISOLATION', 'NICU', 'OPERATING THEATER', 'PERINATOLOGI', 'PHANTOM WARD', 'ICCU', 'PICU', 'MORIAH ICU')")->result();
        }


        $this->template->backend('index', $data);
    }
    public function data_detail()
    {
       
        ini_set('memory_limit', '1256M');

        $page = $_POST['page'];
        $limit = $_POST['size'];
        $dataFilter = $_POST['filter'];
        $dataSort = $_POST['sort'];
        $no = 0;
        $tableName = 'DB_Transaction_Fix.dbo.View_Journey_RI';
       

        if ($dataFilter == NULL OR "") {
            
        }else{
            foreach ($dataFilter as $key => $value) {
                
                if ($value['type'] == 'like') {
                    $where = " ".$value['field']." ".$value['type']." '%".$value['value']."%' ";
                    $this->dbProd23->where($where);
                
                } 

                if ($value['field'] == 'date') {
                    if ($value['field'] == null || $value['field'] == '') {
                        
                    }else{
                        $where = " Date_Registration ".$value['type']." '".$value['value']."' ";
                        $this->dbProd23->where($where);

                    }
                }

                if ($value['field'] == 'Ward') {
                    
                    if ($value['value'] == null || $value['value'] == '') {
                        
                    }else{
                        $where = " ".$value['field']." ".$value['type']." '".$value['value']."' ";
                        $this->dbProd23->where($where);
                    }
                } 

               
            }

        }
        $this->dbProd23->where("Status_Data != 'In' ");

        

        $count = $this->dbProd23->count_all_results($tableName );
        $this->dbProd23->select("Patient_Name, WARD, Date_Perintah_Pulang, Date_Discharge, Date_Terima_Jaminan, MR, RTRIM(LTRIM(Company_Name)) AS Company_Name, IP_Registration_No");
        $this->dbProd23->from("DB_Transaction_Fix.dbo.View_Journey_RI");
        if ($count > 0) {
            $total_pages = ceil($count/$limit);
        } else {
            $total_pages = 0;
        }
        
        
        if ($page > $total_pages) $page=$total_pages;

        $start = $limit*$page - $limit;
        $start = $start < 0 ? 0 : $start;

        $response['page'] = $page;
        $response['total'] = $total_pages;
        $responce['records'] = $count;

        // $this->dbProd23->where($where);
        if ($dataFilter == NULL OR "") {
            
        }else{
            foreach ($dataFilter as $key => $value) {
                
                if ($value['type'] == 'like') {
                    $where = " ".$value['field']." ".$value['type']." '%".$value['value']."%' ";
                    $this->dbProd23->where($where);
                
                } 

                if ($value['field'] == 'date') {
                    if ($value['field'] == null || $value['field'] == '') {
                        
                    }else{
                        $where = " Date_Registration ".$value['type']." '".$value['value']."' ";
                        $this->dbProd23->where($where);

                    }
                }

                if ($value['field'] == 'Ward') {
                    if ($value['value'] == null || $value['value'] == '') {
                        
                    }else{
                        $where = " ".$value['field']." ".$value['type']." '".$value['value']."' ";
                        $this->dbProd23->where($where);
                    }
                } 
            }
        }
        if ($limit!= '') $this->dbProd23->limit($limit, $start);

        if ($dataSort == NULL OR "") {
            $this->dbProd23->order_by("Date_Terima_Jaminan", "ASC");
            $this->dbProd23->order_by("Date_Discharge", "ASC");
            $this->dbProd23->order_by("Date_Perintah_Pulang", "DESC");
        }else{
            foreach ($dataSort as $key => $value) {
                $this->dbProd23->order_by($value['field'], $value['dir']);
            }
        }

        $this->dbProd23->where("Status_Data != 'In' ");
        $data['last_page'] = $total_pages;
        $q = $this->dbProd23->get();
        $data['data'] = $q->result();
        echo json_encode($data);

    }
    public function DataChart()
    {
        $Bulan = $this->input->post("Bulan")+1;
        $Tahun = $this->input->post("Tahun");
        $q1 = $this->dbProd23->query("SELECT COUNT(*) AS Total FROM DB_Transaction_Fix.dbo.View_TrackingPatient WHERE Perintah_Pulang_To_Discharge > 120 AND ( MONTH(Date_Registration) = $Bulan and YEAR(Date_Registration) = $Tahun )")->row();
        $q2 = $this->dbProd23->query("SELECT COUNT(*) AS Total FROM DB_Transaction_Fix.dbo.View_TrackingPatient WHERE Discharge_To_Terima_Jaminan > 60 AND ( MONTH(Date_Registration) = $Bulan and YEAR(Date_Registration) = $Tahun)")->row();
        $q3 = $this->dbProd23->query("SELECT COUNT(*) AS Total FROM DB_Transaction_Fix.dbo.View_TrackingPatient WHERE (Perintah_Pulang_To_Discharge <= 120 AND Discharge_To_Terima_Jaminan <= 60) AND ( MONTH(Date_Registration) = $Bulan and YEAR(Date_Registration) = $Tahun )")->row();
        $q4 = $this->dbProd23->query("SELECT COUNT(*) AS Total FROM DB_Transaction_Fix.dbo.View_TrackingPatient WHERE MONTH(Date_Registration) = $Bulan and YEAR(Date_Registration) = $Tahun ")->row();
        $q5 = $this->dbProd23->query("SELECT COUNT(*) AS Total FROM DB_Transaction_Fix.dbo.View_TrackingPatient WHERE (Perintah_Pulang_To_Discharge > 120 OR Discharge_To_Terima_Jaminan > 60) AND MONTH(Date_Registration) = $Bulan and YEAR(Date_Registration) = $Tahun ")->row();
        $data = array(
            'SLA1' => $q1->Total,
            'SLA2' => $q2->Total,
            'SLA3' => $q3->Total,
            'SLA4' => $q4->Total,
            'SLA5' => $q5->Total,
        );
        echo json_encode($data);
    }
    public function DataDetailPasien()
    {
        $IP_Registration_No = $this->input->post("IP_Registration_No");
        $q = $this->dbProd23->query("SELECT * FROM View_Journey_RI AS a WHERE IP_Registration_No = '$IP_Registration_No'")->row();
        $q2 = $this->dbProd23->query("SELECT  DISTINCT(ax.Doctor), ax.IP_Registration_No, ax.DoctorType, bx.Doctor_Name FROM (
            SELECT 'DPJP' AS DoctorType, a.IP_Registration_No, a.Doctor_In_Charge AS Doctor FROM dbo.RI_Tran_Registrasi a
            WHERE a.IP_Registration_No = '$IP_Registration_No'
            UNION 
            SELECT 'Doktor Praktek' AS DoctorType, b.Tran_No, b.Doctor_Pratice FROM dbo.RI_Tran_FAC_Detail b 
            WHERE b.Tran_No = '$IP_Registration_No'
            UNION
            SELECT 'Doktor Refferal' AS DoctorType, c.IP_Registration_No, c.Referring_Doctors FROM dbo.RI_Tran_Registrasi c
            WHERE c.IP_Registration_No = '$IP_Registration_No'
            UNION
            SELECT 'Doktor Join' AS DoctorType, d.Registratiion_No, d.Doctor_Code FROM dbo.RI_Tran_Join_Care d 
            WHERE d.Registratiion_No = '$IP_Registration_No' AND d.Doctor_Code NOT IN (SELECT a.Doctor_In_Charge AS Doctor FROM dbo.RI_Tran_Registrasi a
            WHERE a.IP_Registration_No = '$IP_Registration_No')
            ) AS ax
            LEFT JOIN DB_Master_Fix.dbo.Dokter bx ON bx.Doctor_Code = ax.Doctor
            ")->result();
        $data = array(
            'Detail' => $q,
            'Dokter' => $q2
        );
        echo json_encode($data);
    }

    public function ExportExcel()
    {
        date_default_timezone_set('Asia/Jakarta');
	    ini_set('date.timezone', 'Asia/Jakarta');
        $json = file_get_contents("php://input"); // json string
        $object = json_decode($json); // php object
        $date_awal = $object->date_awal;
        $date_akhir = $object->date_akhir;
        $ward = $object->ward;

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = [
            'font' => ['bold' => true], // Set font nya jadi bold
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];

        
        $sheet->setCellValue('A1', "DATA TRAINING DATE " .$date_awal." - ".$date_akhir); 
        $sheet->mergeCells('A1:I1'); // Set Merge Cell pada kolom A1 sampai F1
        $sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
        $sheet->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $sheet->setCellValue('A2', "Ward  : ".$ward); 
        $sheet->getStyle('A2')->getFont()->setBold(true); // Set bold kolom A1
        $sheet->getStyle('A2')->getFont()->setSize(12); // Set font size 12 untuk kolom A1
       
        
        // Buat header tabel nya pada baris ke 3
        $sheet->setCellValue('A4', "Nama Pasien"); 
        $sheet->setCellValue('B4', "Ward"); 
        $sheet->setCellValue('C4', "Perintah Pulang"); 
        $sheet->setCellValue('D4', "Discharge"); 
        $sheet->setCellValue('E4', "Date Terima Jaminan"); 
        $sheet->setCellValue('F4', "MR"); 
        $sheet->setCellValue('G4', "Payer"); 
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $sheet->getStyle('A4')->applyFromArray($style_col);
        $sheet->getStyle('B4')->applyFromArray($style_col);
        $sheet->getStyle('C4')->applyFromArray($style_col);
        $sheet->getStyle('D4')->applyFromArray($style_col);
        $sheet->getStyle('E4')->applyFromArray($style_col);
        $sheet->getStyle('F4')->applyFromArray($style_col);
        $sheet->getStyle('G4')->applyFromArray($style_col);
        // Set height baris ke 1, 2 dan 3
        $sheet->getRowDimension('1')->setRowHeight(20);
        $sheet->getRowDimension('5')->setRowHeight(20);
        // $sheet->getRowDimension('3')->setRowHeight(20);
        // Buat query untuk menampilkan semua data 
        
        // $ss = $this->db->query("SELECT * FROM training where id = '$topik'")->row();
        $this->dbProd23->select("Patient_Name, WARD, Date_Perintah_Pulang, Date_Discharge, Date_Terima_Jaminan, MR, RTRIM(LTRIM(Company_Name)) AS Company_Name");
        $this->dbProd23->from("DB_Transaction_Fix.dbo.View_Journey_RI");
        $this->dbProd23->where("Status_Data != 'In' ");
        if ($date_awal != null && $date_akhir != null) {
            $this->dbProd23->where("(Date_Registration BETWEEN '$date_awal' AND '$date_akhir')");
        }else if ($date_awal != null) {
            $this->dbProd23->where("Date_Registration = '$date_awal'");
        }else if ($date_akhir != null) {
            $this->dbProd23->where("Date_Registration = '$date_akhir'");
        }
        if ($ward == '' || $ward == null) {
            
        }else{
            $this->dbProd23->where('WARD', $ward);
        }
        $this->dbProd23->order_by("Date_Terima_Jaminan", "ASC");
        $this->dbProd23->order_by("Date_Discharge", "ASC");
        $this->dbProd23->order_by("Date_Perintah_Pulang", "DESC");
        $q = $this->dbProd23->get()->result();
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $row = 5; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach ($q as $v) {
            $sheet->setCellValue('A' . $row, $v->Patient_Name);
            $sheet->setCellValue('B' . $row, $v->WARD);
            $sheet->setCellValue('C' . $row, $v->Date_Perintah_Pulang);
            // $sheet->setCellValue('D' . $row, $v->Date_Discharge); 
            if ($v->Date_Discharge == "1901-01-01 00:00:00") {
                $awal  = strtotime($v->Date_Perintah_Pulang);
                $akhir = strtotime(date('Y-m-d H:i:s'));
                $diff  = $akhir - $awal;
                $jam   = floor($diff / (60 * 60));
                $menit = $diff - ( $jam * (60 * 60) );
                $sheet->setCellValue('D'.$row, floor($jam).' Jam '.floor($menit / 60).' Menit'); 
            }else{
                $sheet->setCellValue('D' . $row, $v->Date_Discharge); 
            }
            // $sheet->setCellValue('E' . $row, $v->Date_Terima_Jaminan);
            if ($v->Date_Terima_Jaminan == "1901-01-01 00:00:00") {
                if ($v->Date_Discharge == "1901-01-01 00:00:00") {
                    $sheet->setCellValue('E' . $row, ""); 
                }else{
                    $awal  = strtotime($v->Date_Discharge);
                    $akhir = strtotime(date('Y-m-d H:i:s'));
                    $diff  = $akhir - $awal;
                    $jam   = floor($diff / (60 * 60));
                    $menit = $diff - ( $jam * (60 * 60) );
                    $sheet->setCellValue('E'.$row, floor($jam).' Jam '.floor($menit / 60).' Menit'); 
                }
                
            }else{
                $sheet->setCellValue('E' . $row, $v->Date_Terima_Jaminan); 
            }
            $sheet->setCellValue('F' . $row, $v->MR);
            $sheet->setCellValue('G' . $row, $v->Company_Name);
            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $sheet->getStyle('A' . $row)->applyFromArray($style_row);
            $sheet->getStyle('B' . $row)->applyFromArray($style_row);
            $sheet->getStyle('C' . $row)->applyFromArray($style_row);
            $sheet->getStyle('D' . $row)->applyFromArray($style_row);
            $sheet->getStyle('E' . $row)->applyFromArray($style_row);
            $sheet->getStyle('F' . $row)->applyFromArray($style_row);
            $sheet->getStyle('G' . $row)->applyFromArray($style_row);
            $sheet->getStyle('A' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom No
            $sheet->getStyle('B' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Set text left untuk kolom 
            $sheet->getRowDimension($row)->setRowHeight(20); // Set height tiap row
            $no++; // Tambah 1 setiap kali looping
            $row++; // Tambah 1 setiap kali looping
        }
        
        // Set width kolom
        $sheet->getColumnDimension('A')->setAutoSize(true); 
        $sheet->getColumnDimension('B')->setAutoSize(true); 
        $sheet->getColumnDimension('C')->setAutoSize(true); 
        $sheet->getColumnDimension('D')->setAutoSize(true); 
        $sheet->getColumnDimension('E')->setAutoSize(true); 
        $sheet->getColumnDimension('F')->setAutoSize(true); 
        $sheet->getColumnDimension('G')->setAutoSize(true); 
        // Set judul file excel nya
        $sheet->setTitle("Laporan Data Pasien");
        $writer = new Xlsx($spreadsheet);
        ob_end_clean();
        $filename = "Laporan Data Pasien.xlsx";
        // Proses file excel
        header('Content-Type: application/vnd.OpenXmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$filename ); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        header('Pragma: no-cache');
        header('Expires: 0');
        $writer->save('php://output');
        die();
    }
}
