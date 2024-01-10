  <!-- DataTables -->
  <link rel="stylesheet" href="<?=base_url()?>assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- DataTables  & Plugins -->
  <script src="<?=base_url()?>assets/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?=base_url()?>assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?=base_url()?>assets/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?=base_url()?>assets/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?=base_url()?>assets/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?=base_url()?>assets/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?=base_url()?>assets/adminlte/plugins/jszip/jszip.min.js"></script>
  <script src="<?=base_url()?>assets/adminlte/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="<?=base_url()?>assets/adminlte/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="<?=base_url()?>assets/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?=base_url()?>assets/adminlte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?=base_url()?>assets/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"><?=$judul?></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"><?=$judul?></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <label for="">Data Pasien</label>
          <form action="<?=base_url()?>Reports/LapPatientAno/export" method="post">
          <table>
            <tr>
              <td><input type="date" name="date_awal" id="date_awal" class="form-control" value="<?=date("Y-m-d", strtotime(date('Y-m-d'). ' - 5 days'))?>"></td>
              <td>-</td>
              <td><input type="date" name="date_akhir" id="date_akhir" class="form-control" value="<?=date("Y-m-d")?>"></td>
            </tr>
            <tr>
              <td colspan="2"><button class="btn btn-sm btn-success" id="btn_succes" type="button" onclick="getData()">Cek Data</button> <button class="btn btn-sm btn-warning" id="btn_excel" type="submit">Excel</button></td>
            </tr>
          </table>
          </form>
        </div>
     <style>
      td {
          white-space: nowrap;
      }
      div.dataTables_wrapper div.dataTables_processing {
        top: 0;
      }
     </style>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-condensed table-sm" id="data_patient">
              <thead>
                <tr >
                  <th nowrap>IP Registrasi</th>
                  <th nowrap>Nomor MR</th>
                  <th nowrap>Nama Pasien</th>
                  <th nowrap>Kamar</th>
                  <th nowrap>Nama Payer</th>
                  <th nowrap>Tanggal Registrasi</th>
                  <th nowrap>Status Data</th>
                  <th nowrap>Tanggal Perintah Pulang</th>
                  <th nowrap>No EKTM</th>
                  <th nowrap>Tanggal ke PDS</th>
                  <th nowrap>User Ke PDS</th>
                  <th nowrap>Tanggal Terima PDS</th>
                  <th nowrap>User Terima PDS</th>
                  <th nowrap>Tanggal Terakhir Pesan Resep</th>
                  <th nowrap>User Pesan Resep</th>
                  <th nowrap>Tanggal Terakhir Konfirmasi Resep</th>
                  <th nowrap>User Konfirmasi Resep</th>
                  <th nowrap>Tanggal Terakhir Retur Resep</th>
                  <th nowrap>User Retur Resep</th>
                  <th nowrap>Tanggal Konfirmasi Retur Resep</th>
                  <th nowrap>User Konfirmasi Retur Resep</th>
                  <th nowrap>Tanggal Discharge</th>
                  <th nowrap>User Discharge</th>
                  <th nowrap>Tanggal Kirim Jaminan</th>
                  <th nowrap>User Kirim Jaminan</th>
                  <th nowrap>Tanggal Terima Jaminan</th>
                  <th nowrap>User Terima Jaminan</th>
                  <th nowrap>Keterangan Terima Jaminan</th>
                  <th nowrap>Tanggal Invoice</th>
                  <th nowrap>User Invoice</th>
                  <th nowrap>Tanggal Meninggalkan Ruangan</th>
                  <th nowrap>User Meninggalkan Ruangan</th>
				          <th nowrap>SLA Perintah Pulang Ke Discharge</th>
                  <th nowrap>Perintah Pulang Ke Discharge</th>
				          <th nowrap>SLA Discharge Ke Terima Jaminan</th>
                  <th nowrap>Discharge Ke Terima Jaminan</th>
                  <th nowrap>Selisih Perintah Pulang Ke E-KTM</th>

                </tr>
              </thead>
            </table>
          </div>
        </div>
        <div class="card-footer"></div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->



<!-- Modal -->
<div class="modal fade" id="RinciModal" tabindex="-1" aria-labelledby="RinciModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="RinciModalLabel">Data Rinci Patient</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="table-responsive">
        <table class="table table-sm table-bordered">
          <tr>
            <td>IP Registrasi</td>
            <td>:</td>
            <td id="IP_Registration_No"></td>
          </tr>
          <tr>
            <td>Nomor MR</td>     
            <td>:</td>
            <td id="MR_No"></td>
          </tr>
          <tr>
            <td>Nama Pasien</td>
            <td>:</td>
            <td id="Patient_Name"></td>
          </tr>
          <tr>
            <td>Nama Payer</td>
            <td>:</td>
            <td id="Company_Name"></td>
          </tr>
          <tr>
            <td>Tanggal Registrasi</td>
            <td>:</td>
            <td id="Date_Registration"></td>
          </tr>
          <tr>
            <td>Status Data</td>
            <td>:</td>
            <td id="Status_Data"></td>
          </tr>
          <tr>
            <td>Tanggal Perintah Pulang</td>
            <td>:</td>
            <td id="Date_Perintah_Pulang"></td>
          </tr>
          <tr>
            <td>No. EKTM</td>
            <td>:</td>
            <td id="No_EKTM"></td>
          </tr>
          <tr>
            <td>Tanggal Ke PDS</td>
            <td>:</td>
            <td id="Last_Order_EKTM_Obat"></td>
          </tr>
          <tr>
            <td>User Ke PDS</td>
            <td>:</td>
            <td id="UserKePDS"></td>
          </tr>
          <tr>
            <td>Tanggal Terima PDS</td>
            <td>:</td>
            <td id="Last_Terima_EKTM_Obat"></td>
          </tr>
          <tr>
            <td>User Terima PDS</td>
            <td>:</td>
            <td id="UserTerimaPDS"></td>
          </tr>
          <tr>
            <td>Tanggal Pesan Terakhir Resep</td>
            <td>:</td>
            <td id="Date_Last_Order_Presc"></td>
          </tr>
          <tr>
            <td>User Pesan Resep</td>
            <td>:</td>
            <td id="User_Last_Order_Presc"></td>
          </tr>
          <tr>
            <td>Tanggal Terakhir Konfirmasi Resep</td>
            <td>:</td>
            <td id="Date_Last_Confrm_Presc"></td>
          </tr>
          <tr>
            <td>User Konfirmasi Resep</td>
            <td>:</td>
            <td id="User_Last_Confrm_Presc"></td>
          </tr>
          <tr>
            <td>Tanggal Terakhir Pengembalian Resep</td>
            <td>:</td>
            <td id="Date_Last_Retur_Presc"></td>
          </tr>
          <tr>
            <td>User Pengembalian Resep</td>
            <td>:</td>
            <td id="User_Last_Retur_Presc"></td>
          </tr>
          <tr>
            <td>Tanggal Konfirmasi Pengembalian Resep</td>
            <td>:</td>
            <td id="Date_Confrm_Retur_Presc"></td>
          </tr>
          <tr>
            <td>User Konfirmasi Pengembalian Resep</td>
            <td>:</td>
            <td id="User_Confrm_Retur_Presc"></td>
          </tr>
          <tr>
            <td>Tanggal Discharge</td>
            <td>:</td>
            <td id="Date_Discharge"></td>
          </tr>
          <tr>
            <td>User Discharge</td>
            <td>:</td>
            <td id="User_Discharge"></td>
          </tr>
          <tr>
            <td>Tanggal Kirim Jaminan</td>
            <td>:</td>
            <td id="Date_Kirim_Jaminan"></td>
          </tr>
          <tr>
            <td>User Kirim Jaminan</td>
            <td>:</td>
            <td id="User_Kirim_Jaminan"></td>
          </tr>
          <tr>
            <td>Tanggal Terima Jaminan</td>
            <td>:</td>
            <td id="Date_Terima_Jaminan"></td>
          </tr>
          <tr>
            <td>User Terima Jaminan</td>
            <td>:</td>
            <td id="User_Terima_Jaminan"></td>
          </tr>
          <tr>
            <td>Keterangan Terima Jaminan</td>
            <td>:</td>
            <td id="Keterangan_Terima_Jaminan"></td>
          </tr>
          <tr>
            <td>Tanggal Invoice</td>
            <td>:</td>
            <td id="Date_Invoice"></td>
          </tr>
          <tr>
            <td>User Invoice</td>
            <td>:</td>
            <td id="User_Invoice"></td>
          </tr>
          <tr>
            <td>Tanggal Meninggalkan Ruangan</td>
            <td>:</td>
            <td id="Date_Leave_Room"></td>
          </tr>
          <tr>
            <td>User Meninggalkan Ruangan</td>
            <td>:</td>
            <td id="User_Leave_Room"></td>
          </tr>
          <tr>
            <td>SLA Perintah Pulang Ke Discharge</td>
            <td>:</td>
            <td>120 Menit</td>
          </tr>
          <tr>
            <td>Perintah Pulang Ke Discharge</td>
            <td>:</td>
            <td id="SLA_PerintahPulang"></td>
          </tr>
          <tr>
            <td>SLA Discharge Ke Terima Jaminan</td>
            <td>:</td>
            <td>60 Menit</td>
          </tr>
          <tr>
            <td>Discharge Ke Terima Jaminan</td>
            <td>:</td>
            <td id="SLA_Discharge"></td>
          </tr>
        </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
// function SetReload() {
//   setTimeout(getData, 30000)
// }
  
function getData() {
  // SetReload()

	$(document).ready(function() {
		
		date_awal = document.getElementById("date_awal").value;
		date_akhir = document.getElementById("date_akhir").value;
    
		// karyawan = document.getElementById("karyawan").value;
        $("#data_patient").DataTable({
        "ajax" : {
          'url'	: "<?=base_url()?>Reports/LapPatientAno/data_detail/",
          'type'	: 'POST',
          'dataType' : 'JSON',
          'beforeSend' : function (data) {
            // document.getElementById('btn_succes').disabled = true;
            // document.getElementById('btn_succes').innerHTML = 'Cek Data <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';
          },
          'data'	: { date_awal:date_awal, date_akhir:date_akhir }
          
        },
            "processing": true,
            "serverSide": true,
            "destroy": true,
            "paging": false,
            "autoWidth": false,
            "lengthChange": true,
            "searching": false,
            "lengthMenu": [10, 25, 50, 100, 250, 500, 1000],
            "columns": [
                        {
                        "data" : "IP_Registration_No",
                          render: function (data, type, row, meta) {
                            // return meta.row + meta.settings._iDisplayStart + 1;
                            return row.IP_Registration_No;
                          }
                        },
                        {"data": "MR_No"},
                        { "data" : 'Patient_Name',
                         render : function (data, type, row, meta) {
                          var tool = '<a href="#" data-toggle="tooltip" data-placement="right" title="Detail Pasien" onclick="getRinci(`'+row.IP_Registration_No+'`)">'+row.Patient_Name+'</button>';
                          return tool;
                         }
                        },
                        {"data": "Ward"},
                        {"data": "Company_Name"},
                        {"data": "Date_Registration"},
                        {"data":"Status_Data"},
                        {"data":"Date_Perintah_Pulang"},
                        {"data":"No_EKTM"},
                        {"data":"Last_Order_EKTM_Obat",
                          render : function (data, type, row, meta) {
                            if (row.Last_Order_EKTM_Obat == "" || row.Last_Order_EKTM_Obat == "1901-01-01 00:00:00") {
                              return "";
                            }else{
                              return row.Last_Order_EKTM_Obat;
                            }
                          }
                        },
                        {"data":"UserKePDS"},
                        {"data":"Last_Terima_EKTM_Obat",
                          render : function (data, type, row, meta) {
                            if (row.Last_Terima_EKTM_Obat == "" || row.Last_Terima_EKTM_Obat == "1901-01-01 00:00:00") {
                              return "";
                            }else{
                              return row.Last_Terima_EKTM_Obat;
                            }
                          }},
                        {"data":"UserTerimaPDS"},
                        {"data":"Date_Last_Order_Presc",
                          render : function (data, type, row, meta) {
                            if (row.Date_Last_Order_Presc == "" || row.Date_Last_Order_Presc == "1901-01-01 00:00:00") {
                              return "";
                            }else{
                              return row.Date_Last_Order_Presc;
                            }
                          }},
                        {"data":"User_Last_Order_Presc"},
                        {"data":"Date_Last_Confrm_Presc",
                          render : function (data, type, row, meta) {
                            if (row.Date_Last_Confrm_Presc == "" || row.Date_Last_Confrm_Presc == "1901-01-01 00:00:00") {
                              return "";
                            }else{
                              return row.Date_Last_Confrm_Presc;
                            }
                          }},
                        {"data":"User_Last_Confrm_Presc"},
                        {"data":"Date_Last_Retur_Presc",
                          render : function (data, type, row, meta) {
                            if (row.Date_Last_Retur_Presc == "" || row.Date_Last_Retur_Presc == "1901-01-01 00:00:00") {
                              return "";
                            }else{
                              return row.Date_Last_Retur_Presc;
                            }
                          }},
                        {"data":"User_Last_Retur_Presc"},
                        {"data":"Date_Confrm_Retur_Presc",
                          render : function (data, type, row, meta) {
                            if (row.Date_Confrm_Retur_Presc == "" || row.Date_Confrm_Retur_Presc == "1901-01-01 00:00:00") {
                              return "";
                            }else{
                              return row.Date_Confrm_Retur_Presc;
                            }
                          }},
                        {"data":"User_Confrm_Retur_Presc"},
                        {"data":"Date_Discharge",
                          render : function (data, type, row, meta) {
                            if (row.Date_Discharge == "" || row.Date_Discharge == "1901-01-01 00:00:00") {
                              return "";
                            }else{
                              return row.Date_Discharge;
                            }
                          }},
                        {"data":"User_Discharge"},
                        {"data":"Date_Kirim_Jaminan",
                          render : function (data, type, row, meta) {
                            if (row.Date_Kirim_Jaminan == "" || row.Date_Kirim_Jaminan == "1901-01-01 00:00:00") {
                              return "";
                            }else{
                              return row.Date_Kirim_Jaminan;
                            }
                          }},
                        {"data":"User_Kirim_Jaminan"},
                        {"data":"Date_Terima_Jaminan",
                          render : function (data, type, row, meta) {
                            if (row.Date_Terima_Jaminan == "" || row.Date_Terima_Jaminan == "1901-01-01 00:00:00") {
                              return "";
                            }else{
                              return row.Date_Terima_Jaminan;
                            }
                          }},
                        {"data":"User_Terima_Jaminan"},
                        {"data":"Keterangan_Terima_Jaminan"},
                        {"data":"Date_Invoice",
                          render : function (data, type, row, meta) {
                            if (row.Date_Invoice == "" || row.Date_Invoice == "1901-01-01 00:00:00") {
                              return "";
                            }else{
                              return row.Date_Invoice;
                            }
                          }},
                        {"data":"User_Invoice"},
                        {"data":"Date_Leave_Room",
                          render : function (data, type, row, meta) {
                            if (row.Date_Leave_Room == "" || row.Date_Leave_Room == "1901-01-01 00:00:00") {
                              return "";
                            }else{
                              return row.Date_Leave_Room;
                            }
                          }},
                        {"data":"User_Leave_Room"},
                        {"data":"Perintah_Pulang_To_Discharge",
						  render : function (data, type,row, meta){
							  return "120 Menit";
						  }
						},
                        {"data":"Perintah_Pulang_To_Discharge",
                          render : function (data, type, row, meta) {
                              
                              if (row.Perintah_Pulang_To_Discharge < 0) {
                                var hasil = ""
                              } else {
                                const hours = Math.floor(row.Perintah_Pulang_To_Discharge / 60);
                                const minutes = row.Perintah_Pulang_To_Discharge % 60;
                                var hasil = Math.round(hours) + " Jam " + Math.round(minutes) + " Minutes";
                                
                              }

                              return hasil;
                          }
                        },
						{"data":"Discharge_To_Terima_Jaminan",
						  render : function (data, type,row, meta){
							  return "60 Menit";
						  }
						},
                        {"data":"Discharge_To_Terima_Jaminan",
                          render : function (data, type, row, meta) {
                              if (row.Discharge_To_Terima_Jaminan < 0) {
                                var hasil = ''
                              } else {
                                const hours = Math.floor(row.Discharge_To_Terima_Jaminan / 60);
                                const minutes = row.Discharge_To_Terima_Jaminan % 60;
                                
                                var hasil = Math.round(hours) + " Jam " + Math.round(minutes) + " Minutes";
                                
                              }
                              
                              return hasil;


                          }},
                          {"data":"PerintahPulang_To_EKTM",
                          render : function (data, type, row, meta) {
                              if (row.PerintahPulang_To_EKTM < 0) {
                                var hasil = "";
                              }else{
                                const hours = Math.floor(row.PerintahPulang_To_EKTM / 60);
                                const minutes = row.PerintahPulang_To_EKTM % 60;
                                var hasil = Math.round(hours) + " Jam " + Math.round(minutes) + " Minutes";
                              }
                              return hasil;
                          }}
                      ],
            "columnDefs": [{
                    orderable: false,
                    targets: []
                }],
            "order": [],
            "rowCallback": function(row, data, index) {
                              if (data.Perintah_Pulang_To_Discharge >= 120) {
                                $('td:eq(33)', row).css('background-color', '#fa8a7f');
                              } else if (data.Perintah_Pulang_To_Discharge <= 120) {
                                $('td:eq(33)', row).css('background-color', '#b7f7e0');
                              }
                              if (data.Discharge_To_Terima_Jaminan >= 60) {
                                $('td:eq(35)', row).css('background-color', '#fa8a7f');
                              } else if (data.Discharge_To_Terima_Jaminan <= 60) {
                                $('td:eq(35)', row).css('background-color', '#b7f7e0');
                              }
            
            },
            "initComplete":function( settings, json){
              document.getElementById('btn_succes').innerHTML = 'Cek Data';
              document.getElementById('btn_succes').disabled = false;
            }
    	});
	});
}

function getRinci(IP_Registration_No) {
  $.ajax({
    url : "<?=base_url()?>Reports/LapPatientAno/DataDetailPasien",
    type : "POST",
    dataType : "JSON",
    data : {IP_Registration_No:IP_Registration_No},
    success : function (data) {
      document.getElementById('IP_Registration_No').innerHTML = data.IP_Registration_No
      document.getElementById('MR_No').innerHTML = data.MR_No
      document.getElementById('Patient_Name').innerHTML = data.Patient_Name
      document.getElementById('Company_Name').innerHTML = data.Company_Name
      document.getElementById('Date_Registration').innerHTML = data.Date_Registration
      document.getElementById('Status_Data').innerHTML = data.Status_Data
      document.getElementById('Date_Perintah_Pulang').innerHTML = data.Date_Perintah_Pulang
      document.getElementById('No_EKTM').innerHTML = data.No_EKTM
      document.getElementById('Last_Order_EKTM_Obat').innerHTML = data.Last_Order_EKTM_Obat
      document.getElementById('UserKePDS').innerHTML = data.UserKePDS
      document.getElementById('Last_Terima_EKTM_Obat').innerHTML = data.Last_Terima_EKTM_Obat
      document.getElementById('UserTerimaPDS').innerHTML = data.UserTerimaPDS
      document.getElementById('Date_Last_Order_Presc').innerHTML = data.Date_Last_Order_Presc
      document.getElementById('User_Last_Order_Presc').innerHTML = data.User_Last_Order_Presc
      document.getElementById('Date_Last_Confrm_Presc').innerHTML = data.Date_Last_Confrm_Presc
      document.getElementById('User_Last_Confrm_Presc').innerHTML = data.User_Last_Confrm_Presc
      document.getElementById('Date_Last_Retur_Presc').innerHTML = data.Date_Last_Retur_Presc
      document.getElementById('User_Last_Retur_Presc').innerHTML = data.User_Last_Retur_Presc
      document.getElementById('Date_Confrm_Retur_Presc').innerHTML = data.Date_Confrm_Retur_Presc
      document.getElementById('User_Confrm_Retur_Presc').innerHTML = data.User_Confrm_Retur_Presc
      document.getElementById('Date_Discharge').innerHTML = data.Date_Discharge
      document.getElementById('User_Discharge').innerHTML = data.User_Discharge
      document.getElementById('Date_Kirim_Jaminan').innerHTML = data.Date_Kirim_Jaminan
      document.getElementById('User_Kirim_Jaminan').innerHTML = data.User_Kirim_Jaminan
      document.getElementById('Date_Terima_Jaminan').innerHTML = data.Date_Terima_Jaminan
      document.getElementById('User_Terima_Jaminan').innerHTML = data.User_Terima_Jaminan
      document.getElementById('Keterangan_Terima_Jaminan').innerHTML = data.Keterangan_Terima_Jaminan
      document.getElementById('Date_Invoice').innerHTML = data.Date_Invoice
      document.getElementById('User_Invoice').innerHTML = data.User_Invoice
      document.getElementById('Date_Leave_Room').innerHTML = data.Date_Leave_Room
      document.getElementById('User_Leave_Room').innerHTML = data.User_Leave_Room
      
      const hours = Math.floor(data.Perintah_Pulang_To_Discharge / 60);
      const minutes = data.Perintah_Pulang_To_Discharge % 60;
      document.getElementById("SLA_PerintahPulang").innerHTML = Math.round(hours) + " Jam " + Math.round(minutes) + " Minutes";
      

      const hours2 = Math.floor(data.Discharge_To_Terima_Jaminan / 60);
      const minutes2 = data.Discharge_To_Terima_Jaminan % 60;
      document.getElementById("SLA_Discharge").innerHTML = Math.round(hours2) + " Jam " + Math.round(minutes2) + " Minutes";


    }
  })
  $("#RinciModal").modal("show");
}
function downloadCSV(csv, filename) {
    var csvFile;
    var downloadLink;
 
    // CSV file
    csvFile = new Blob([csv], {type: "text/csv"});
 
    // Download link
    downloadLink = document.createElement("a");
 
    // File name
    downloadLink.download = filename;
 
    // Create a link to the file
    downloadLink.href = window.URL.createObjectURL(csvFile);
 
    // Hide download link
    downloadLink.style.display = "none";
 
    // Add the link to DOM
    document.body.appendChild(downloadLink);
 
    // Click download link
    downloadLink.click();
}
 
function exportTableToCSV(filename) {
    var csv = [];
	var rows = document.querySelectorAll("table tr");
	
    for (var i = 0; i < rows.length; i++) {
		var row = [], cols = rows[i].querySelectorAll("td, th");
		
        for (var j = 0; j < cols.length; j++) 
            row.push(cols[j].innerText);
        
		csv.push(row.join(","));		
	}
 
    // Download CSV file
    downloadCSV(csv.join("\n"), filename);
}
</script>