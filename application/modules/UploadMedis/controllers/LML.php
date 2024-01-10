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
class LML extends MY_Controller
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
        $this->load->model("M_LMA");
        $this->load->library('upload');
        include('assets/qr_code/qrlib.php');
        $this->dbDev = $this->load->database('dbDev', TRUE);
        $this->dbProd23 = $this->load->database('dbProd23', TRUE);
        // if ($this->session->userdata('logStatus') != 'MPLogin') {
        //     redirect('');
        // }

    }

    /**
     * [index description]
     *
     * @method index
     *
     * @return [type] [description]
     */
    public function UploadQR($IP_Registration_No, $File_No, $Dokter)
    {
        $data['judul'] = "Upload Data Laporan Medis Lanjutan";
        $data['DataPasien'] = $this->dbDev->query("SELECT C.Doctor_Name, B.Company_Name, A.* FROM DB_Transaction_Fix.dbo.RI_Tran_Registrasi A
        INNER JOIN DB_Master_Fix.dbo.Perusahaan B ON B.Company_Code = A.Payer
        INNER JOIN DB_Master_Fix.dbo.Dokter C ON C.Doctor_Code = A.Doctor_In_Charge
        WHERE A.IP_Registration_No = '$IP_Registration_No'")->row();
        $data['File_No'] = $File_No; 
        $data['Dokter'] = $this->dbDev->query("SELECT * FROM DB_Master_Fix.dbo.Dokter WHERE Doctor_Code = '$Dokter'")->row(); 
        $CekData = $this->dbDev->query("SELECT * FROM DB_Transaction_Fix.dbo.Header_Doc_LML WHERE Reg_No = '$IP_Registration_No' AND File_No='$File_No' ")->row();
        $data['header'] = $this->dbDev->query("SELECT * FROM DB_Transaction_Fix.dbo.Header_Doc_LML WHERE Reg_No = '$IP_Registration_No' AND File_No='$File_No' ")->row();
        // var_dump($CekData);

        if ($CekData->Position_Status == 2 || $CekData->Position_Status == 3 || $CekData->Position_Status == 6) {

            $this->load->view('LaporanMedis/LML/StopView', $data);

        }else{
            $this->load->view('LaporanMedis/LML/UploadView', $data);
        }
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
         $folderPath = "uploads/".$currentYearBig."/".$currentMonth."/";
        
         
         if (!file_exists($folderPath)) {
             mkdir($folderPath, 0777, true);
         }
         $IP_Registration_No = $this->input->post('IP_Registration_No');
         $CekRegis = $this->dbDev->query("SELECT * FROM DB_Transaction_Fix.dbo.Detail_Doc_LML WHERE Reg_No = '$IP_Registration_No' ORDER BY Seq_No DESC")->row();

        $config['upload_path'] = $folderPath; // Ganti dengan direktori tempat Anda ingin menyimpan gambar
        $config['allowed_types'] = 'jpg|png|jpeg|pdf';
        // $config['max_size'] = 2048; // Batasan ukuran file (dalam kilobita)
        $config['encrypt_name'] = TRUE; // Mengenkripsi nama file yang diunggah
        $config['resize'] = TRUE; // Mengenkripsi nama file yang diunggah

        $this->upload->initialize($config);
        $files = $_FILES['images'];
        $extension="";
        $no = 1;
        if ($files == null || $files == '') {
            $data = array(
                'status' => 'error',
                'message' => 'Maaf Anda Tidak Memilih File, Mohon Pilih salah satu'
            );
            echo json_encode($data);
        }else{
            foreach ($files['name'] as $va => $name) { $no++;
                $file = $name;
                $extension.= pathinfo($file, PATHINFO_EXTENSION);
                if ($this->security->xss_clean($files['name'], TRUE) === FALSE)
                {
                    $data = array(
                        'status' => 'error',
                        'message' => 'Data Terdeteksi Virus Page '.$no
                    );
                    echo json_encode($data);
                    die();
                }
            }
            $pattern = "/pdf/i";
            if (preg_match($pattern, $extension)) {
                $hitung = count($files['name']);
                if ($hitung > 1) {
                    // echo json_encode(['status' => 'error', 'message' => 'Maaf File Upload PDF tidak Boleh lebih dari 1 !!']);
                    $data = array(
                        'status' => 'error',
                        'message' => 'Maaf File Upload PDF tidak Boleh lebih dari 1 !!'
                    );
                    echo json_encode($data);
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
                            // echo json_encode(['status' => 'success', 'message' => 'Upload PDF successful']);
                            $data = array(
                                'status' => 'success',
                                'message' => 'Upload PDF successful'
                            );
                            echo json_encode($data);
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
                            $pdf->Image(FCPATH ."$folderPath/".$uploadData['file_name'] , 5, 5, 200, 0, $uploadData['image_type']);
                            $pdf->Ln(110); // Jarak vertikal antar gambar
                            if( !next( $files['name'] ) ) {
                            }else{
                                $pdf->AddPage();
                            }
                        // Simpan file PDF ke server
                            
                        } 
                    }
                }
                
                            $name = $CekRegis->File_No.'_'.($CekRegis->Seq_No+1).'.PDF';
                            $file_path = FCPATH . 'uploads/2023/'.$name;
                            $pdf->Output($file_path, 'F');
    
                            // $destinationFile = '\\\\server\\shared-folder\\destination-file.ext';
                            $path = "\\\\10.10.110.116\\Doc_Patient\\LM\\LML\\";
                            $name = $CekRegis->File_No.'_'.($CekRegis->Seq_No+1).'.PDF';
                            $destinationFile = $path.$name;

                            if (copy($file_path, $destinationFile)) {
                                // echo 'File berhasil disalin ke folder sharing';
                                $base64String = base64_encode(file_get_contents($destinationFile));
    
                                $data = array(
                                    'status' => 'success',
                                    'message' => 'Upload PDF Sukses',
                                    'DataPdf' => $base64String,
                                    'FilePath' => $path,
                                    'FileName' => $name,
                                    'fullPath' => $destinationFile
                                );
                                echo json_encode($data);
                                
                            } else {
                                $data = array(
                                    'status' => 'error',
                                    'message' => 'Upload PDF Gagal'
                                );
                                // echo 'Gagal menyalin file';
                                echo json_encode($data);
    
                            }
    
            }
        }
        

    }

    public function ConvertPDF($IdTrx)
    {
        $pdf = new FPDF();
        $pdf->AddPage();

        $qt = $this->dbDev->query();

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
    
    public function ConvertData($IP_Registration_No, $KodeDoc, $SeqNo)
    {

        $this->db->query("INSERT INTO log (log, hasillog, SeqNo) values ('$IP_Registration_No', '$KodeDoc', '$SeqNo')");

        require('assets/fpdf/fpdf.php');
        $DataImg = $this->dbDev->query("SELECT * FROM DB_Transaction_Fix.dbo.Temp_Upload_Doc_LML WHERE Reg_No = '$IP_Registration_No' AND File_No = '$KodeDoc' AND Seq_No = '$SeqNo' ORDER BY SubSeqNo ASC ")->result();
        $DataDetail = $this->dbDev->query("SELECT TOP 1 * FROM DB_Transaction_Fix.dbo.Detail_Doc_LML WHERE Reg_No = '$IP_Registration_No' AND File_No = '$KodeDoc' AND Seq_No = '$SeqNo' ORDER BY Seq_No DESC ")->row();

        $pdf = new FPDF();
        $pdf->AddPage();

        // $qt = $this->dbDev->query();
        // var_dump($DataImg);
        // exit();
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
    public function ApproveLML()
    {
        date_default_timezone_set("Asia/Jakarta");

        $Reg_No = $this->input->post("Reg_No");
        $File_No = $this->input->post("File_No");
        $DataUpdate = array(
            'BA_Approve' => 1,
            'User_BA_Approve' => $this->session->userdata('username'),
            'Date_BA_Approve' => date('Y-m-d'),
            'Time_BA_Approve' => date('His')
        );
    
        $this->dbDev->where('Reg_No', $Reg_No);
        $this->dbDev->where('File_No', $File_No);
        $this->dbDev->update('dbo.Header_Doc_LML', $DataUpdate);

         // redirect("Webfullcontrol/Sys/Akses");
         $qdat = ($this->dbDev->affected_rows() != 1) ? false : true;

         $dataArr = array('ValReturn' => $qdat);
         echo json_encode($dataArr);
    }

    public function ConfirmData()
    {
        date_default_timezone_set("Asia/Jakarta");

        $IP_Regis = $this->input->post('IP_Regis');
        $FileNo = $this->input->post('FileNo');
        $Dokter = $this->input->post('User');
        $q = $this->dbDev->query("SELECT * FROM DB_Transaction_Fix.dbo.Detail_Doc_LML WHERE Reg_No = '$IP_Regis' AND File_No = '$FileNo' ORDER BY Seq_No DESC")->row();
        // var_dump($q, $IP_Regis, $FileNo);
        $data['LinkBack'] = "https://extranet.bethsaidahospitals.com/DevPatient/UploadMedis/LML/UploadQR/".$IP_Regis."/".$FileNo."/".$Dokter."";
        if ($q == null || $q == '') {
            // $data = array(
            //     'status' => 'error',
            //     'message' => 'Gagal Simpan Data Tidak Di Temukan'
            // );
            $data['Judul'] = "Judul";
            $data['Status'] = "0";
            $this->session->set_flashdata('msg', 'Gagal Simpan Data Tidak Di Temukan');
            // echo 'Gagal menyalin file';
            // echo json_encode($data);
            $this->load->view('LaporanMedis/LML/Confirm', $data);
        }else{
            $data = array(
                'Branch' => $q->Branch,
                'Reg_No' => $IP_Regis,
                'File_No' => $FileNo,
                'Seq_No' => $q->Seq_No + 1,
                'File_Name' => $this->input->post('FileName'),
                'File_Path' => $this->input->post('FilePath'),
                'File_Extention' => 'PDF',
                'Create_User' => $this->input->post('User'),
                'Create_Date' => date('Y-m-d'),
                'Create_Time' => date('His'),
                'Initial_Document' => $this->input->post('Initial_Document')
            );
    
            $qcek = $this->dbDev->query("SELECT * FROM DB_Transaction_Fix.dbo.Header_Doc_LML WHERE Reg_No = '$IP_Regis' AND File_No = '$FileNo'")->row();
            
            if ($qcek->Position_Status == 4) {
                $DataHeader = array(
                    'Position_Status' => 3,
                    'Doctor_Receive' => 1,
                    'User_Doc_Receive' => $this->input->post('User'),
                    'Date_Doc_Receive' => date('Y-m-d'),
                    'Time_Doc_Receive' => date('His'),
                );                
                $this->dbDev->where('Reg_No', $IP_Regis);
                $this->dbDev->where('File_No', $FileNo);
                $this->dbDev->update('DB_Transaction_Fix.dbo.Header_Doc_LML', $DataHeader);
            }
            if ($qcek->Position_Status == 1) {
                $DataHeader = array(
                    'Position_Status' => 2,
                    'Doctor_Receive' => 1,
                    'User_Doc_Receive' => $this->input->post('User'),
                    'Date_Doc_Receive' => date('Y-m-d'),
                    'Time_Doc_Receive' => date('His'),
                );
                $this->dbDev->where('Reg_No', $IP_Regis);
                $this->dbDev->where('File_No', $FileNo);
                $this->dbDev->update('DB_Transaction_Fix.dbo.Header_Doc_LML', $DataHeader);
            }
            if ($qcek->Position_Status == 5) {
                $DataHeader = array(
                    'Position_Status' => 2,
                    'Doctor_Receive' => 1,
                    'User_Doc_Receive' => $this->input->post('User'),
                    'Date_Doc_Receive' => date('Y-m-d'),
                    'Time_Doc_Receive' => date('His'),
                );
                $this->dbDev->where('Reg_No', $IP_Regis);
                $this->dbDev->where('File_No', $FileNo);
                $this->dbDev->update('DB_Transaction_Fix.dbo.Header_Doc_LML', $DataHeader);
            }
            
            
            $q = $this->dbDev->query("SELECT * FROM DB_Transaction_Fix.dbo.Header_Doc_LML WHERE Reg_No = '$IP_Regis' AND File_No = '$FileNo'")->row();
        
            $NamaDokumen = $this->input->post('FileName');
            $qdata = $this->dbDev->query("SELECT * FROM DB_Master_Fix.dbo.Multi_Parameter_Detail WHERE Master_Code = 'STLML' AND Code = '2'")->row();

            $CekHistory = $this->dbDev->query("SELECT * FROM DB_Transaction_Fix.dbo.History_Download_view_Doc WHERE No_Registration = '$IP_Regis' ORDER BY Seq_No DESC")->row();
          
                $DataHistory = array(
                    'Branch' => $q->Branch,
                    'File_No' => $q->File_No,
                    'No_Registration' => $IP_Regis,
                    'Seq_No' => $CekHistory->Seq_No + 1,
                    'Position_Status' => 2,
                    'Nama_Document' => $this->input->post('FileName'),
                    'Action' => trim($qdata->Alpha),
                    'Create_User' => $this->input->post('User'),
                    'Create_Date' => date('Y-m-d'),
                    'Create_Time' => date('His'),
                    'Remark_With_Note' => '',
                    'Source' => 'WEB'
                );
                $this->dbDev->insert('DB_Transaction_Fix.dbo.Detail_Doc_LML', $data);
                $this->dbDev->insert('DB_Transaction_Fix.dbo.History_Download_view_Doc', $DataHistory);
            
            // $data = array(
            //     'status' => 'error',
            //     'message' => 'Gagal Simpan Data Tidak Di Temukan'
            // );
            $data['Judul'] = "Judul";
            $data['Status'] = "1";
            $this->session->set_flashdata('msg', 'Data Berhasil Di Simpan <br> Silahkan Menunggu Approval Dari Casemix <br> Terima Kasih!!...');
            // echo 'Gagal menyalin file';
            // echo json_encode($data);
            $this->load->view('LaporanMedis/LML/Confirm', $data);
    
        }

    }

    public function QrGenerate($IP_Registration_No, $File_No, $Dokter)
    {
        $data['judul'] = "Page Absensi";
        // $data['DetailTopik'] = $this->db->query("SELECT * FROM training WHERE id = '$id_topik'")->row();
        // $data['']
        $file_name=$IP_Registration_No."_".$File_No.".png";
        $tempdir="\\\\10.10.110.116\\doc_Patient\\LM\\LML\\QR\\";
        $file_path = $tempdir.$file_name;
        $logo = "assets/foto/logo/logo_beth.png";
        $forecolor = "0,0,0";
        $backcolor = "255,255,255";
        $url = "https://extranet.bethsaidahospitals.com/DevPatient/UploadMedis/LML/UploadQR/".$IP_Registration_No."/"."$File_No"."/".$Dokter;
        // $url = "https://extranet.bethsaidahospitals.com/DevHelp/";
        
        QRcode::png($url, $file_path, "H", 6, 4, 0, $forecolor, $backcolor, $logo);
        $data['File'] = $file_path;
        // $this->load->view('LaporanMedis/LML/View_Qr', $data);
        echo json_encode("Success");

    }

    
}
