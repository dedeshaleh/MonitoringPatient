
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
  
  <!-- OPTIONAL SCRIPTS -->
  <script src="<?=base_url()?>assets/adminlte/plugins/chart.js/Chart.min.js"></script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Bed Management System</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Bed Management System </li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
         <div class="row">
          <div class="col-sm-3 col-3">
            <div class="card text-sm">
              <div class="card-body">
                <div class="table-responsive">
                  <label for="">Data Kamar</label>
                  <table class="table table-bordered table-hover"> 
                    <thead>
                      <tr style="background-color: #bcf3f7;">
                        <td>Nama Ruangan</td>
                        <td>Tersedia</td>
                        <td>Terpakai</td>
                        <td>Total</td>
                      </tr>
                    </thead>
                    <tbody id="Data1"></tbody>
                    <tbody id="Data2"></tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="small-box bg-info">
              <div class="inner">
                <center>
                <h3 id="PersenKamar"></h3>

                </center>

                <center>
                <p>Tingkat Kepenuhan Kamar</p>

                <table>
                  <tr>
                    <td style="text-align: right;">Terpakai</td>
                    <td style="text-align: left;">Total Kamar</td>
                  </tr>
                  <tr>
                    <td style="text-align: right;" id="Terpakai"></td>
                    <td style="text-align: left;" id="Kamar">Total Kamar</td>
                  </tr>
                </table>
                </center>
                
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">&nbsp;</i></a>
            </div>
          </div>
          <div class="col-sm-6 col-6">
            <div class="card">
                <div class="card-header border-0">
                  <div class="d-flex justify-content-between">
                    <h3 class="card-title">Data Pasien</h3>
                  </div>
                </div>
                <div class="card-body">
                  <div class="d-flex">
                  
                    <p class="ml-auto d-flex flex-column text-right">
                      
                    </p>
                  </div>
                  <!-- /.d-flex -->

                  <div class="position-relative mb-4">
                    <canvas id="sales-chart" height="500"></canvas>
                  </div>
                </div>
            </div>
          </div>
          <div class="col-sm-3 com-3">
            <div class="card" style="height: 100px;">
              <div class="card-body">
                <div class="table-responsive">
                  <table>
                    <tr>
                      <td style="font-weight: bold;">Tanggal</td>
                      <td>&nbsp;</td>
                      <td style="font-weight: bold;" id="date"></td>
                    </tr>
                    <tr>
                      <td style="font-weight: bold;">Waktu</td>
                      <td>&nbsp;</td>
                      <td style="font-weight: bold;" id="waktu"></td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header">
                <label for="">Keterangan Warna Pada Chart</label>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table>
                    <tr>
                      <td style="background-color: #7bfc5b; width: 100px;">&nbsp;</td>
                      <td>Total Kamar Tersedia</td>
                    </tr>
                    <tr>
                      <td style="background-color: #f54c6e;">&nbsp;</td>
                      <td>Total Kamar Terpakai</td>
                    </tr>
                    <tr>
                      <td style="background-color: #007bff;">&nbsp;</td>
                      <td>Total Kamar</td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <div class="table-responsive">
                  <img src="<?=base_url()?>assets/img/Logo-Bethsaida-Hospitals.png" alt="" style="width: 100%;">
                </div>
              </div>
            </div>
          </div>
        </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->



<!-- Modal -->
<div class="modal fade" id="RinciModal" tabindex="-1" aria-labelledby="RinciModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title" id="RinciModalLabel">Data Rinci Ruangan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label for="">Nama Ruangan : <span id="NamaRuangan"></span></label>
        <table class="table table-borderless table-sm">
                      <tr>
                        <td style="background-color: #6bff72;">VACANT</td>
                        <td>:</td>
                        <td>Bed ready (siap digunakan)</td>
                      </tr>
                      <tr>
                        <td style="background-color: #f77e7c;">OCCUPI</td>
                        <td>:</td>
                        <td>Bed terisi (sedang digunakan)</td>
                      </tr>
                      <tr>
                        <td style="background-color: #638af7;">LEAVE</td>
                        <td>:</td>
                        <td>Bed segera dikosongkan</td>
                      </tr>
                      <tr>
                        <td style="background-color: #63f2f7;">VACATE</td>
                        <td>:</td>
                        <td>Bed sedang dibersihkan</td>
                      </tr>
                    </table>
        <br>
        <table class="table table-sm table-bordered table-hover">
            <thead class="sticky-top">
              <tr style="background-color: #bcf3f7;">
                <td>No</td>
                <td>Ruangan</td>
                <td>Kelas</td>
                <td>Status</td>
              </tr>
            </thead>
            <tbody id="DetailKamar"></tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>

  window.setTimeout("waktu()", 1000);
 
	function waktu() {
		setTimeout("waktu()", 1000);

    var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

    var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];

    var date = new Date(new Date().toLocaleString('en', {timeZone: 'Asia/Jakarta'}));

    var day = date.getDate();

    var month = date.getMonth();

    var thisDay = date.getDay(),thisDay = myDays[thisDay];

    var hours = date.getHours();
    var minutes = date.getMinutes();
    var seconds = date.getSeconds();

    minutes = (minutes < 10 ? '0' : '') + minutes;
    seconds = (seconds < 10 ? '0' : '') + seconds;

		document.getElementById("date").innerHTML = thisDay + ', ' + day + ' '+ months[month] + ' ' + date.getFullYear();
		document.getElementById("waktu").innerHTML = hours + ' : ' + minutes + ' : ' + seconds;
	}


  $("body").removeClass("sidebar-expanded").addClass("sidebar-collapse");
  CekKamar()

  function CekKamar() {
      const url = "<?=base_url()?>Bed/CekKamar";
      fetch(url, {
        method: "POST",
        // body: JSON.stringify(rowObject),
				headers: {
						"Content-Type": "application/json; charset=UTF-8"
					}	
      })
      .then((response) => response.json())
      .then((data) => {
        var html = ``;
        for (let i = 0; i < data.Kamar.length; i++) {
            html+= `
                  <tr>
                    <td>`+data.Kamar[i].Description+`</td>
                    <td><a href="#" onclick="GetDetailKamar('`+data.Kamar[i].Ward_Code+`')">`+(data.Kamar[i].Bed - data.Kamar[i].Terpakai)+`</a></td>
                    <td>`+data.Kamar[i].Terpakai+`</td>
                    <td>`+data.Kamar[i].Bed+`</td>
                  </tr>
                  `;
        }
        
        document.getElementById('Data1').innerHTML = html;
        document.getElementById("PersenKamar").innerHTML = ((data.TotalTerpakai.TotalTerpakai / data.totalKamar.TotalKamar) * 100).toFixed(2) + ' %'  
        document.getElementById("Terpakai").innerHTML = data.TotalTerpakai.TotalTerpakai      
        document.getElementById("Kamar").innerHTML = data.totalKamar.TotalKamar
      })

  }

  function GetDetailKamar(Ward_Code) {
    const url = "<?=base_url()?>Bed/CekDetail";
    console.log(Ward_Code)
    const data = {
      Ward_Code: Ward_Code
    }
    fetch(url, {
      method: "POST",
      body: JSON.stringify(data),
      headers: {
						"Content-Type": "application/json; charset=UTF-8"
					}	
    })
    .then((response) => response.json())
    .then((data) => {
      $("#RinciModal").modal('show');
      document.getElementById('NamaRuangan').innerHTML = data[0].Description
      var html = '';

      for (let i = 0; i < data.length; i++) {
        html+= `
        <tr>
          <td>`+(1+i)+`</td>
          <td>`+data[i].Room+`</td>
          <td>`+data[i].Class+`</td>
          <td style='vertical-align: middle; background-color: `;
            if (data[i].Status == 'OCCUPI') {
              html+= `#f77e7c`
            }else if (data[i].Status == 'VACATE'){
              html+= `#63f2f7`
            }else if (data[i].Status == 'VACANT'){
              html+= `#6bff72`
            }else if (data[i].Status == 'LEAVE'){
              html+= `#638af7`
            }else if (data[i].Status == 'TOBEVACATE'){
              html+= `#edf763`
            }
          html+=`'>`+data[i].Status+`</td>
        </tr>
        `
        
      }

      document.getElementById('DetailKamar').innerHTML = html;

    
    })
  }
</script>


<script>
  /* global Chart:false */
CekChart()
  function CekChart() {
    const url = '<?=base_url()?>Bed/CekKamarChart';

    fetch(url, {
      method: "POST",
      // body: JSON.stringify(data),
      headers: {
        "Content-Type": "application/json; charset=UTF-8"
        }	
    })
    .then((response) => response.json())
    .then((data) => {

      'use strict'

      var ticksStyle = {
        fontColor: '#495057',
        fontStyle: 'bold'
      }

      var mode = 'index'
      var intersect = true
      
      var $salesChart = $('#sales-chart')
      // eslint-disable-next-line no-unused-vars
      var salesChart = new Chart($salesChart, {
        type: 'bar',
        data: {
          labels: data.Kamar,
          datasets: [
            {
              backgroundColor: '#7bfc5b',
              borderColor: '#007bff',
              data: data.TotalPemakaian.Tersedia
            },
            {
              backgroundColor: '#f54c6e',
              borderColor: '#007bff',
              data: data.TotalPemakaian.Terpakai
            },
            {
              backgroundColor: '#007bff',
              borderColor: '#007bff',
              data: data.TotalPemakaian.Total
            }
          ]
        },
        options: {
          maintainAspectRatio: false,
          tooltips: {
            mode: mode,
            intersect: intersect
          },
          hover: {
            mode: mode,
            intersect: intersect
          },
          legend: {
            display: false
          },
          scales: {
            yAxes: [{
              // display: false,
              gridLines: {
                display: true,
                lineWidth: '4px',
                color: 'rgba(0, 0, 0, .2)',
                zeroLineColor: 'transparent'
              },
              ticks: $.extend({
                beginAtZero: true,

              }, ticksStyle)
            }],
            xAxes: [{
              display: true,
              gridLines: {
                display: false
              },
              ticks: ticksStyle
            }]
          }
        }
      })

    })
  }
  

// lgtm [js/unused-local-variable]
</script>