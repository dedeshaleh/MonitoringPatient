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
    public function GetLogin()
    {
        date_default_timezone_set("Asia/Jakarta");
        $json = file_get_contents("php://input"); // json string
        $object = json_decode($json); // php object

        $Branch = $object->Branch;
        $client_id = $object->client_id;
        $status = $object->status;
        $client_secret = $object->client_secret;

        $q = $this->db->query("SELECT * FROM SatuSehat.Environment WHERE Branch = '$Branch' AND Status = '$status' AND client_id = '$client_id' AND client_secret = '$client_secret' ")->row();
        if ($q !== null) {
            // Menghasilkan byte acak
            $randomBytes = random_bytes(32);

            // Mengonversi byte ke dalam format base64
            $base64Code = str_replace(['+', '/', '='], ['', '', ''], base64_encode($randomBytes));

            $GenToken = $base64Code;

            $dataToken = array(
                'NoTrx' => uniqid(true).date("Y_m_d"),
                'access_token' => $GenToken,
                'client_id' => $client_id,
                'expires_in' => 60*60,
                'CreateDate' => date("Y-m-d H:i:s"),
                'TokenAkses' => "Get Credential 365"
            );
    
            $this->db->insert('SatuSehat.Log_Token', $dataToken);

            $data = array(
                "status" => 200,
                "message" => "Success Access Credentials",
                "Token" => $GenToken
            );
        }else{
            $data = array(
                "status" => 400,
                "message" => "Invalid Credentials"
            );
        }
        
        echo json_encode($data);

    }
    
    function ToCsv()
    {

        $json = file_get_contents("php://input"); 
        $object = json_decode($json);

        $Token = $object->Token;
        $Module = $objcet->Module;
        $Tanggal = $object->Tanggal;

        $q2 = $this->db->query("SELECT * FROM EMR.SatuSehat.Log_Token WHERE access_token = '$Token' ")->row();

        $GetDate = $q2->CreateDate;
        $NewDate = date("Y-m-d H:i:s");

        $startTimeStamp = strtotime($GetDate);
        $currentTimeStamp = strtotime($NewDate);
        $timeDifferenceInSeconds = $currentTimeStamp - $startTimeStamp;

        if ($timeDifferenceInSeconds > $q2->expires_in ) {
            $data = array(
                "status" => 400,
                "message" => "Credentials Failed"
            );
            echo json_encode($data);
            die;
        }




        if ($Module == "StockMovement") {
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
        } else {
            $Data = array(
                "status" => 300,
                "message" => "Wrong Credential"
            );
            echo json_encode($Data);
            die();
        }
        

            
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
            $outputFile = '\\\\10.10.110.116\\Backoffice\\DataCSV\\Data CSV '.date("Y-m-d His").'.csv'; // Simpan File Ke Direktori Server File
            $writer->save($outputFile);
            $GetFile = '\\\\10.10.110.116\\Backoffice\\DataCSV\\Data CSV '.date("Y-m-d His").'.csv'; // Simpan File Ke Direktori Server File

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
            $remotePath = '\\DEV\\IN\\BHI\\ReferralCommission\\Data CSV '.date("Y-m-d His").'.csv'; // Folder Tujuan ke File

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
