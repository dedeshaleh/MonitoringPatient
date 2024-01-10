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
          <h1 class="m-0">Beth Management System</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Beth Management System </li>
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
          <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="">Dari</label>
                    <input type="date" name="date_awal" id="date_awal" class="form-control" value="<?=date("Y-m-d", strtotime(date('Y-m-d'). ' - 5 days'))?>">
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="">Sampai</label>
                    <input type="date" name="date_akhir" id="date_akhir" class="form-control" value="<?=date("Y-m-d")?>">
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="">Cari Nama Pasien</label>
                    <input type="text" name="data_search" id="data_search" class="form-control">
                  </div>
                </div>
          </div>
          <button class="btn btn-sm btn-success" onclick="getData()">Cek Data</button>
        </div>
      <style>
      /* td {
          white-space: nowrap;
      } */
      div.dataTables_wrapper div.dataTables_processing {
        top: 0;
      }
     </style>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-condensed table-sm text-xs" id="data_patient" style="font-size: vw;"> 
              <thead>
                <tr>
                  <th rowspan="2" style="width: 10px; text-align: center; vertical-align: middle;">No</th>
                  <th rowspan="2" style="max-width: 150px; text-align: center; vertical-align: middle;">Nama Pasien</th>
                  <th colspan="3" style="text-align: center; vertical-align: middle;">Proses Pasien</th>
                  <th rowspan="2" style="text-align: center; vertical-align: middle;">MR No</th>
                  <th rowspan="2" style="text-align: center; vertical-align: middle;">Nama Payer</th>
                  
                </tr>
                <tr>
                  <th style="min-width: 90px; text-align: center; vertical-align: middle;">Perintah Pulang</th>
                  <th style="min-width: 90px; text-align: center; vertical-align: middle;">Discharge</th>
                  <th style="min-width: 90px; text-align: center; vertical-align: middle;">Konfirmasi Jaminan</th>
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
        <span id="data_karyawan"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
  getData();
function SetReload() {
  setTimeout(getData, 60000)
}
  
function getData() {
  SetReload()

	$(document).ready(function() {
		
		date_awal = document.getElementById("date_awal").value;
		date_akhir = document.getElementById("date_akhir").value;
		data_search = document.getElementById("data_search").value;
		// karyawan = document.getElementById("karyawan").value;
        $("#data_patient").DataTable({
        "ajax" : {
          'url'	: "<?=base_url()?>Dashboard/data_detail/",
          'type'	: 'POST',
          'dataType' : 'JSON',
          'data'	: { date_awal:date_awal, date_akhir:date_akhir, data_search:data_search }
        },
            "processing": true,
            "serverSide": true,
            "destroy": true,
            "paging": false,
            "autoWidth": false,
            "lengthChange": false,
            "searching": false,
            "stateSave": true,
      			"pageLength": 1000,
            "lengthMenu": [10, 25, 50, 100, 250, 500, 1000],
            "columns": [
                        {
                        "data" : "IP_Registration_No",
                          render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                          }
                        },
                        { "data" : 'Patient_Name',
                         render : function (data, type, row, meta) {
                          var tool = '<a href="#" data-toggle="tooltip" data-placement="right" title="Kamar 204 Nazareth" onclick="getRinci(`'+row.Patient_Name+'`)">'+row.Patient_Name+'</button>';
                          return tool;
                         }
                        },
                        { "data" : 'Date_Perintah_Pulang',
                        render : function (data, type, row, meta) {
                          // if ( ((row.Date_Perintah_Pulang != "") && (row.Date_Perintah_Pulang != "1901-01-01 00:00:00")) && ((row.Date_Terima_PDS != "") && (row.Date_Terima_PDS != "1901-01-01 00:00:00"))) {
                          //     var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
                          //     var firstDate = new Date(row.Date_Perintah_Pulang);
                          //     var secondDate = new Date(row.Date_Terima_PDS);
                          //     // var diffDays = Math.round((((firstDate.getTime() - secondDate.getTime())/1000)/60));
                          //     return row.Date_Perintah_Pulang;
                          // }else{
                          //     var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
                          //     var firstDate = new Date(row.Date_Perintah_Pulang);
                          //     var secondDate = new Date();
                          //     var diffDays = Math.round((((secondDate.getTime() - firstDate.getTime())/1000)/60));
                          //     const hours = Math.floor(diffDays / 60);
                          //     const minutes = diffDays % 60;
                          //     return Math.round(hours) + " Jam " + Math.round(minutes) + " Minutes";
                          // }
                              return row.Date_Perintah_Pulang;
                          
                        } },
                        { "data" : 'Date_Discharge',
                        render : function (data, type, row, meta) {
                          if ( ((row.Date_Discharge != "") && (row.Date_Discharge != "1901-01-01 00:00:00"))) {
                              // var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
                              // var firstDate = new Date(row.Date_Terima_PDS);
                              // var secondDate = new Date(row.Date_Discharge);
                              // console.log(secondDate)
                              // var diffDays = Math.round((((firstDate.getTime() - secondDate.getTime())/1000)/60));
                              return row.Date_Discharge;
                          }else{
                            if (((row.Date_Perintah_Pulang == "") || (row.Date_Perintah_Pulang == "1901-01-01 00:00:00"))) {
                              return '';
                            }else{
                              var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
                              var firstDate = new Date(row.Date_Perintah_Pulang);
                              var secondDate = new Date();
                              var diffDays = Math.round((((secondDate.getTime() - firstDate.getTime())/1000)/60));
                              const hours = Math.floor(diffDays / 60);
                              const minutes = diffDays % 60;
                              return Math.round(hours) + " Jam " + Math.round(minutes) + " Minutes";
                            }
                              
                          }
                          
                        } },
                        { "data" : 'Date_Terima_Jaminan',
                        render : function (data, type, row, meta) {
                          if (((row.Date_Terima_Jaminan != "") && (row.Date_Terima_Jaminan != "1901-01-01 00:00:00"))) {
                              // var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
                              // var firstDate = new Date(row.Date_Terima_PDS);
                              // var secondDate = new Date(row.Date_Discharge);
                              // console.log(secondDate)
                              // var diffDays = Math.round((((firstDate.getTime() - secondDate.getTime())/1000)/60));
                              return row.Date_Terima_Jaminan;
                          }else{
                            if (((row.Date_Discharge == "") || (row.Date_Discharge == "1901-01-01 00:00:00"))) {
                              return '';
                            }else{
                              var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
                              var firstDate = new Date(row.Date_Discharge);
                              var secondDate = new Date();
                              var diffDays = Math.round((((secondDate.getTime() - firstDate.getTime())/1000)/60));
                              const hours = Math.floor(diffDays / 60);
                              const minutes = diffDays % 60;
                              return Math.round(hours) + " Jam " + Math.round(minutes) + " Minutes";
                            }
                              
                          }
                        } },
                        { "data" : 'MR'},
                        { "data" : 'Company_Name'}
                        
                      ],
            "columnDefs": [{
                orderable: false,
                targets: []
            }
          ],
            "order": [[4,"ASC"], [3,"ASC"]],
            "rowCallback": function(row, data, index) {
                          if ( ((data.Date_Discharge != "") && (data.Date_Discharge != "1901-01-01 00:00:00"))) {
                          }else{
                            if (((data.Date_Discharge != "") && (data.Date_Discharge != "1901-01-01 00:00:00"))) {
                            }else{
                              var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
                              var firstDate = new Date(data.Date_Perintah_Pulang);
                              var secondDate = new Date();
                              var diffDays = Math.round((((secondDate.getTime() - firstDate.getTime())/1000)/60));
                              const hours = Math.floor(diffDays / 60);
                              const minutes = diffDays % 60;

                              if (diffDays >= 120) {
                                $('td:eq(3)', row).css('background-color', '#fa8a7f');
                              } else if (diffDays <= 120) {
                                $('td:eq(3)', row).css('background-color', '#b7f7e0');
                              }
                            }
                              
                          }
                          if (((data.Date_Terima_Jaminan != "") && (data.Date_Terima_Jaminan != "1901-01-01 00:00:00"))) {
                              // var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
                              // var firstDate = new Date(data.Date_Terima_PDS);
                              // var secondDate = new Date(data.Date_Discharge);
                              // console.log(secondDate)
                              // var diffDays = Math.round((((firstDate.getTime() - secondDate.getTime())/1000)/60));
                              return data.Date_Terima_Jaminan;
                          }else{
                            if (((data.Date_Discharge == "") || (data.Date_Discharge == "1901-01-01 00:00:00"))) {
                              return '';
                            }else{
                              var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
                              var firstDate = new Date(data.Date_Discharge);
                              var secondDate = new Date();
                              var diffDays = Math.round((((secondDate.getTime() - firstDate.getTime())/1000)/60));
                              const hours = Math.floor(diffDays / 60);
                              const minutes = diffDays % 60;
                              if (diffDays >= 60) {
                                $('td:eq(4)', row).css('background-color', '#fa8a7f');
                              } else if (diffDays <= 60) {
                                $('td:eq(4)', row).css('background-color', '#b7f7e0');
                              }
                            }
                              
                          }
                          
              
            
            },
    	});
	});
}

function getRinci(Patient_Name) {
  $("#RinciModal").modal("show");
  document.getElementById('data_karyawan').innerHTML = Patient_Name;
}
</script>