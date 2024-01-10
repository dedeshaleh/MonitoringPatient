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
use PhpOffice\PhpSpreadsheet\Writer\Csv;
// use phpseclib\Net\SFTP;
use phpseclib3\Net\SFTP;

// class Webcontrol extends BackendController
class ExportCSV extends MY_Controller
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
        // if (!$this->session->userdata('logStatus') == 'MPLogin') {
        //     redirect();
        // }
        // To inherit directly the attributes of the parent class.
        parent::__construct();
        // $this->load->model("M_Dashboard");
        $this->dbProd23 = $this->load->database('dbProd23', TRUE);
    }

    /**
     * [index description]
     *
     * @method index
     *
     * @return [type] [description]
     */
    function ToCsv()
    {
        $url = base_url();
        if ($url == 'http://10.10.210.78/MonitoringPatient') {
            $query = $this->dbProd23->query("SELECT D.Lokasi AS Lokasi,'IP' AS LOB,'ADMINISTRATION' AS GroupRevenue,'ADMINISTRATION' AS [Desc],'ADMINISTRATION' as DescRevenue,'ADMINISTRATION' AS [Description],'ADMINISTRATION' AS SubDescription,B.[Date],A.IP_Registration_No AS NoReg,A.[Date] AS DateReg,C.Invoice_No,C.Inv_date AS PaymentDate,A.Status_Data AS Data_Status, 0 AS COGS,A.MR_No,A.Patient_Name,B.Ward AS Unit,B.Class,A.Payer AS CompanyCode,(B.Amount) AS Gross,(B.Disc_Rp)Disc,(B.Subtotal) Netto,
            CASE WHEN B.Charge_Code='' THEN LEFT(B.Group_Code,2) ELSE LEFT(B.Charge_Code,2) END AS Group1,
            CASE WHEN B.Charge_Code='' THEN LEFT(B.Group_Code,4) ELSE LEFT(B.Charge_Code,4) END AS Group2,B.Group_Code,B.Charge_Code,A.Doctor_In_Charge,B.Doctor_Pratice,'' AS Doctor_Prescribe,B.[Status] AS AdaKoreksi,B.Doc_Fee_Persen,B.Doc_Fee_Ammount,B.Store,B.Tran_No,B.Tran_Correc_No AS Tran_No_Correction,B.Qty,B.Seq_No AS R_No FROM dbo.RI_Tran_Registrasi A  
            INNER JOIN dbo.RI_Tran_FAC_Detail B ON A.IP_Registration_No = B.Reg_No
            LEFT JOIN dbo.RI_Tran_Invoice C ON A.IP_Registration_No = C.IP_Reg_No
            LEFT JOIN DB_Master_Fix.dbo.Line_Of_Service D ON A.Ward = D.Poly_Type
            WHERE CAST(B.[Date] AS DATE) BETWEEN '2024-01-08' AND '2024-01-08' AND B.Group_Code='0101' AND B.Package_Without_Charge=0")->result();
            $query2 = $this->dbProd23->query("SELECT COUNT(*) AS Total FROM dbo.RI_Tran_Registrasi A  
            INNER JOIN dbo.RI_Tran_FAC_Detail B ON A.IP_Registration_No = B.Reg_No
            LEFT JOIN dbo.RI_Tran_Invoice C ON A.IP_Registration_No = C.IP_Reg_No
            LEFT JOIN DB_Master_Fix.dbo.Line_Of_Service D ON A.Ward = D.Poly_Type
            WHERE CAST(B.[Date] AS DATE) BETWEEN '2024-01-08' AND '2024-01-08' AND B.Group_Code='0101' AND B.Package_Without_Charge=0")->row();
            // $results = $query->result_array();
            // Membuat objek spreadsheet
            

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            // Menambahkan baris header dengan nilai khusus
            $sheet->setCellValue('A1', $query2->Total);
            // Menambahkan data dari hasil query ke spreadsheet
            $row = 2;
            foreach ($query as $result) {
                $col = 1;
                foreach ($result as $value) {
                    $sheet->setCellValueByColumnAndRow($col++, $row, $value);
                }
                $row++;
            }

            // Menyimpan sebagai file CSV
            $writer = new Csv($spreadsheet);
            $writer->setDelimiter(';');
            $writer->setEnclosure('');
            // $outputFile = 'output.csv';
            // $writer->save($outputFile);
            $outputFile = '\\\\10.10.110.116\\Backoffice\\DataCSV\\Data CSV '.date("Y-m-d His").'.csv'; // FCPATH mengambil path ke direktori kerja CodeIgniter
            $writer->save($outputFile);
            $GetFile = '\\\\10.10.110.116\\Backoffice\\DataCSV\\Data CSV '.date("Y-m-d His").'.csv'; // FCPATH mengambil path ke direktori kerja CodeIgniter

            $sftpConfig = array(
                'hostname' => '172.188.64.207',
                'port' => 22,
                'username' => 'bethsftp',
                'password' => 'B3thsftp!!',
            );

            $sftp = new SFTP($sftpConfig['hostname'], $sftpConfig['port']);
            
            if (!$sftp->login($sftpConfig['username'], $sftpConfig['password'])) {
                die('Login Failed');
            }

            // Path di server SFTP tempat Anda ingin menyimpan file
            // $remotePath = '/path/to/remote/directory/';

            // Path lokal ke file yang akan diunggah
            $remotePath = '\\DEV\\IN\\BHI\\ReferralCommission\\Data CSV '.date("Y-m-d His").'.csv'; // FCPATH mengambil path ke direktori kerja CodeIgniter

            // Nama file di server SFTP (bisa sama atau berbeda dengan nama lokal)

            // Mencoba mengunggah file
            if ($sftp->put($remotePath, $GetFile, SFTP::SOURCE_LOCAL_FILE)) {
                echo 'File berhasil diunggah.';
            } else {
                echo 'Gagal mengunggah file.';
            }

            echo "File CSV berhasil dibuat: $remotePath";
        } else {
            echo "Maaf Anda Salah halaman";
        }
        
        
    }
}
