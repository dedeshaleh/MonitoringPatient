  <!-- page specific plugin styles -->
  <link href="<?=base_url()?>assets/tabulator-master/dist/css/tabulator.min.css" rel="stylesheet">
	<link href="<?=base_url()?>assets/tabulator-master/dist/css/tabulator_bootstrap3.min.css" rel="stylesheet">

  <script type="text/javascript" src="<?=base_url()?>assets/tabulator-master/dist/js/tabulator.min.js"></script>
  <script type="text/javascript" src="<?=base_url()?>assets/tabulator-master/dist/js/xlsx.full.min.js"></script>
	<!-- <script type="text/javascript" src="<?=base_url()?>assets/tabulator-master/dist/js/jquery_wrapper.js"></script> -->
  
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
          <h1 class="m-0">Perencanaan Pemulangan Pasien</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Perencanaan Pemulangan Pasien </li>
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
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header text-xs">
          <div class="row">
                <div class="col-sm-2">
                  <div class="form-group">
                    <label for="">Dari</label>
                    <input type="date" name="date_awal" id="date_awal" class="form-control" value="<?=date("Y-m-01")?>">
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="form-group">
                    <label for="">Sampai</label>
                    <input type="date" name="date_akhir" id="date_akhir" class="form-control" value="<?=date("Y-m-d")?>">
                  </div>
                </div>
                <div class="col-sm-2">
                <div class="form-group">
                    <label for="">WARD</label>
                    <select name="ward" id="ward" class="form-control">
                      <option value="">-Pilih-</option>
                      <?php foreach ($Ward as $v) { ?>
                        <option value="<?=$v->Ward_Code?>"><?=$v->Description?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-sm-2">
                  <label for="">&nbsp;</label> <br>
                  <button onclick="ToExcel()" class="btn btn-sm btn-success">Download XLSX</button>
                  <button class="btn btn-sm btn-success" onclick="GetNewData()">Cek Data</button>
                  <!-- <button class="btn btn-sm btn-success" onclick="GetNewData()">Cek Data</button> -->
                </div>
                <div class="col-sm-2">
                  <label for="">&nbsp;</label> <br>
                  
                </div>
          </div>
         
        </div>

        <div class="card-body" style="padding-top: 0px;">
          <div class="form-group table-responsive " >
            <table class=" table-borderless table-condensed table-sm text-xs" >
              <tr>
                <td colspan="7">Catatan</td>
              </tr>
              <tr>
                <td><button class="btn btn-xs" style="background-color: #b7f7e0; width:20px" type="button" disabled>&nbsp;</button></td>
                <td>:</td>
                <td nowrap>Kondisi SLA Dalam Batas Aman</td>
                <td style="min-width: 30px"></td>
                <td><button class="btn btn-xs" style="background-color: #fa8a7f;width:20px" type="button" disabled>&nbsp;</button></td>
                <td>:</td>
                <td nowrap>Kondisi SLA Melebihi Batas Waktu</td>
                <td><button class="btn btn-success btn-xs" onclick="SetIntervalData()" id="HideBtn"><i class="fas fa-redo"></i></button><button class="btn btn-success btn-xs" onclick="GetNewData()()" id="showbtn" hidden><i class="fas fa-redo"></i></button></td>
                <td>Set Interval <span id="IntervalSet"></span> </td>
                <td><input type="number" name="SecReload" id="SecReload" placeholder="detik" style="width: 70px;"><button type="button" onclick="reloadPage()" id="btnReload" hidden class="btn btn-xs btn-warning">Hapus Interval</button></td>
              </tr>
            </table>
          </div>
          <script>
            function reloadPage() {
              location.reload();
            }
          </script>
          <!-- Table sla -->
          <div id="TblPatient" class="text-xs table-sm table-bordered" style="padding-bottom: 10px !Important; font-size: 10px !important;"></table>
        </div>
        <div class="card-footer">
          <div class="form-group">
            <label for="">Note :</label><br>
            SLA Perintah Pulang Ke Discharge : 120 Menit <br>
            SLA Discharge Ke Konfirmasi Jaminan : 60 Menit
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header">
          <label for="">Data Grafik Pencapaian SLA</label>
          <div class="row"> 
            <div class="row-3">
              <label for="">Bulan</label>
              <select name="Bulan" id="Bulan" class="form-control">
                <option value="">Bulan</option>
                <?php
                    $bln = date('n')-1;

                    $bulan=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                    $jlh_bln=count($bulan);
                    for($c=0; $c<$jlh_bln; $c+=1){
                        if ($c == $bln) {
                          echo"<option value='$c' selected> $bulan[$c] </option>";
                        }else{
                          echo"<option value='$c'> $bulan[$c] </option>";
                        }
                    }
                    ?>
              </select>
            </div>
            <div class="row-3">
              <label for="">Tahun</label>
              <select name="Tahun" id="Tahun" class="form-control">
              <?php
                $now=date('Y');
                for ($a=2012;$a<=$now;$a++)
                {
                    if ($a == $now) {
                      echo "<option value='$a' selected>$a</option>";
                    }else{
                      echo "<option value='$a'>$a</option>";
                    }
                    
                }
                ?>
              </select>
            </div>
            <div class="row-3"></div>
            <div class="row-3"></div>
          </div>
          <br>
          <button class="btn btn-success btn-sm" onclick="GetChart()" >  <div id="LoadingChart"></div></button> 
          

        </div>
        <div class="card-body">
         
        </div>
        <div class="card-footer"></div>
      </div>
          <div class="card">
            <div class="card-header">
              <label for="">Data Grafik SLA Pasien</label>
            </div>
            <div class="card-body">
              <canvas id="ChartPasien" ></canvas>
            </div>
          </div>
          <div class="card">
          <div class="card-header">
              <label for="">Data Grafik Total SLA Pasien</label>
            </div>
            <div class="card-body">
              <canvas id="ChartPasien2" style="font-size: 12px !Important;"></canvas>
            </div>
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
        <div id="Preload"></div>
        <table class="table table-sm table-bordered">
            <tr>
              <td>IP Registratisi</td>
              <td>:</td>
              <td id="IP_Registration_No"></td>
            </tr>
            <tr>
              <td>Nomor MR </td>
              <td>:</td>
              <td id="MR"></td>
            </tr>
            <tr>
              <td>Nama Pasien</td>
              <td>:</td>
              <td id="Patient_Name"></td>
            </tr>
            <tr>
              <td>Tanggal Perintah Pulang</td>
              <td>:</td>
              <td id="Date_Perintah_Pulang"></td>
            </tr>
            <tr>
              <td>Tanggal Discharge</td>
              <td>:</td>
              <td id="Date_Discharge"></td>
            </tr>
            <tr>
              <td>Tanggal Terima Jaminan</td>
              <td>:</td>
              <td id="Date_Terima_Jaminan"></td>
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
            <tbody id="Dokter"></tbody>
            <tr>
              <td>Lama Inap</td>
              <td>:</td>
              <td id="Lamainap"></td>
            </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
            function SetIntervalData() {
              GetNewData()

              var Second = document.getElementById('SecReload').value;
              if (Second == null || Second == "") {
                
              }else{
                var intervalId;
                intervalId = setInterval(function() {
                      GetNewData()
                    }, (Second*1000)); // Interval 1 detik
                document.getElementById('btnReload').hidden = false 
                document.getElementById('SecReload').hidden = true 
                document.getElementById('IntervalSet').innerHTML = " = " + Second
                document.getElementById('showbtn').hidden = false
                document.getElementById('HideBtn').hidden = true
              }
              
            }
            
          </script>
<script>
  document.getElementById('LoadingChart').innerHTML = "<i class='fas fa-search'></i> Cari";

                      var TblPatientData = new Tabulator("#TblPatient", {
												ajaxURL:"<?=base_url()?>Dashboard/data_detail/", //ajax URL
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
												paginationSizeSelector:[3, 6, 8, 10],
												movableColumns:false,
												// paginationCounter:"rows",
												dataReceiveParams:{
													"last_page":"max_pages", //change last_page parameter name to "max_pages"
												} ,
												columns:[
													// {title:"" , sortable:false, field:"Ward", width:90,
													// 	formatter:function(cell, formatterParams, onRendered){
													// 		var button1 = "<button type='button' class='btn btn-xs btn-warning' onclick='EditTindakan(`"+cell.getValue()+"`)'><i class='fa fa-pencil'></i></button>";
													// 		var button2 = "<button type='button' class='btn btn-xs btn-danger' onclick='DelTindakan(`"+cell.getValue()+"`)'><i class='fa fa-trash'></i></button>";
													// 		return button1 + ' || ' + button2;
													// 	},
													// },
													{title:"Patient Name", field:"Patient_Name", headerFilter:"input", cssClass: "custom-padding",
                            formatter:function(cell, formatterParams, onRendered){
                              var value = cell.getRow().getData();
                              var tool = '<button class="btn btn-xs btn-success" href="#" data-toggle="tooltip" data-placement="right" title="Kamar 204 Nazareth" onclick="getRinci(`'+value.IP_Registration_No+'`)">'+value.Patient_Name+'</button>';
                              return tool;
                            }
                          },
													{title:"Ward", field:"WARD", hozAlign:"center"},
													{title:"Perintah Pulang", field:"Date_Perintah_Pulang", width:130, hozAlign:"center"},
													{title:"Discharge", field:"Date_Discharge", formatter: colorFormatter, width:130, hozAlign:"center" },
													{title:"Konfirmasi Jaminan", field:"Date_Terima_Jaminan", formatter: colorFormatterJaminan, width:130, hozAlign:"center"},
													{title:"MR No", field:"MR", hozAlign:"center"},
													{title:"Nama Payer", field:"Company_Name", headerFilter:"input", cssClass: "custom-padding", width:200},
													
													
												],
                        
												
											});

                      // Formatter function
                      function colorFormatter(cell, formatterParams, onRendered) {
                        // var value = row.getValue();
                        var value = cell.getRow().getData();
                        if ( ((value.Date_Discharge != "") && (value.Date_Discharge != "1901-01-01 00:00:00"))) {
                              var hasil = FormatDate(value.Date_Discharge);
                          }else{
                            if (((value.Date_Perintah_Pulang == "") || (value.Date_Perintah_Pulang == "1901-01-01 00:00:00"))) {
                              var hasil = '';
                            }else{
                              var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
                              var firstDate = new Date(value.Date_Perintah_Pulang);
                              var secondDate = new Date();
                              var diffDays = Math.round((((secondDate.getTime() - firstDate.getTime())/1000)/60));
                              const hours = Math.floor(diffDays / 60);
                              const minutes = diffDays % 60;
                              if (diffDays >= 120) {
                                cell.getElement().style.backgroundColor = "#fa8a7f";
                                cell.getElement().style.color = "white";
                              } else if (diffDays <= 120) {
                                cell.getElement().style.backgroundColor = "#b7f7e0";
                                cell.getElement().style.color = "black";
                              }
                              var hasil = Math.round(hours) + " Jam " + Math.round(minutes) + " Minutes";
                            }
                          }
                        return hasil;
                      }
                      // Formatter function
                      function colorFormatterJaminan(cell, formatterParams, onRendered) {
                        // var value = row.getValue();
                        var value = cell.getRow().getData();
                        if ( ((value.Date_Terima_Jaminan != "") && (value.Date_Terima_Jaminan != "1901-01-01 00:00:00"))) {
                              var hasil = FormatDate(value.Date_Terima_Jaminan);
                          }else{
                            if (((value.Date_Discharge == "") || (value.Date_Discharge == "1901-01-01 00:00:00"))) {
                              var hasil = '';
                            }else{
                              var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
                              var firstDate = new Date(value.Date_Discharge);
                              var secondDate = new Date();
                              var diffDays = Math.round((((secondDate.getTime() - firstDate.getTime())/1000)/60));
                              const hours = Math.floor(diffDays / 60);
                              const minutes = diffDays % 60;
                              if (diffDays >= 120) {
                                cell.getElement().style.backgroundColor = "#fa8a7f";
                                cell.getElement().style.color = "white";
                              } else if (diffDays <= 120) {
                                cell.getElement().style.backgroundColor = "#b7f7e0";
                                cell.getElement().style.color = "black";
                              }
                              var hasil = Math.round(hours) + " Jam " + Math.round(minutes) + " Minutes";
                            }
                          }
                        return hasil;
                      }


GetNewData();
function GetNewData() {
    fromDate = document.getElementById('date_awal').value + ' 00:00:00';
    toDate = document.getElementById('date_akhir').value + ' 23:59:59';
    Ward = document.getElementById('ward').value;

  TblPatientData.setFilter([
    { field: 'date', type: '>=', value: fromDate },
    { field: 'date', type: '<=', value: toDate },
    { field: 'Ward', type: '=', value: Ward }
  ]);
  
}
function FormatDate(dateNew) {
  // Membuat objek Date baru
  var myDate = new Date(dateNew);

  // Mendapatkan nilai dari objek Date
  var year = myDate.getFullYear();    // Mendapatkan tahun
  var month = String(myDate.getMonth() + 1).padStart(2, '0');  // Mendapatkan bulan (dimulai dari 0)
  var day = String(myDate.getDate()).padStart(2, '0');         // Mendapatkan tanggal
  var hours = String(myDate.getHours()).padStart(2, '0');      // Mendapatkan jam
  var minutes = String(myDate.getMinutes()).padStart(2, '0');  // Mendapatkan menit
  var seconds = String(myDate.getSeconds()).padStart(2, '0');  // Mendapatkan detik
  
  return day + '-' + month + '-' + year + ' - ' + hours + ':' + minutes + ':' + seconds
}

function getRinci(IP_Registration_No) {
  $("#RinciModal").modal("show");
  $.ajax({
    url : "<?=base_url()?>Dashboard/DataDetailPasien",
    type : "POST",
    data : {IP_Registration_No:IP_Registration_No},
    dataType : "JSON",
    beforeSend : function (data) {
      document.getElementById('Preload').innerHTML = `<div class="d-flex justify-content-center">
                                                        <div class="spinner-border text-success" role="status">
                                                          <span class="sr-only">Loading...</span>
                                                        </div> Loading .... 
                                                      </div>`;
    },
    success : function (data) {
      document.getElementById('Preload').innerHTML = ''
      if ( ((data.Detail.Date_Discharge != "") && (data.Detail.Date_Discharge != "1901-01-01 00:00:00"))) {
        document.getElementById('Date_Discharge').innerHTML = data.Detail.Date_Discharge;
      }else{
        if (((data.Detail.Date_Perintah_Pulang == "") || (data.Detail.Date_Perintah_Pulang == "1901-01-01 00:00:00"))) {
          document.getElementById('Date_Discharge').innerHTML = '';
        }else{
          var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
          var firstDate = new Date(data.Detail.Date_Perintah_Pulang);
          var secondDate = new Date();
          var diffDays = Math.round((((secondDate.getTime() - firstDate.getTime())/1000)/60));
          const hours = Math.floor(diffDays / 60);
          const minutes = diffDays % 60;
          document.getElementById('Date_Discharge').innerHTML = Math.round(hours) + " Jam " + Math.round(minutes) + " Minutes";
        }
      }
      if (((data.Detail.Date_Terima_Jaminan != "") && (data.Detail.Date_Terima_Jaminan != "1901-01-01 00:00:00"))) {
        document.getElementById('Date_Terima_Jaminan').innerHTML = data.Detail.Date_Terima_Jaminan;
      }else{
        if (((data.Detail.Date_Discharge == "") || (data.Detail.Date_Discharge == "1901-01-01 00:00:00"))) {
          document.getElementById('Date_Terima_Jaminan').innerHTML = '';
        }else{
          var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
          var firstDate = new Date(data.Detail.Date_Discharge);
          var secondDate = new Date();
          var diffDays = Math.round((((secondDate.getTime() - firstDate.getTime())/1000)/60));
          const hours = Math.floor(diffDays / 60);
          const minutes = diffDays % 60;
          document.getElementById('Date_Terima_Jaminan').innerHTML = Math.round(hours) + " Jam " + Math.round(minutes) + " Minutes";
        }
      }
      document.getElementById('IP_Registration_No').innerHTML = data.Detail.IP_Registration_No;
      document.getElementById('MR').innerHTML = data.Detail.MR;
      document.getElementById('Date_Perintah_Pulang').innerHTML = data.Detail.Date_Perintah_Pulang;
      document.getElementById('Patient_Name').innerHTML = data.Detail.Patient_Name;
      document.getElementById('Company_Name').innerHTML = data.Detail.Company_Name;
      document.getElementById('Date_Registration').innerHTML = data.Detail.Date_Registration;

      var html = '';
      for (let i = 0; i < data.Dokter.length; i++) {
        html += 
        `
        <tr>
          <td>`+data.Dokter[i].DoctorType+`</td>
          <td>:</td>
          <td>`+data.Dokter[i].Doctor_Name+`</td>
        </tr>
        `;
        
      }
      document.getElementById("Dokter").innerHTML = html;
      // mengatur dua tanggal menjadi dua variabel
      var date1 = new Date(data.Detail.Date_Registration);

      if (data.Detail.Date_Checkout == "1901-01-01 00:00:00") {
        dateCheck = new Date().toDateString()
      }else{
        dateCheck = new Date(data.Detail.Date_Checkout).toDateString()
      }
      var date2 = new Date(new Date(dateCheck));
      
      // hitung perbedaan waktu dari dua tanggal
      var Difference_In_Time = date2.getTime() - date1.getTime();
      
      // hitung jml hari antara dua tanggal
      var Difference_In_Days = (Difference_In_Time / (1000 * 3600 * 24));
      
      // tampilkan jml akhir hari (hasil)
      // document.write("Jumlah total hari di antara tanggal  <br>"
      //             + date1 + "<br> dan <br>" 
      //             + date2 + " adalah: <br> " 
      //             + Difference_In_Days);
      WaktuInap = Difference_In_Days + 1;
      document.getElementById("Lamainap").innerHTML = WaktuInap.toFixed(1) + ' Days';
    }
  })
  
}

function ToExcel() {
	const url = "<?=base_url()?>Dashboard/ExportExcel";
	var ward = document.getElementById("ward").value;
	var date_awal = document.getElementById("date_awal").value;
	var date_akhir = document.getElementById("date_akhir").value;

	const rowObject = {
		ward : ward,
		date_awal : date_awal,
		date_akhir : date_akhir
	}
	fetch(url, {
		method: "POST",
		body: JSON.stringify(rowObject),
		headers: {
			"Content-Type": "application/json; charset=UTF-8"
		}
	})
	.then((response) => response.blob())
	.then(blob => {
    // Membuat URL objek Blob
    const url = URL.createObjectURL(blob);

    // Membuat elemen <a> untuk mengunduh file
    const link = document.createElement('a');
    link.href = url;
    link.download = 'Data PPP.xlsx';

    // Simulasi klik pada elemen <a> untuk mengunduh file
    link.click();

    // Membersihkan URL objek Blob
    URL.revokeObjectURL(url);
	})
	.catch(error => {
    console.error('Error:', error);
  });
}

  /* global Chart:false */

  function GetChart() {
   
      var Bulan = document.getElementById('Bulan').value;
      var Tahun = document.getElementById('Tahun').value;
      $.ajax({
        url : "<?=base_url()?>Dashboard/DataChart/",
        type: "POST",
        dataType : "JSON",
        data : { Bulan:Bulan, Tahun:Tahun },
        beforeSend : function (dataa) {
          const myChartHs = new Chart(
          document.getElementById('ChartPasien2'),
          {
            type: 'bar',
            data: [0],
            options: {
              borderRadius: 4,
              scales: {
                y: {
                  beginAtZero: true
                }
              }
            }
          }
          
        );
        const myChart = new Chart(
          document.getElementById('ChartPasien'),
          {
            type: 'bar',
            data: [0],
            options: {
              borderRadius: 4,
              scales: {
                y: {
                  beginAtZero: true
                }
              }
            }
          }
          
        );
        myChart.destroy()
        myChartHs.destroy()
          document.getElementById('LoadingChart').innerHTML = ' <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>Loading...'
        },
        success : function (dataa) {
          document.getElementById('LoadingChart').innerHTML = "<i class='fas fa-search'></i> Cari";
        
        // dataLabe = ['', data.SLA1, data.SLA2];
      
        const data = {
          labels: ['Data Pasien'],
          datasets: [{
            label: 'Total SLA Pasien',
            data: [dataa.SLA4],
            backgroundColor: 'rgba(0,0,2,0.2)',
            borderColor: 'rgba(0,0,0,2.2)',
            grouped: false,
            categoryPercentage: 0.60

          },
          {
            label: 'SLA Tidak Tercapai Perintah Pulang Ke Discharge',
            data: [dataa.SLA1],
            backgroundColor: '#e7ffa1' ,
            borderColor: '#e7ffa1',
            categoryPercentage: 0.5
          },
          {
            label: 'SLA Tidak Tercapai Discharge Ke Konfirmasi Jaminan',
            data: [dataa.SLA2],
            backgroundColor: '#77f3f7' ,
            borderColor: '#77f3f7',
            categoryPercentage: 0.5
          },
          {
            label: 'Total SLA Tercapai',
            data: [dataa.SLA3],
            backgroundColor: '#6ea8fa' ,
            borderColor: '#6ea8fa',
            categoryPercentage: 0.5
          }]
        };

        // config 
        const config = {
          type: 'bar',
          data,
          options: {
            borderRadius: 4,
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        };
        // render init block
        const myChart = new Chart(
          document.getElementById('ChartPasien'),
          config
        );

        const DataTotal = {
          labels: ['Data Pasien'],
          datasets: [{
            label: 'Total SLA Pasien',
            data: [dataa.SLA4],
            backgroundColor: 'rgba(0,0,0,0.2)',
            borderColor: 'rgba(0,0,0,0.2)',
            grouped: false,
            categoryPercentage: 0.60

          },
          {
            label: 'Total SLA Tidak Tercapai',
            data: [dataa.SLA5],
            backgroundColor: '#f542f2' ,
            borderColor: '#f542f2',
            categoryPercentage: 0.5
          },
          {
            label: 'Total SLA Tercapai',
            data: [dataa.SLA3],
            backgroundColor: '#7031f7' ,
            borderColor: '#7031f7',
            categoryPercentage: 0.5
          }]
        };

        // config 
        // render init block

        const myChartHs = new Chart(
          document.getElementById('ChartPasien2'),
          {
            type: 'bar',
            data: DataTotal,
            options: {
              borderRadius: 4,
              scales: {
                y: {
                  beginAtZero: true
                }
              }
            }
          }
          
        );

        }
      })
    }
</script>