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
// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class LapPatient extends MY_Controller
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
        $this->load->model("M_LapPatient");
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
        $data['judul'] = "Laporan Pasien";
        $this->template->backend('index', $data);
    }
    public function data_detail()
    {
       ini_set('memory_limit','300M'); // This also needs to be increased in some cases. Can be changed to a higher value as per need)
      ini_set('sqlsrv.ClientBufferMaxKBSize','524288'); // Setting to 512M
      ini_set('pdo_sqlsrv.client_buffer_max_kb_size','524288'); // Setting to 512M - for pdo_sqlsrv
        // $start = $this->input->post("start");
        // echo $start."test";
        $date_awal = $this->input->post("date_awal");
        $date_akhir = $this->input->post("date_akhir");
        
        $karyawan = $this->input->post("karyawan");
        
        $nik = $this->session->userdata('username');
        $hasil = array(
            'draw' => $_POST['draw'],
            'recordsTotal' => $this->M_LapPatient->count_all($date_awal,$date_akhir),
            'recordsFiltered' => $this->M_LapPatient->count_filtered($date_awal,$date_akhir),
            "data" => $this->M_LapPatient->get_datatables($date_awal,$date_akhir),
        );
        echo json_encode($hasil);

    }
    public function export(){
		ini_set('memory_limit','300M'); // This also needs to be increased in some cases. Can be changed to a higher value as per need)
      ini_set('sqlsrv.ClientBufferMaxKBSize','524288'); // Setting to 512M
      ini_set('pdo_sqlsrv.client_buffer_max_kb_size','524288'); // Setting to 512M - for pdo_sqlsrv
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
      $sheet->setCellValue('A1', "DATA Patient"); 
      $sheet->mergeCells('A1:E1'); 
      $sheet->getStyle('A1')->getFont()->setBold(true);
      
      $sheet->setCellValue('A3', "IP Registration No"); 
      $sheet->setCellValue('B3', "MR No"); 
      $sheet->setCellValue('C3', "Nama Patient"); 
      $sheet->setCellValue('D3', "Payer Name"); 
      $sheet->setCellValue('E3', "Date Registration"); 
      $sheet->setCellValue('F3', "Status Data"); 
      $sheet->setCellValue('G3', "Date Perintah Pulang"); 
      $sheet->setCellValue('H3', "No eKTM"); 
      $sheet->setCellValue('I3', "Date Ke PDS"); 
      $sheet->setCellValue('J3', "Date Terima PDS"); 
      $sheet->setCellValue('K3', "Date Last Order Presc"); 
      $sheet->setCellValue('L3', "User Order Presc"); 
      $sheet->setCellValue('M3', "Date Last Confirm Presc"); 
      $sheet->setCellValue('N3', "User Confirm Presc"); 
      $sheet->setCellValue('O3', "Date Last Retur Presc"); 
      $sheet->setCellValue('P3', "User Retur Presc"); 
      $sheet->setCellValue('Q3', "Date Confirm Retur Presc"); 
      $sheet->setCellValue('R3', "User Confirm Retur Presc"); 
      $sheet->setCellValue('S3', "Date Discharge"); 
      $sheet->setCellValue('T3', "User Discharge"); 
      $sheet->setCellValue('U3', "Date Kirim Jaminan"); 
      $sheet->setCellValue('V3', "User Kirim Jaminan"); 
      $sheet->setCellValue('W3', "Date Terima Jaminan"); 
      $sheet->setCellValue('X3', "User Terima Jaminan"); 
      $sheet->setCellValue('Y3', "Keterangan Terima Jaminan"); 
      $sheet->setCellValue('Z3', "Date Invoice"); 
      $sheet->setCellValue('AA3', "User Invoice"); 
      $sheet->setCellValue('AB3', "Date Leave Room"); 
      $sheet->setCellValue('AC3', "User Leave Room"); 
      
      $sheet->getStyle('A3')->applyFromArray($style_col);
      $sheet->getStyle('B3')->applyFromArray($style_col);
      $sheet->getStyle('C3')->applyFromArray($style_col);
      $sheet->getStyle('D3')->applyFromArray($style_col);
      $sheet->getStyle('E3')->applyFromArray($style_col);
      $sheet->getStyle('F3')->applyFromArray($style_col);
      $sheet->getStyle('G3')->applyFromArray($style_col);
      $sheet->getStyle('H3')->applyFromArray($style_col);
      $sheet->getStyle('I3')->applyFromArray($style_col);
      $sheet->getStyle('J3')->applyFromArray($style_col);
      $sheet->getStyle('K3')->applyFromArray($style_col);
      $sheet->getStyle('L3')->applyFromArray($style_col);
      $sheet->getStyle('M3')->applyFromArray($style_col);
      $sheet->getStyle('N3')->applyFromArray($style_col);
      $sheet->getStyle('O3')->applyFromArray($style_col);
      $sheet->getStyle('P3')->applyFromArray($style_col);
      $sheet->getStyle('Q3')->applyFromArray($style_col);
      $sheet->getStyle('R3')->applyFromArray($style_col);
      $sheet->getStyle('S3')->applyFromArray($style_col);
      $sheet->getStyle('T3')->applyFromArray($style_col);
      $sheet->getStyle('U3')->applyFromArray($style_col);
      $sheet->getStyle('V3')->applyFromArray($style_col);
      $sheet->getStyle('W3')->applyFromArray($style_col);
      $sheet->getStyle('X3')->applyFromArray($style_col);
      $sheet->getStyle('Y3')->applyFromArray($style_col);
      $sheet->getStyle('Z3')->applyFromArray($style_col);
      $sheet->getStyle('AA3')->applyFromArray($style_col);
      $sheet->getStyle('AB3')->applyFromArray($style_col);
      $sheet->getStyle('AC3')->applyFromArray($style_col);
     
      $date_awal = $this->input->post('date_awal');
      $date_akhir = $this->input->post('date_akhir');
      $dataPatient = $this->M_LapPatient->getDataAll($date_awal, $date_akhir);
      $no = 1; 
      $numrow = 4; 
      foreach($dataPatient as $data){ 
        $sheet->setCellValue('A'.$numrow, $data->IP_Registration_No);
        $sheet->setCellValue('B'.$numrow, $data->MR_No);
        $sheet->setCellValue('C'.$numrow, $data->Patient_Name);
        $sheet->setCellValue('D'.$numrow, $data->Company_Name);
        $sheet->setCellValue('E'.$numrow, $data->Date_Registration);
        $sheet->setCellValue('F'.$numrow, $data->Status_Data); 
        $sheet->setCellValue('G'.$numrow, $data->Date_Perintah_Pulang); 
        $sheet->setCellValue('H'.$numrow, $data->No_EKTM); 
        $sheet->setCellValue('I'.$numrow, $data->Date_Ke_PDS); 
        $sheet->setCellValue('J'.$numrow, $data->Date_Terima_PDS); 
        $sheet->setCellValue('K'.$numrow, $data->Date_Last_Order_Presc); 
        $sheet->setCellValue('L'.$numrow, $data->User_Last_Order_Presc); 
        $sheet->setCellValue('M'.$numrow, $data->Date_Last_Confrm_Presc); 
        $sheet->setCellValue('N'.$numrow, $data->User_Last_Confrm_Presc); 
        $sheet->setCellValue('O'.$numrow, $data->Date_Last_Retur_Presc); 
        $sheet->setCellValue('P'.$numrow, $data->User_Last_Retur_Presc); 
        $sheet->setCellValue('Q'.$numrow, $data->Date_Confrm_Retur_Presc); 
        $sheet->setCellValue('R'.$numrow, $data->User_Confrm_Retur_Presc); 
        $sheet->setCellValue('S'.$numrow, $data->Date_Discharge); 
        $sheet->setCellValue('T'.$numrow, $data->User_Discharge); 
        $sheet->setCellValue('U'.$numrow, $data->Date_Kirim_Jaminan); 
        $sheet->setCellValue('V'.$numrow, $data->User_Kirim_Jaminan); 
        $sheet->setCellValue('W'.$numrow, $data->Date_Terima_Jaminan); 
        $sheet->setCellValue('X'.$numrow, $data->User_Terima_Jaminan); 
        $sheet->setCellValue('Y'.$numrow, $data->Keterangan_Terima_Jaminan); 
        $sheet->setCellValue('Z'.$numrow, $data->Date_Invoice); 
        $sheet->setCellValue('AA'.$numrow, $data->User_Invoice); 
        $sheet->setCellValue('AB'.$numrow, $data->Date_Leave_Room); 
        $sheet->setCellValue('AC'.$numrow, $data->User_Leave_Room); 
        
        $sheet->getStyle('A'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('B'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('C'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('D'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('E'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('F'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('G'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('H'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('I'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('J'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('K'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('L'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('M'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('N'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('O'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('P'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('Q'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('R'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('S'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('T'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('U'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('V'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('W'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('X'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('Y'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('Z'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('AA'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('AB'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('AC'.$numrow)->applyFromArray($style_row);
        
        $no++; 
        $numrow++; 
      }
      
      $sheet->getColumnDimension('A')->setWidth(5); 
      $sheet->getColumnDimension('B')->setWidth(15); 
      $sheet->getColumnDimension('C')->setWidth(25); 
      $sheet->getColumnDimension('D')->setWidth(20); 
      $sheet->getColumnDimension('E')->setWidth(30); 
      $sheet->getColumnDimension('F')->setWidth(20); 
      $sheet->getColumnDimension('G')->setWidth(20); 
      $sheet->getColumnDimension('H')->setWidth(20); 
      $sheet->getColumnDimension('I')->setWidth(20); 
      $sheet->getColumnDimension('J')->setWidth(20); 
      $sheet->getColumnDimension('K')->setWidth(20); 
      $sheet->getColumnDimension('L')->setWidth(20); 
      $sheet->getColumnDimension('M')->setWidth(20); 
      $sheet->getColumnDimension('N')->setWidth(20); 
      $sheet->getColumnDimension('O')->setWidth(20); 
      $sheet->getColumnDimension('P')->setWidth(20); 
      $sheet->getColumnDimension('Q')->setWidth(20); 
      $sheet->getColumnDimension('R')->setWidth(20); 
      $sheet->getColumnDimension('S')->setWidth(20); 
      $sheet->getColumnDimension('T')->setWidth(20); 
      $sheet->getColumnDimension('U')->setWidth(20); 
      $sheet->getColumnDimension('V')->setWidth(20); 
      $sheet->getColumnDimension('W')->setWidth(20); 
      $sheet->getColumnDimension('X')->setWidth(20); 
      $sheet->getColumnDimension('Y')->setWidth(20); 
      $sheet->getColumnDimension('Z')->setWidth(20); 
      $sheet->getColumnDimension('AA')->setWidth(20); 
      $sheet->getColumnDimension('AB')->setWidth(20); 
      $sheet->getColumnDimension('AC')->setWidth(20); 
      
      $sheet->getDefaultRowDimension()->setRowHeight(-1);
      
      $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
      
      $sheet->setTitle("Laporan Data Patient");
      
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment; filename="Data Patient '.date("Y-m-d H:i:s").'.xlsx"'); 
      header('Cache-Control: max-age=0');
      $writer = new Xlsx($spreadsheet);
      $writer->save('php://output');
    }
    
}
