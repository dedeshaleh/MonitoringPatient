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
class LMA extends MY_Controller
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
        $this->load->model("M_LMA");
        $this->load->library('upload');
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
        $data['judul'] = "Laporan Medis Awal";

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


        $this->template->backend('./LaporanMedis/LMA/v_index', $data);
    }
    public function data_detail()
    {
       
        ini_set('memory_limit', '1256M');

        $page = $_POST['page'];
        $limit = $_POST['size'];
        $dataFilter = $_POST['filter'];
        $dataSort = $_POST['sort'];

        $this->dbProd23->select();
        $this->dbProd23->from("dbo.View_LMA_Regis");
        // $this->dbProd23->where(" Confirm_GP = '1' AND Confirm_CASEMIX = '0' AND ToFix = '0' ");
        $this->dbProd23->where(" To_Casemix = '1' ");

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
                        $where = " Tanggal_Registrasi ".$value['type']." '".$value['value']."' ";
                        $this->dbProd23->where($where);

                    }
                }
            }

        }
        // $this->dbProd23->where("Status_Data != 'In' ");

        $count = $this->dbProd23->count_all_results();

        $this->dbProd23->select();
        $this->dbProd23->from("dbo.View_LMA_Regis");
        // $this->dbProd23->where(" Confirm_GP = '1' AND Confirm_CASEMIX = '0' AND ToFix = '0' ");

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
                        $where = " Tanggal_Registrasi ".$value['type']." '".$value['value']."' ";
                        $this->dbProd23->where($where);

                    }
                }

            }
        }

        // $this->dbProd23->where("b.Status_Data <> 'In' ");
        $this->dbProd23->where(" To_Casemix = '1' ");

        if ($limit!= '') $this->dbProd23->limit($limit, $start);

        if ($dataSort == NULL OR "") {
            $this->dbProd23->order_by("Tanggal_Registrasi", "DESC");

        }else{
            foreach ($dataSort as $key => $value) {
                $this->dbProd23->order_by($value['field'], $value['dir']);
            }
        }

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

    public function UploadData()
    {
        require('assets/fpdf/fpdf.php');
        // Daftar gambar yang akan dikonversi
        date_default_timezone_set("Asia/Jakarta");
         // Mendapatkan bulan saat ini
         $currentMonth = date('ym');
         $currentYearBig = date('Y');
         $currentYearSmall = date('y');

         // Mendapatkan angka yang diinginkan per bulan
         $desiredNumber = 10; // Ganti dengan angka yang diinginkan

         // Membuat folder dengan angka yang diinginkan
         $folderPath = "uploads/".$currentYearBig."/".$currentMonth;
         
         if (!file_exists($folderPath)) {
             mkdir($folderPath, 0777, true);
         }

        $config['upload_path'] = $folderPath; // Ganti dengan direktori tempat Anda ingin menyimpan gambar
        $config['allowed_types'] = 'jpg|png|jpeg|pdf';
        // $config['max_size'] = 2048; // Batasan ukuran file (dalam kilobita)
        $config['encrypt_name'] = TRUE; // Mengenkripsi nama file yang diunggah

        $this->upload->initialize($config);
        $files = $_FILES['files'];
        $extension="";
        foreach ($files['name'] as $va => $name) {
            $file = $name;
            $extension.= pathinfo($file, PATHINFO_EXTENSION);
        }
        $pattern = "/pdf/i";
        if (preg_match($pattern, $extension)) {
            $hitung = count($files['name']);
            if ($hitung > 1) {
                echo json_encode(['status' => 'error', 'message' => 'Maaf File Upload PDF tidak Boleh lebih dari 1 !!']);
            }else{
                foreach ($files['name'] as $key => $name) {
                    $_FILES['file']['name'] = $name;
                    $_FILES['file']['type'] = $files['type'][$key];
                    $_FILES['file']['tmp_name'] = $files['tmp_name'][$key];
                    $_FILES['file']['error'] = $files['error'][$key];
                    $_FILES['file']['size'] = $files['size'][$key];
                    if (!$this->upload->do_upload('file')) {
                        // Gagal mengunggah file, tangani sesuai kebutuhan Anda
                        // $error = $this->upload->display_errors();
                        echo json_encode(['status' => 'error', 'message' => $this->upload->display_errors()]);
                        exit();
                        // ...
                    } else {
                        $uploadData = $this->upload->data();
                        echo json_encode(['status' => 'success', 'message' => 'Upload PDF successful']);

                    }
                }
            }
        } else {
            $pdf = new FPDF();
            $pdf->AddPage();
            foreach ($files['name'] as $key => $name) {
                $_FILES['file']['name'] = $name;
                $_FILES['file']['type'] = $files['type'][$key];
                $_FILES['file']['tmp_name'] = $files['tmp_name'][$key];
                $_FILES['file']['error'] = $files['error'][$key];
                $_FILES['file']['size'] = $files['size'][$key];
                if (!$this->upload->do_upload('file')) {
                    // Gagal mengunggah file, tangani sesuai kebutuhan Anda
                    // $error = $this->upload->display_errors();
                    echo json_encode(['status' => 'error', 'message' => $this->upload->display_errors()]);
                    exit();
                    // ...
                } else {
                    $uploadData = $this->upload->data();
                    $fileType = $uploadData['file_type'];
                    $extensionNew = pathinfo($file, PATHINFO_EXTENSION);

                    if (in_array($fileType, ['image/jpeg', 'image/png'])) {
            
                        // Set font default untuk teks
                        $pdf->SetFont('helvetica', '', 12);
                
                        // Buat halaman baru
                
                        // Tambahkan gambar ke halaman PDF
                        $pdf->Image(FCPATH ."uploads/2023/2307/".$uploadData['file_name'] , 10, 10, 200, 0, $uploadData['image_type']);
                        $pdf->Ln(110); // Jarak vertikal antar gambar

                    // Simpan file PDF ke server
                        
                    } 
                }
            }
                        $file_path = FCPATH . 'uploads/2023/'.date('Y-m-d_his').".pdf";
                        $pdf->Output($file_path, 'F');

                        // $destinationFile = '\\\\server\\shared-folder\\destination-file.ext';
                        $destinationFile = '\\\\10.10.110.116\\Doc_Patient\\LML\\'.date('Y-m-d_his').".pdf";


                        if (copy($file_path, $destinationFile)) {
                            // echo 'File berhasil disalin ke folder sharing';
                            echo json_encode(['status' => 'success', 'message' => 'Upload PDF Sukses']);
                            
                        } else {
                            // echo 'Gagal menyalin file';
                            echo json_encode(['status' => 'error', 'message' => 'Upload PDF Gagal']);

                        }

        }

    }

    public function ConvertPDF($IdTrx)
    {
        $pdf = new FPDF();
        $pdf->AddPage();

        $qt = $this->dbProd23->query();

        foreach ($qt as $va) {
            $pdf->SetFont('helvetica', '', 12);
            // Buat halaman baru
                
            $extension = pathinfo($va->FileName, PATHINFO_EXTENSION);
            // Tambahkan gambar ke halaman PDF
            $pdf->Image("D:/Sharing/ImgTemp/".$va->FileName , 10, 10, 200, 0, $extension);
            $pdf->Ln(110); // Jarak vertikal antar gambar
            $pdf->AddPage();
        }
        $file_path = 'D:/PDF/'.date('Y-m-d_his').".pdf";
        $pdf->Output($file_path, 'F');
    }
    
    public function CekDataTest()
    {
        $q = $this->dbProd23->query("SELECT * FROM Backoffice.dbo.tbl_akses_menu")->result();
        echo json_encode($q);
    }

    public function CekTimeline()
    {

        $json = file_get_contents("php://input"); // json string
        $object = json_decode($json); // php object

        $dataPasien = $this->dbProd23->query("SELECT 
        A.Create_PDS, 
        (SELECT TOP 1 FORMAT(B.Date_User, 'yyyy-MM-dd') + ' ' + LEFT(B.Time_User, 2) + ':' + SUBSTRING(B.Time_User, 3, 2) + ':' + RIGHT(B.Time_User, 2) AS Waktu FROM DB_Transaction_Fix.dbo.History_Trx_Dok_LMA B 
        WHERE B.No_Regist = A.No_Regis AND B.Ket_User = 'PDS' ORDER BY B.Date_User, B.Time_User DESC) AS TimePDS, 
        A.Confirm_GP, 
        (SELECT TOP 1 FORMAT(B.Date_User, 'yyyy-MM-dd') + ' ' + LEFT(B.Time_User, 2) + ':' + SUBSTRING(B.Time_User, 3, 2) + ':' + RIGHT(B.Time_User, 2) AS Waktu FROM DB_Transaction_Fix.dbo.History_Trx_Dok_LMA B 
        WHERE B.No_Regist = A.No_Regis AND B.Ket_User = 'GP' ORDER BY B.Date_User, B.Time_User DESC) AS TimeGP, 
        A.Confirm_Casemix,
        (SELECT TOP 1 FORMAT(B.Date_User, 'yyyy-MM-dd') + ' ' + LEFT(B.Time_User, 2) + ':' + SUBSTRING(B.Time_User, 3, 2) + ':' + RIGHT(B.Time_User, 2) AS Waktu FROM DB_Transaction_Fix.dbo.History_Trx_Dok_LMA B 
        WHERE B.No_Regist = A.No_Regis AND B.Ket_User = 'CASEMIX' ORDER BY B.Date_User, B.Time_User DESC) AS TimeCasemix,
        A.ToFix
        FROM DB_Transaction_Fix.dbo.Laporan_Medis_Awal A WHERE A.No_Regis = '$object->IP_Regist'
        
        ")->row();

        $HistoryPasien = $this->dbProd23->query("SELECT RTRIM(A.Ket_User) AS Ket_User, FORMAT(A.Date_User, 'yyyy-MM-dd') + ' ' + LEFT(A.Time_User, 2) + ':' + SUBSTRING(A.Time_User, 3, 2) + ':' + RIGHT(A.Time_User, 2) AS DateUser, 
        A.Action, 
        (
            IIF(
                (SELECT B.EmployeeName FROM UM.dbo.MsEmployee B WHERE B.EmployeeCode = A.User_Action) IS NULL, 
                (SELECT C.Doctor_Name FROM DB_Master_Fix.dbo.Dokter C WHERE C.Doctor_Code = A.User_Action), --Cek Dokter  
                (SELECT D.EmployeeName FROM UM.dbo.MsEmployee D WHERE D.EmployeeCode = A.User_Action) ) -- Cek Employee
        ) AS UserAction,
        A.User_Action
        FROM DB_Transaction_Fix.dbo.History_Trx_Dok_LMA A 
        WHERE A.No_Regist = '$object->IP_Regist' ORDER BY  A.Date_User, A.Time_User DESC ")->result();

        $data = array(
            "DataPasien" => $dataPasien,
            "HistoryPasien" => $HistoryPasien
        );

        echo json_encode($data);

    }
    public function GetDetailDataPasien()
    {
        $json = file_get_contents("php://input"); // json string
        $object = json_decode($json); // php object

        $DataPasienLMA = $this->dbProd23->query("SELECT * FROM dbo.View_LMA_Regis A WHERE A.No_Regis = '$object->Ip_Registration_No'")->row();
        // $DataPasienLML = $this->dbProd23->query("SELECT B.Patient_Name, A.* FROM DB_Transaction_Fix.dbo.Header_Doc_LML A LEFT JOIN DB_Master_Fix.dbo.Pasien B ON B.MR_No = A.MR_No
        //  WHERE A.Reg_No = '$object->Ip_Registration_No' AND A.File_No = '$object->File_No'")->row();
        // $DataPasien = $this->dbProd23->query("SELECT * FROM DB_Master_Fix.dbo.Pasien A WHERE A.No_Regis = '$object->Ip_Registration_No'")->row();
        $path = trim($DataPasienLMA->PathFile).trim($DataPasienLMA->PDF_FIle);
        // $path = "//10.10.110.116/Doc_Patient/LM/LMA/IP20230726-0004.pdf";
        if ($path == "" || $path == null || $path == " ") {
            $base64String = "";
        }else{
            if (file_exists($path)) {
                $base64String = base64_encode(file_get_contents($path));
            }else{
                $base64String = "";
            }
        }

        $Data = array(
            'DataLMA' => $DataPasienLMA,
            'DataPDF' => $base64String
            // 'DataLML' => $DataPasienLML
        );
        echo json_encode($Data);
    }
    public function ConvertData($IP_Registration_No, $KodeDoc)
    {

        $this->db->query("INSERT INTO log (log, hasillog) values ('$IP_Registration_No', '$KodeDoc')");

        require('assets/fpdf/fpdf.php');
        $DataImg = $this->dbProd23->query("SELECT * FROM DB_Transaction_Fix.dbo.Temp_Upload_Doc_LML WHERE Reg_No = '$IP_Registration_No' AND File_No = '$KodeDoc' ")->result();
        $DataDetail = $this->dbProd23->query("SELECT TOP 1 * FROM DB_Transaction_Fix.dbo.Detail_Doc_LML WHERE Reg_No = '$IP_Registration_No' AND File_No = '$KodeDoc' ORDER BY Seq_No DESC ")->row();

        $pdf = new FPDF();
        $pdf->AddPage();

        // $qt = $this->dbProd23->query();
        foreach ($DataImg as $va) {

            $pdf->SetFont('helvetica', '', 12);
            // Buat halaman baru
                
            $extension = pathinfo($va->File_Name, PATHINFO_EXTENSION);

            // if (file_exists(TRIM($va->File_Path).TRIM($va->File_Name))) {
            //     if (unlink(TRIM($va->File_Path).TRIM($va->File_Name))) {
            //         echo "File berhasil dihapus.";
            //     } else {
            //         echo "Gagal menghapus file.";
            //     }
            // } else {
            //     echo "File tidak ditemukan.";
            // }
            // Tambahkan gambar ke halaman PDF
            // var_dump($extension);
            // $link = '//10.10.110.116/doc_patient/LM/LML/TEMP/'.$va->File_Name;
            $pdf->Image( TRIM($va->File_Path).TRIM($va->File_Name), 10, 10, 200, 0, str_replace(' ', '',$extension));
            $pdf->Ln(110); // Jarak vertikal antar gambar
           
            if( !next( $DataImg ) ) {
            }else{
                $pdf->AddPage();
            }

           

        }
        $file_path = FCPATH . 'uploads/2023/'.date('Y-m-d_his').".pdf";
        $pdf->Output($file_path, 'F');

        $destinationFile = '\\\\10.10.110.116\\Doc_Patient\\LM\\LML\\'.TRIM($DataDetail->File_Name);
        
        if (copy($file_path, $destinationFile)) {
            if (file_exists($file_path)) {
                if (unlink($file_path)) {
                    // echo json_encode(['status' => 'success', 'message' => 'File berhasil dihapus']);

                } else {
                    // echo "Gagal menghapus file.";
                }
            } else {
                // echo "File tidak ditemukan.";
            }
            // echo 'File berhasil disalin ke folder sharing';
            // echo json_encode(['status' => 'success', 'message' => 'Upload PDF Sukses']);
            echo '1';
            
        } else {
            // echo 'Gagal menyalin file';
            // echo json_encode(['status' => 'error', 'message' => 'Upload PDF Gagal']);
            echo '0';
        }
    }
    public function ApproveLMA()
    {
        date_default_timezone_set("Asia/Jakarta");

        $No_Regis = $this->input->post("No_Regis");
       
        $Position_Status = $this->input->post("Position_Status");
        $Note_Chasemix = $this->input->post("Note_Chasemix");

        $q= $this->dbProd23->query("SELECT * FROM dbo.Laporan_Medis_Awal WHERE No_Regis = '$No_Regis'")->row();

        if ($Position_Status == 3) {
            $DataUpdate = array(
                'Confirm_Casemix' => '1',
                'To_PDS' => '1',
                'To_Casemix' => '0'
            );   
            $DataLog = array(
                'Branch' => $q->Branch,
                'No_MR' => $q->No_MR,
                'No_Regist' => $q->No_Regis,
                'Payer' => $q->Asuransi,
                'No_Polis' => $q->No_Polis,
                'Dokter' => $q->Kode_Dokter,
                'Time_Entry' => date('His'),
                'Flag_User' => '1',
                'Ket_User' => 'CM',
                'User_Action' => $this->session->userdata('username'),
                'Time_User' => date('His'),
                'Date_User' => date('Y-m-d'),
                'Action' => 'Confirmed'
            );
        } else if($Position_Status == 4){
            $DataUpdate = array(
                'ToFix' => '1',
                'To_Casemix' => '0',
                'Confirm_GP' => '0',
                'Confirm_CASEMIX' => '1',
            );
            $DataLog = array(
                'Branch' => $q->Branch,
                'No_MR' => $q->No_MR,
                'No_Regist' => $q->No_Regis,
                'Payer' => $q->Asuransi,
                'No_Polis' => $q->No_Polis,
                'Dokter' => $q->Kode_Dokter,
                'Time_Entry' => date('His'),
                'Flag_User' => '1',
                'Ket_User' => 'CM',
                'User_Action' => $this->session->userdata('username'),
                'Time_User' => date('His'),
                'Date_User' => date('Y-m-d'),
                'Action' => 'ToFix'
            );
            $q2= $this->dbProd23->query("SELECT * FROM DB_Transaction_Fix.dbo.With_Notes_LMA WHERE No_MR = '$q->No_MR' AND No_Regis = '$No_Regis' ORDER BY No DESC")->row();
            $DataWithNote = array(
                'Branch' => $q->Branch,
                'No' => $q2->No + 1,
                'No_MR' => $q->No_MR,
                'No_Regis' => $No_Regis,
                'With_Note' => $this->input->post('Note_Chasemix'),
                'Casemix' => 'WithNote'
            );
            $this->dbProd23->insert('DB_Transaction_Fix.dbo.With_Notes_LMA', $DataWithNote);

        } else if($Position_Status == 5){

            $DataUpdate = array(
                'Confirm_GP' => '0',
                'Decline' => '1',
                'Confirm_CASEMIX' => '0',
                'To_Casemix' => '0'
            );
            $q2= $this->dbProd23->query("SELECT * FROM DB_Transaction_Fix.dbo.With_Notes_LMA WHERE No_MR = '$q->No_MR' AND No_Regis = '$No_Regis' ORDER BY No DESC")->row();
            $DataWithNote = array(
                'Branch' => $q->Branch,
                'No' => $q2->No + 1,
                'No_MR' => $q->No_MR,
                'No_Regis' => $No_Regis,
                'With_Note' => $this->input->post('Note_Chasemix'),
                'Casemix' => 'Declined'
            );
            $this->dbProd23->insert('DB_Transaction_Fix.dbo.With_Notes_LMA', $DataWithNote);

            $DataLog = array(
                'Branch' => $q->Branch,
                'No_MR' => $q->No_MR,
                'No_Regist' => $q->No_Regis,
                'Payer' => $q->Asuransi,
                'No_Polis' => $q->No_Polis,
                'Dokter' => $q->Kode_Dokter,
                'Time_Entry' => date('His'),
                'Flag_User' => '1',
                'Ket_User' => 'CM',
                'User_Action' => $this->session->userdata('username'),
                'Time_User' => date('His'),
                'Date_User' => date('Y-m-d'),
                'Action' => 'Declined'
            );
        }

        // var_dump($DataUpdate);
        // exit();
        $this->dbProd23->insert('dbo.History_Trx_Dok_LMA',$DataLog);
        $this->M_LMA->UpdateDataLMA($No_Regis, $DataUpdate);

        // $this->dbProd23->where('No_Regis', $No_Regis);
        // $this->dbProd23->update('Laporan_Medis_Awal', $DataUpdate);


         // redirect("Webfullcontrol/Sys/Akses");
         $qdat = ($this->dbProd23->affected_rows() != 1) ? false : true;

         $dataArr = array('ValReturn' => $qdat);
         echo json_encode($dataArr);
    }

    public function ApproveLMAtoFix()
    {
        date_default_timezone_set("Asia/Jakarta");

        $No_Regis = $this->input->post("No_Regis");


        $DataUpdate = array(
            'ToFix' => 1,
        );
        
        $this->M_LMA->UpdateDataLMAtoFix($No_Regis, $DataUpdate);
        // $this->dbProd23->where('No_Regis', $No_Regis);
        // $this->dbProd23->update('dbo.Laporan_Medis_Awal', $DataUpdate);

        $q= $this->dbProd23->query("SELECT * FROM dbo.Laporan_Medis_Awal WHERE No_Regis = '$No_Regis'")->row();

        $DataLog = array(
            'Branch' => $q->Branch,
            'No_MR' => $q->No_MR,
            'No_Regist' => $q->No_Regis,
            'Payer' => $q->Asuransi,
            'No_Polis' => $q->No_Polis,
            'Dokter' => $q->Kode_Dokter,
            'Time_Entry' => date('His'),
            'Flag_User' => '1',
            'Ket_User' => 'CM',
            'User_Action' => $this->session->userdata('username'),
            'Time_User' => date('His'),
            'Date_User' => date('Y-m-d'),
            'Action' => 'ToFix'
        );

        $this->dbProd23->insert('dbo.History_Trx_Dok_LMA',$DataLog);
        
         // redirect("Webfullcontrol/Sys/Akses");
         $qdat = ($this->dbProd23->affected_rows() != 1) ? false : true;

         $dataArr = array('ValReturn' => $qdat);
         echo json_encode($dataArr);
    }
}
