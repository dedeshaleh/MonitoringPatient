  <!-- page specific plugin styles -->
  <link href="<?=base_url()?>assets/tabulator-master/dist/css/tabulator.min.css" rel="stylesheet">
	<link href="<?=base_url()?>assets/tabulator-master/dist/css/tabulator_bootstrap3.min.css" rel="stylesheet">

  <script type="text/javascript" src="<?=base_url()?>assets/tabulator-master/dist/js/tabulator.min.js"></script>
  <script type="text/javascript" src="<?=base_url()?>assets/tabulator-master/dist/js/xlsx.full.min.js"></script>
	<!-- <script type="text/javascript" src="<?=base_url()?>assets/tabulator-master/dist/js/jquery_wrapper.js"></script> -->
  <script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>
  
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
  </style>
  
  <style>
    .tabulator-row {
      margin-bottom: 0 !important;
    }
              #timeline-wrap{
                margin:5%;
                top:100;
                position:relative;
              
              }

              #timeline{
                height:1px;
                width: 100%;
                background-color:#aabbc4;
                position:relative;
              
              }

              .marker{
                z-index:1000;
                color: #fff;
                width: 50px;
                height: 50px;
                line-height: 50px;
                font-size: 1.4em;
                text-align: center;
                position: absolute;
                margin-left: -25px;
                background-color: #999999;
                border-radius: 50%;
                      }

              .marker:hover{
                -moz-transform: scale(1.2);
              -webkit-transform: scale(1.2);
              -o-transform: scale(1.2);
              -ms-transform: scale(1.2);
              transform: scale(1.2);
                
                -webkit-transition: all 300ms ease;
              -moz-transition: all 300ms ease;
              -ms-transition: all 300ms ease;
              -o-transition: all 300ms ease;
              transition: all 300ms ease;
              }
              .timeline-icon.ma1 {
                  background-color: #3e4f88;
               }

               .m1 {
                  top:-25px;
              }
              .timeline-icon.ma2 {
                  background-color: #3e4f88;
               }

               .m2 {
                  top:-25px;
                  left: 36%;
              }
              .timeline-icon.ma3 {
                  background-color: #3e4f88;
               }

               .m3 {
                  top:-25px;
                  left: 69%;
              }
              .timeline-icon.ma4 {
                  background-color: #3e4f88;
               }

               .m4 {
                  top:-25px;
                  left: 100%;
              }
              

              .timeline-panel {
                margin-top: 20%;
                width: 500px;
                height: 200px;
                background-color: #cbd0df;
                border-radius:2px;
                position:relative;
                text-align:left;
                padding:10px;
                font-size:20px;
                font-weight:bold;
                line-height:20px;
                float:left;
              }

              .timeline-panel:after {
                content:'';
                position:absolute;
                margin-top: -12%;
                left:10%;
                width:0;
                height:0;
                border:12px solid transparent;
                border-bottom: 15px solid #cbd0df;
              }
              .ActiveTimeline {
                background-color: #fa8a7f !important;
              }
              .DeactiveTimeline {
                background-color: #999999 !important;
              }
              /* #the-canvas {
                border: 1px solid black;
                direction: ltr;
              } */
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
                    <input class="custom-control-input" type="checkbox" id="LMA_Check" value="LMA">
                    <label for="LMA_Check" class="custom-control-label">LMA</label>
                  </div>
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="LML_Check" value="LML">
                    <label for="LML_Check" class="custom-control-label">LML</label>
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

          <div class="table-responsive">
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


        </div>
        <!-- <div class="card-footer">
          <div class="form-group">
            <label for="">Note :</label><br>
            SLA Perintah Pulang Ke Discharge : 120 Menit <br>
            SLA Discharge Ke Konfirmasi Jaminan : 60 Menit
          </div>
        </div>
      </div> -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->



<script>

</script>