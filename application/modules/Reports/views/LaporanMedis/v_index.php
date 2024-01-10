  <!-- page specific plugin styles -->
  <link href="<?=base_url()?>assets/tabulator-master/dist/css/tabulator.min.css" rel="stylesheet">
	<link href="<?=base_url()?>assets/tabulator-master/dist/css/tabulator_bootstrap3.min.css" rel="stylesheet">

  <script type="text/javascript" src="<?=base_url()?>assets/tabulator-master/dist/js/tabulator.min.js"></script>
  <script type="text/javascript" src="<?=base_url()?>assets/tabulator-master/dist/js/xlsx.full.min.js"></script>
	<!-- <script type="text/javascript" src="<?=base_url()?>assets/tabulator-master/dist/js/jquery_wrapper.js"></script> -->
  <script src="<?=base_url()?>assets/pdfjs/build/pdf.js"></script>
  
  <!-- OPTIONAL SCRIPTS -->
  <!-- <script src="<?=base_url()?>assets/adminlte/plugins/chart.js/Chart.min.js"></script> -->
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>

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
            <li class="breadcrumb-item active"><?=$judul?> </li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <style>
    .tabulator-row {
      margin-bottom: 0 !important;
    }
    .lma-column {
      background-color: #cdfaf8; /* Warna latar belakang yang diinginkan */
      /* Gaya lainnya seperti warna teks, font, dll. */
    }
    .lmlpds-column {
      background-color: #dbf5d0; /* Warna latar belakang yang diinginkan */
      /* Gaya lainnya seperti warna teks, font, dll. */
    }
    .lmlkasir-column {
      background-color: #f5f3d0; /* Warna latar belakang yang diinginkan */
      /* Gaya lainnya seperti warna teks, font, dll. */
    }
         
  </style>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header text-xs">
          <div class="row">
                <div class="col-sm-2">
                  <div class="form-group">
                    <label for="">Dari</label>
                    <input type="date" name="date_awal" id="date_awal" class="form-control" value="">
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="form-group">
                    <label for="">Sampai</label>
                    <input type="date" name="date_akhir" id="date_akhir" class="form-control" value="">
                  </div>
                </div>
                <div class="col-sm-2">
                  <label for=""></label>
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="LMA_Check" value="LMA" checked>
                    <label for="LMA_Check" class="custom-control-label">LMA</label>
                  </div>
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="LMLKasir_Check" value="LMLKasir">
                    <label for="LMLKasir_Check" class="custom-control-label">LML Kasir</label>
                  </div>
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="LMLPDS_Check" value="LMLPDS">
                    <label for="LMLPDS_Check" class="custom-control-label">LML PDS</label>
                  </div>
                </div>
                <div class="col-sm-2">
                  <label for="">&nbsp;</label> <br>
                  <!-- <button onclick="ToExcel()" class="btn btn-sm btn-success">Download XLSX</button> -->
                  <button class="btn btn-sm btn-success" onclick="GetNewData()">Cek Data</button>
                  <!-- <button class="btn btn-sm btn-success" onclick="GetNewData()">Cek Data</button> -->
                </div>
                <div class="col-sm-2">
                  <label for="">&nbsp;</label> <br>
                  
                </div>
          </div>
         
        </div>

        <div class="card-body" style="padding-top: 0px;">
         
          <!-- Table sla -->
          <!-- <div id="TblPatient" class="text-xs table-sm table-bordered" style="padding-bottom: 10px !Important; font-size: 10px !important;"></table> -->

          <div class="table-responsive" hidden>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <td rowspan="2" style="vertical-align: middle; white-space: pre;">Nama Pasien <br> Penjamin</td>
                  <td rowspan="2" style="vertical-align: middle; white-space: pre;" >Nomor Registrasi</td>
                  <td rowspan="2" style="vertical-align: middle; white-space: pre;">Tanggal Registrasi</td>
                  <td class="LMA" colspan="4" style="text-align: center;">Laporan Medis Awal</td>
                  <td class="LML1" colspan="4" style="text-align: center;">Laporan Medis Lanjutan (1)</td>
                  <td class="LML2" rowspan="2" style="vertical-align: middle; white-space: pre;">Discharge</td>
                  <td class="LML2" colspan="4" style="text-align: center;">Laporan Medis Lanjutan (2)</td>
                </tr>
                <tr>
                  <td class="LMA" style="white-space: pre;">PDS Konfirmasi</td>
                  <td class="LMA" style="white-space: pre;">GP Konfirmasi</td>
                  <td class="LMA" style="white-space: pre;">CA Konfirmasi</td>
                  <td class="LMA" style="white-space: pre;">PDS Terima</td>
                  <!-- LML 1 -->
                  <td class="LML1" style="white-space: pre;">PDS Konfirmasi</td>
                  <td class="LML1" style="white-space: pre;">GP Konfirmasi</td>
                  <td class="LML1" style="white-space: pre;">CA Konfirmasi</td>
                  <td class="LML1" style="white-space: pre;">PDS Terima</td>
                  <!-- LML 2 -->
                  <td class="LML2" style="white-space: pre;">Kasir Konfirmasi</td>
                  <td class="LML2" style="white-space: pre;">GP Konfirmasi</td>
                  <td class="LML2" style="white-space: pre;">CA Konfirmasi</td>
                  <td class="LML2" style="white-space: pre;">Kasir Terima</td>
                  
                </tr>
              </thead>
              

            </table>
          </div>

          <div class="table-responsive" id="TblPatient"></div>
        </div>
       
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->



<script>

var TblPatientData = new Tabulator("#TblPatient", {
  ajaxURL:"<?=base_url()?>Reports/Medis/data_detail/", //ajax URL
  ajaxConfig: "POST", // Set the HTTP method to POST
  // progressiveLoad:"load", //sequentially load all data into the table
  layout:"fitDataFill",
  filterMode:"remote",
  sortMode:"remote",
  selectable:false,
  pagination:"true",
  maxHeight:"100%",
  paginationMode:"remote",
  paginationSize:10,
  paginationSizeSelector:[10, 20, 30, 50, 100],
  movableColumns:false,
  // paginationCounter:"rows",
  dataReceiveParams:{
    "last_page":"max_pages", //change last_page parameter name to "max_pages"
  } ,
  columns:[
   
    {title:"Nama Pasien <br> Penjamin", field:"Patient_Name", cssClass: "custom-padding",
    formatter: function(cell, formatterParams, onRendered) {
      var value = cell.getRow().getData();
      if (value.Company_Name == null || value.Company_Name == "") {
        var Payer = ""
      }else{
        var Payer = value.Company_Name
      }
      return value.Patient_Name + "<br> <b>" + Payer + "</b>"
    } },
    {title:"Nomor Registrasi", field:"No_Regis", cssClass: "custom-padding", headerFilter:"input" },
    {title:"Tanggal Registrasi", field:"DateRegis", hozAlign:"center"},
    {
      title: "<center>Laporan Medis Awal</center>", field:"LMA", columns:[
        {title:"PDS Created", field:"TimePDS_LMA", hozAlign:"center"},
        {title:"GP Konfirmasi", field:"TimeConfirmGP_LMA", hozAlign:"center"},
        {title:"CA Konfirmasi", field:"TimeConfirmCaseMix_LMA", hozAlign:"center"},
        {title:"PDS Konfirmasi", field:"TimeConfirmPDS_LMA", hozAlign:"center"},
        {title:"Durasi", field:"Durasi", hozAlign:"center", 
          formatter: function(cell, formatterParams, onRendered) {
            var value = cell.getRow().getData();
            // Buat dua objek Date
            var startDate = new Date(value.TimePDS_LMA);
            var endDate = new Date(value.TimeConfirmPDS_LMA); // Menggunakan waktu saat ini sebagai endDate

            // Hitung perbedaan waktu antara endDate dan startDate
            var timeDifference = endDate - startDate;

            // Konversi perbedaan waktu menjadi durasi dalam milidetik, detik, menit, dan jam
            var milliseconds = timeDifference;
            var seconds = Math.floor(milliseconds / 1000);
            var minutes = Math.floor(seconds / 60);
            var hours = Math.floor(minutes / 60);

            if (value.TimePDS_LMA == '' || value.TimePDS_LMA == null || value.TimeConfirmPDS_LMA == '' || value.TimeConfirmPDS_LMA == null) {
              
            } else {
              return `${hours} h ${(minutes % 60)} m`;
            }

            // // Tampilkan hasil
            // console.log('Durasi:', hours, 'jam', minutes % 60, 'menit', seconds % 60, 'detik');

          }
        },
      ],
    },
    // {
    //   title: "<center>Laporan Medis Lanjutan (PDS)</center>", field:"LMLPDS", columns:[
    //     {title:"PDS Upload", field:"DateUploadPDS", hozAlign:"center"},
    //     {title:"GP Konfirmasi", field:"DateDocReceivePDS", hozAlign:"center"},
    //     {title:"CA Konfirmasi", field:"TimeCA_ApprovePDS", hozAlign:"center"},
    //     {title:"PDS Terima", field:"DateReceivePDS", hozAlign:"center"},
    //   ],
    // },
    // {title:"Discharge", field:"DischargeDate", hozAlign:"center"},
    // {
    //   title:"<center>Laporan Medis Lanjutan (Kasir)</center>", field:"LMLPDS", columns:[
    //     {title:"Kasir Upload", field:"DateUploadKasir", hozAlign:"center"},
    //     {title:"GP Konfirmasi", field:"DateDocReceiveKasir", hozAlign:"center"},
    //     {title:"CA Konfirmasi", field:"DateCA_ApproveKasir", hozAlign:"center"},
    //     {title:"Kasir Terima", field:"DateReceiveKasir", hozAlign:"center"},
    //   ],
    // },
    
    // {title:"Timeline" , sortable:false, field:"No_Regis", width:100,
    // 	formatter:function(cell, formatterParams, onRendered){
    // 		var value = cell.getRow().getData();
    //     // var btn = `<button type="button" class="btn btn-xs btn-success" onclick=GetUpload('`+value.IP_Registration_No+`')><i class="fa fa-upload"></i></button>`
    //     var btn = `<button type="button" class="btn btn-xs btn-success" onclick=GetDetail('`+value.No_Regis.trim()+`')><i class="fas fa-user-clock"></i> History</button>`
    //     return btn;
    // 	},
    // },
    // {title:"Inisial Dokumen", field:"Initial_Document", width:130, hozAlign:"center"},
  ],
  
});

// GetNewData();
function GetNewData() {
    fromDate = document.getElementById('date_awal').value;
    toDate = document.getElementById('date_akhir').value;
    var LMA = {
      title: "<center>Laporan Medis Awal</center>", field:"LMA", columns:[
        {title:"PDS Created", field:"TimePDS_LMA", hozAlign:"center"},
        {title:"GP Konfirmasi", field:"TimeConfirmGP_LMA", hozAlign:"center"},
        {title:"CA Konfirmasi", field:"TimeConfirmCaseMix_LMA", hozAlign:"center"},
        {title:"PDS Konfirmasi", field:"TimeConfirmPDS_LMA", hozAlign:"center"},
        {title:"Durasi", field:"Durasi", hozAlign:"center", 
          formatter: function(cell, formatterParams, onRendered) {
            var value = cell.getRow().getData();
            // Buat dua objek Date
            var startDate = new Date(value.TimePDS_LMA);
            var endDate = new Date(value.TimeConfirmPDS_LMA); // Menggunakan waktu saat ini sebagai endDate

            // Hitung perbedaan waktu antara endDate dan startDate
            var timeDifference = endDate - startDate;

            // Konversi perbedaan waktu menjadi durasi dalam milidetik, detik, menit, dan jam
            var milliseconds = timeDifference;
            var seconds = Math.floor(milliseconds / 1000);
            var minutes = Math.floor(seconds / 60);
            var hours = Math.floor(minutes / 60);

            if (value.TimePDS_LMA == '' || value.TimePDS_LMA == null || value.TimeConfirmPDS_LMA == '' || value.TimeConfirmPDS_LMA == null) {
              
            } else {
              return `${hours} h ${(minutes % 60)} m`;
            }

            // // Tampilkan hasil
            // console.log('Durasi:', hours, 'jam', minutes % 60, 'menit', seconds % 60, 'detik');

          }
        },
      ],
    };
    var LMLPDS = {
      title: "<center>Laporan Medis Lanjutan (PDS)</center>", field:"LMLPDS", columns:[
        {title:"PDS Upload", field:"DateUploadPDS", hozAlign:"center"},
        {title:"GP Konfirmasi", field:"DateDocReceivePDS", hozAlign:"center"},
        {title:"CA Konfirmasi", field:"TimeCA_ApprovePDS", hozAlign:"center"},
        {title:"PDS Terima", field:"DateReceivePDS", hozAlign:"center"},
      ],
    };

    var LMLKASIR = {
      title:"<center>Laporan Medis Lanjutan (Kasir)</center>", field:"LMLKASIR", columns:[
        {title:"Kasir Upload", field:"DateUploadKasir", hozAlign:"center"},
        {title:"GP Konfirmasi", field:"DateDocReceiveKasir", hozAlign:"center"},
        {title:"CA Konfirmasi", field:"DateCA_ApproveKasir", hozAlign:"center"},
        {title:"Kasir Terima", field:"DateReceiveKasir", hozAlign:"center"},
      ],
    };

    var LMLKASIRDISC = {title:"Discharge", field:"DischargeDate", hozAlign:"center"}

  var LMA_Check = document.getElementById('LMA_Check').checked;
  var LMLKasir_Check = document.getElementById('LMLKasir_Check').checked;
  var LMLPDS_Check = document.getElementById('LMLPDS_Check').checked;

  if (LMA_Check == true) {
    TblPatientData.deleteColumn('TimePDS_LMA','LMA');
    TblPatientData.deleteColumn('TimeConfirmGP_LMA','LMA');
    TblPatientData.deleteColumn('TimeConfirmCaseMix_LMA','LMA');
    TblPatientData.deleteColumn('TimeConfirmPDS_LMA','LMA');
    TblPatientData.deleteColumn('Durasi','LMA');
    TblPatientData.addColumn(LMA);
  }else{
    TblPatientData.deleteColumn('TimePDS_LMA','LMA');
    TblPatientData.deleteColumn('TimeConfirmGP_LMA','LMA');
    TblPatientData.deleteColumn('TimeConfirmCaseMix_LMA','LMA');
    TblPatientData.deleteColumn('TimeConfirmPDS_LMA','LMA');
    TblPatientData.deleteColumn('Durasi','LMA');
  }

  if (LMLPDS_Check == true) {
    TblPatientData.deleteColumn('DateUploadPDS','LMLPDS');
    TblPatientData.deleteColumn('DateDocReceivePDS','LMLPDS');
    TblPatientData.deleteColumn('TimeCA_ApprovePDS','LMLPDS');
    TblPatientData.deleteColumn('DateReceivePDS','LMLPDS');
    TblPatientData.addColumn(LMLPDS);
  }else{
    TblPatientData.deleteColumn('DateUploadPDS','LMLPDS');
    TblPatientData.deleteColumn('DateDocReceivePDS','LMLPDS');
    TblPatientData.deleteColumn('TimeCA_ApprovePDS','LMLPDS');
    TblPatientData.deleteColumn('DateReceivePDS','LMLPDS');
  }

  if (LMLKasir_Check == true) {
    TblPatientData.deleteColumn('DischargeDate');
    TblPatientData.deleteColumn('DateUploadKasir','LMLKASIR');
    TblPatientData.deleteColumn('DateDocReceiveKasir','LMLKASIR');
    TblPatientData.deleteColumn('DateCA_ApproveKasir','LMLKASIR');
    TblPatientData.deleteColumn('DateReceiveKasir','LMLKASIR');
    TblPatientData.addColumn(LMLKASIRDISC);
    TblPatientData.addColumn(LMLKASIR);
  }else{
    TblPatientData.deleteColumn('DischargeDate');
    TblPatientData.deleteColumn('DateUploadKasir','LMLKASIR');
    TblPatientData.deleteColumn('DateDocReceiveKasir','LMLKASIR');
    TblPatientData.deleteColumn('DateCA_ApproveKasir','LMLKASIR');
    TblPatientData.deleteColumn('DateReceiveKasir','LMLKASIR');
  }
  
  TblPatientData.setFilter([
    { field: 'date', type: '>=', value: fromDate },
    { field: 'date', type: '<=', value: toDate }
  ]);
  
}
</script>