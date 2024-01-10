  <!-- page specific plugin styles -->
  <link href="<?=base_url()?>assets/tabulator-master/dist/css/tabulator.min.css" rel="stylesheet">
	<link href="<?=base_url()?>assets/tabulator-master/dist/css/tabulator_bootstrap3.min.css" rel="stylesheet">

  <script type="text/javascript" src="<?=base_url()?>assets/tabulator-master/dist/js/tabulator.min.js"></script>
  <script type="text/javascript" src="<?=base_url()?>assets/tabulator-master/dist/js/xlsx.full.min.js"></script>
	<!-- <script type="text/javascript" src="<?=base_url()?>assets/tabulator-master/dist/js/jquery_wrapper.js"></script> -->
  
  <!-- OPTIONAL SCRIPTS -->
  <!-- <script src="<?=base_url()?>assets/adminlte/plugins/chart.js/Chart.min.js"></script> -->
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>

<script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>


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
                  left: 50%;
              }
              .timeline-icon.ma3 {
                  background-color: #3e4f88;
               }

               .m3 {
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
  </style>
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
         
          <script>
            function reloadPage() {
              location.reload();
            }
          </script>
          <!-- Table sla -->
          <div id="TblPatient" class="text-xs table-sm table-bordered" style="padding-bottom: 10px !Important; font-size: 10px !important;"></table>


        </div>
        <div class="card-footer">
        
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


<!-- Upload Modal -->
<form id="FormApproveLMA" onsubmit="ApproveLMA(event)" method="post" enctype="multipart/form-data">
<div class="modal fade" id="ModalApproveLMA" tabindex="-1" aria-labelledby="ModalApproveLMALabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalApproveLMALabel">Approve Dokumen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <!-- <canvas id="the-canvas"></canvas> -->
      <table>
        <tr>
          <td>Nama Pasien</td>
          <td style="width: 20px;">:</td>
          <td> <span id="NamaPatient_LMA"></span> <input type="hidden" name="No_Regis" id="Reg_No_LMA"></td>
        </tr>
      </table>
            <div>
              <button id="prev" type="button" class="btn btn-sm btn-success">Previous</button>
              <button id="next" type="button" class="btn btn-sm btn-success">Next</button>
              &nbsp; &nbsp;
              <span>Page: <span id="page_num"></span> / <span id="page_count"></span></span>
            </div>
            <div style="overflow: auto;" id="PreviewPDF">
              <canvas id="the-canvas"></canvas>
            </div>
            <br>
          <div class="form-group">
            <label for="">Pilih Status Konfirmasi</label>
            <select name="Position_Status" id="Position_Status" class="form-control" onchange="GetNote()">
              <option value="3">Approve LMA</option>
              <option value="4">Decline LMA With Note</option>
              <option value="5">Decline LMA</option>
            </select>
          </div>

          <div class="form-group" id="Note_Chasemix" hidden>
            <label for="">Note :</label>
            <textarea name="Note_Chasemix" id="Note_Chasemix_txt" cols="30" rows="10" class="form-control"></textarea>
          </div>
      </div>
     
      <div class="modal-footer">
        <button type="submit" class="btn btn-success btn-sm" >Submit</button>
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</form>


<div class="modal fade" id="ModalTimeline" tabindex="-1" aria-labelledby="ModalTimelineLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalTimelineLabel">Timeline Laporan Medis Awal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Timeline -->
        <div id="timeline-wrap">
            <div id="timeline"></div>

            <div class="marker m1 timeline-icon ma1 " id="line_lma_1">
                <i class="fas fa-user-nurse"></i>
            </div>
            
            
            <div class="marker m2 timeline-icon ma2 " id="line_lma_2">
              <i class="fas fa-user-md"></i>
            </div>

            <div class="marker m3 timeline-icon ma3 " id="line_lma_3">
                <i class="fas fa-user-tie"></i>
            </div>
          </div>
                <br>
                <br>
          <div id="GetTimeLine"></div>
      
      </div>
      <div class="image-preview"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<script>

                      var TblPatientData = new Tabulator("#TblPatient", {
												ajaxURL:"<?=base_url()?>LaporanMedis/LMA/data_detail/", //ajax URL
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
													{title:"" , sortable:false, field:"No_Regis", width:150,
														formatter:function(cell, formatterParams, onRendered){
															var value = cell.getRow().getData();
                              // var btn = `<button type="button" class="btn btn-xs btn-success" onclick=GetUpload('`+value.IP_Registration_No+`')><i class="fa fa-upload"></i></button>`
                              var btn1 = `<button type="button" class="btn btn-xs btn-success" onclick=FormApproveLMA('`+value.No_Regis.trim()+`')><i class="fas fa-check"></i> Approval</button>`
                              // var btn2 = `<button type="button" class="btn btn-xs btn-danger" onclick=FormApproveLMAToFix('`+value.No_Regis.trim()+`')><i class="fas fa-times"></i> Decline</button>`
                              return btn1;
														},
													},
													{title:"IP Registrasi", field:"No_Regis", headerFilter:"input", cssClass: "custom-padding" },
													{title:"Nama Pasien", field:"Patient_Name", headerFilter:"input", cssClass: "custom-padding" },
													{title:"Asuransi", field:"Company_Name", hozAlign:"center"},
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
    fromDate = document.getElementById('date_awal').value + ' 00:00:00';
    toDate = document.getElementById('date_akhir').value + ' 23:59:59';

  TblPatientData.setFilter([
    { field: 'date', type: '>=', value: fromDate },
    { field: 'date', type: '<=', value: toDate }
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

function FormApproveLMA(Ip_Registration_No, File_No) {

    $('#ModalApproveLMA').modal("show");
    const url = "<?=base_url()?>LaporanMedis/LMA/GetDetailDataPasien";

    const rowObject = {
    Ip_Registration_No : Ip_Registration_No,
    File_No : File_No
    }
    fetch(url, {
    method: "POST",
    body: JSON.stringify(rowObject),
    headers: {
      "Content-Type": "application/json; charset=UTF-8"
    }
    })
    .then((response) => response.json())
    .then((data) => {
      // DataPenerimaan.setData("<?=base_url()?>UploadMedis/LML/UploadData");
      var pdfData = atob(data.DataPDF);

      // Loaded via <script> tag, create shortcut to access PDF.js exports.
      var pdfjsLib = window['pdfjs-dist/build/pdf'];

      // The workerSrc property shall be specified.
      pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js';

      var pdfDoc = null,
          pageNum = 1,
          pageRendering = false,
          pageNumPending = null,
          scale = 1.5,
          canvas = document.getElementById('the-canvas'),
          ctx = canvas.getContext('2d');

      /**
       * Get page info from document, resize canvas accordingly, and render page.
       * @param num Page number.
       */
      function renderPage(num) {
        pageRendering = true;
        // Using promise to fetch the page
        pdfDoc.getPage(num).then(function(page) {
          var viewport = page.getViewport({scale: scale});
          canvas.height = viewport.height;
          canvas.width = viewport.width;

          // Render PDF page into canvas context
          var renderContext = {
            canvasContext: ctx,
            viewport: viewport
          };
          var renderTask = page.render(renderContext);

          // Wait for rendering to finish
          renderTask.promise.then(function() {
            pageRendering = false;
            if (pageNumPending !== null) {
              // New page rendering is pending
              renderPage(pageNumPending);
              pageNumPending = null;
            }
          });
        });

        // Update page counters
        document.getElementById('page_num').textContent = num;
      }

      /**
       * If another page rendering in progress, waits until the rendering is
       * finised. Otherwise, executes rendering immediately.
       */
      function queueRenderPage(num) {
        if (pageRendering) {
          pageNumPending = num;
        } else {
          renderPage(num);
        }
      }

      /**
       * Displays previous page.
       */
      function onPrevPage() {
        if (pageNum <= 1) {
          return;
        }
        pageNum--;
        queueRenderPage(pageNum);
      }
      document.getElementById('prev').addEventListener('click', onPrevPage);

      /**
       * Displays next page.
       */
      function onNextPage() {
        if (pageNum >= pdfDoc.numPages) {
          return;
        }
        pageNum++;
        queueRenderPage(pageNum);
      }
      document.getElementById('next').addEventListener('click', onNextPage);

      /**
       * Asynchronously downloads PDF.
       */
      pdfjsLib.getDocument({data: pdfData}).promise.then(function(pdfDoc_) {
        pdfDoc = pdfDoc_;
        document.getElementById('page_count').textContent = pdfDoc.numPages;

        // Initial/first page rendering
        renderPage(pageNum);
      });

    document.getElementById('Reg_No_LMA').value = data.DataLMA.No_Regis
    document.getElementById('NamaPatient_LMA').innerHTML = data.DataLMA.Patient_Name

    })
    .catch(error => {
    console.error('Error:', error);
    });
}



function ApproveLMA(event) {
  event.preventDefault();

  var formData = new FormData(document.getElementById("FormApproveLMA")); // Membuat objek FormData dari form

  // console.log(formData);
  const url = "<?=base_url()?>LaporanMedis/LMA/ApproveLMA";
  // Mengirim permintaan fetch ke server menggunakan metode POST
  fetch( url, {
    method: 'POST',
    body: formData
  })
    .then((response) => response.json())
    .then((data) => {

      if (data.ValReturn == true) {
        TblPatientData.setData("<?=base_url()?>LaporanMedis/LMA/data_detail/");
        $('#ModalApproveLMA').modal('hide')
        $("#FormApproveLMA").fileinput("reset");
      }else{
        alert(data.ValReturn);
        
      }
      
    })
    .catch(error => {
    console.error('Upload error:', error);
    }); 
}

function GetDetail(IP_Regist) {
              $("#ModalTimeline").modal('show')

            const url = "<?=base_url()?>LaporanMedis/LMA/CekTimeline";
            const data = {
              IP_Regist:IP_Regist
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
                
                var line_pds = document.getElementById('line_lma_1');
                var line_medis = document.getElementById('line_lma_2');
                var line_casemix = document.getElementById('line_lma_3');

                if (data.DataPasien.Create_PDS == 1) {
                  line_pds.classList.add('ActiveTimeline');
                }else{
                  line_pds.classList.remove('ActiveTimeline')
                }

                if (data.DataPasien.Confirm_Medis == 1) {
                  line_medis.classList.add('ActiveTimeline');
                }else{
                  line_medis.classList.remove('ActiveTimeline')
                }

                if (data.DataPasien.Confirm_Casemix == 1 || data.DataPasien.ToFix) {
                  line_casemix.classList.add('ActiveTimeline');
                }else{
                  line_casemix.classList.remove('ActiveTimeline')
                }
                var html = '';
                html += 
                `
                <!-- The time line -->
                  <div class="timeline">
                    <div>
                      <i class='fas fa-map-marker-alt' style='background-color: #2af794;'></i>
                    </div>
                    <br>
                `;
                for (let i = 0; i < data.HistoryPasien.length; i++) {
                  html +=
                      `
                        <div>
                          <i class="`;
                          if (data.HistoryPasien[i].Ket_User == 'PDS') {
                            html+= `fas fa-user-nurse`;
                          } else if (data.HistoryPasien[i].Ket_User == 'GP') {
                            html+= `fas fa-user-md`;
                          } else if (data.HistoryPasien[i].Ket_User == 'CASEMIX') {
                            html+= `fas fa-user-tie`;
                          }
                          html+=`" style="background-color:`;
                          if (data.HistoryPasien[i].Ket_User == 'PDS') {
                            html+= `#f599ff`;
                          } else if (data.HistoryPasien[i].Ket_User == 'GP') {
                            html+= `#effca9`;
                          } else if (data.HistoryPasien[i].Ket_User == 'CASEMIX') {
                            html+= `#7ffae3`;
                          }
                          html+=`;"></i>
                          <div class="timeline-item" style='transparent; '>
                            <div class="row">
                              <div class="col-sm-5 col-md-5" style='max-width: 200px; padding-left:20px; margin-left: 0px;'>
                              `+data.HistoryPasien[i].DateUser+`
                              </div>
                              <div class="col-sm-7 col-md-7">
                                <div class="timeline-item">
                                `
                                if (data.HistoryPasien[i].UserAction == null) {
                                  html+= data.HistoryPasien[i].User_Action
                                } else {
                                  html+= data.HistoryPasien[i].UserAction
                                }
                                html+=
                                ` `+data.HistoryPasien[i].Action+`
                                </div>
                              </div>
                            </div>
                          </div>
                          
                        </div>
                        <!-- END timeline item -->
                      `;
                }
                html +=
                  `
                    <div>
                      <i class='fas fa-map-marker-alt'></i> 
                    </div>
                    
                  </div>
                  `;
                document.getElementById('GetTimeLine').innerHTML = html

            })
          }
          function GetNote() {
  var Position_Status = document.getElementById('Position_Status').value;
  if (Position_Status == 4 || Position_Status == 5) {
    console.log('Berhasil')
    document.getElementById('Note_Chasemix').hidden = false
  }else{
    document.getElementById('Note_Chasemix_txt').innerHTML = ''
    document.getElementById('Note_Chasemix_txt').value = ''
    document.getElementById('Note_Chasemix').hidden = true
  }
}
</script>