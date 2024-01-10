  <!-- page specific plugin styles -->
  <link href="<?=base_url()?>assets/tabulator-master/dist/css/tabulator.min.css" rel="stylesheet">
	<link href="<?=base_url()?>assets/tabulator-master/dist/css/tabulator_bootstrap3.min.css" rel="stylesheet">

  <script type="text/javascript" src="<?=base_url()?>assets/tabulator-master/dist/js/tabulator.min.js"></script>
  <script type="text/javascript" src="<?=base_url()?>assets/tabulator-master/dist/js/xlsx.full.min.js"></script>
	<!-- <script type="text/javascript" src="<?=base_url()?>assets/tabulator-master/dist/js/jquery_wrapper.js"></script> -->
  <!-- <script src="//mozilla.github.io/pdf.js/build/pdf.js"></script> -->
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



<!-- Modal -->
<div class="modal fade" id="ModalListLML" tabindex="-1" aria-labelledby="ModalListLMLLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalListLMLLabel">Data Rinci Patient</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-bordered table-sm">
            <thead>
              <tr>
                <th>Aksi</th>
                <th>Nomor Registrasi</th>
                <th>Nomor Dokumen</th>
                <th>Nama Dokumen</th>
              </tr>
            </thead>
            <tbody id="SetList"></tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Upload Modal -->

<!-- Upload Modal -->
<form id="FormApproveLML" onsubmit="ApproveLML(event)" method="post" enctype="multipart/form-data">
<div class="modal fade" id="ModalApproveLML" tabindex="-1" aria-labelledby="ModalApproveLMLLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalApproveLMLLabel">Approve Dokumen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <!-- <canvas id="the-canvas"></canvas> -->
      <input type="hidden" name="Reg_No" id="Reg_No_LML"><input type="hidden" name="File_No" id="File_No_LML"><input type="hidden" name="Nama_Dokumen" id="Nama_Dokumen_LML">
      <table>
              <tr>
                <td>Nomor MR</td>
                <td style="width: 20px; text-align: center;">:</td>
                <td><span id="MR_No_LML"></span></td>
               
              </tr>
              <tr>
                <td>Nama Pasien</td>
                <td style="width: 20px; text-align: center;">:</td>
                <td><span id="NamaPatient_LML"></span></td>
              </tr>
              <tr>
                <td>Payer</td>
                <td style="width: 20px; text-align: center;">:</td>
                <td><span id="Payer_LML"></span></td>
              </tr>
              <tr>
                <td>Dokter GP</td>
                <td style="width: 20px; text-align: center;">:</td>
                <td><span id="Dokter_LML"></span></td>
              </tr>
            </table>
<br>
<br>
            <div style="overflow: auto;">
          <div>
            <button id="prev" type="button" class="btn btn-sm btn-success">Previous</button>
            <button id="next" type="button" class="btn btn-sm btn-success">Next</button>
            &nbsp; &nbsp;
            <span>Page: <span id="page_num"></span> / <span id="page_count"></span></span>
<br>
            <label for="">Preview PDF</label>

          </div>
          <canvas id="the-canvas"></canvas>
          </div>
          <br>
          <div class="form-group">
            <label for="">Pilih Status Konfirmasi</label>
            <select name="Position_Status" id="Position_Status" class="form-control" onchange="GetNote()">
              <option value="3">Approve</option>
              <option value="4">Decline With Note</option>
              <option value="5">Decline</option>
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
        <h5 class="modal-title" id="ModalTimelineLabel">Timeline Laporan Medis Lanjutan</h5>
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

            <div class="marker m4 timeline-icon ma4 " id="line_lma_4">
            <i class="fas fa-money-bill-wave-alt"></i>
            </div>
          </div>
                <br>
                <br>
          <div id="GetTimeLine"></div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>

                      var TblPatientData = new Tabulator("#TblPatient", {
												ajaxURL:"<?=base_url()?>LaporanMedis/LML/data_detail/", //ajax URL
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
													{title:"" , sortable:false, field:"Reg_No",
														formatter:function(cell, formatterParams, onRendered){
															var value = cell.getRow().getData();
                              if (value.Position_Status.trim() == 3 || value.Position_Status.trim() == 5 || value.Position_Status.trim() == 6 || value.Position_Status.trim() == 1 || value.Position_Status.trim() == 4) {
                                var btn2 = '';
                                if (value.Position_Status.trim() == 3) {
                                  var btn2 = `<button type="button" disabled class="btn btn-xs btn-success" onclick="FormApproveLML('`+value.Reg_No.trim()+`','`+value.File_No.trim()+`')"><i class="fas fa-check"></i> Casemix Confirmed</button>`
                                }
                                if (value.Position_Status.trim() == 5) {
                                  var btn2 = `<button type="button" disabled class="btn btn-xs btn-success" onclick="FormApproveLML('`+value.Reg_No.trim()+`','`+value.File_No.trim()+`')"><i class="fas fa-check"></i> Casemix Declined</button>`
                                } 
                                if (value.Position_Status.trim() == 6) {
                                  var btn2 = `<button type="button" disabled class="btn btn-xs btn-success" onclick="FormApproveLML('`+value.Reg_No.trim()+`','`+value.File_No.trim()+`')"><i class="fas fa-check"></i> PDS/KASIR Received</button>`
                                } 
                                if (value.Position_Status.trim() == 1) {
                                  var btn2 = `<button type="button" disabled class="btn btn-xs btn-success" onclick="FormApproveLML('`+value.Reg_No.trim()+`','`+value.File_No.trim()+`')"><i class="fas fa-check"></i> PDS/KASIR Upload</button>`
                                } 
                                if (value.Position_Status.trim() == 4) {
                                  var btn2 = `<button type="button" disabled class="btn btn-xs btn-success" onclick="FormApproveLML('`+value.Reg_No.trim()+`','`+value.File_No.trim()+`')"><i class="fas fa-check"></i> Decline With Note</button>`
                                } 
                              } else {
                              var btn2 = `<button type="button" class="btn btn-xs btn-success" onclick="FormApproveLML('`+value.Reg_No.trim()+`','`+value.File_No.trim()+`')"><i class="fas fa-check"></i> Approval</button>`
                                
                              }
                              // var btn = `<button type="button" class="btn btn-xs btn-success" onclick=GetUpload('`+value.IP_Registration_No+`')><i class="fa fa-upload"></i></button>`
                              // var btn3 = `<button type="button" class="btn btn-xs btn-danger" onclick=FormDeclineLML('`+value.Reg_No.trim()+`','`+value.File_No.trim()+`')><i class="fas fa-times"></i> Decline</button>`
                              return btn2  ;
														},
													},
													{title:"MR No", field:"MR_No", headerFilter:"input", cssClass: "custom-padding" },
													{title:"MR No", field:"File_No", headerFilter:"input", cssClass: "custom-padding" },
													{title:"Nama Pasien", field:"Patient_Name", headerFilter:"input", cssClass: "custom-padding" },
													{title:"Dokter", field:"Doctor_Name", headerFilter:"input", hozAlign:"center"},
													{title:"Asuransi", field:"Company_Name", headerFilter:"input", hozAlign:"center"},
													{title:"File No", field:"File_No", hozAlign:"center"},
													// {title:"Inisial Dokumen", field:"Initial_Document", width:130, hozAlign:"center"},
                          // {title:"Timeline" , sortable:false, field:"Reg_No", width:100,
													// 	formatter:function(cell, formatterParams, onRendered){
													// 		var value = cell.getRow().getData();
                          //     // var btn = `<button type="button" class="btn btn-xs btn-success" onclick=GetUpload('`+value.IP_Registration_No+`')><i class="fa fa-upload"></i></button>`
                          //     var btn = `<button type="button" class="btn btn-xs btn-success" onclick=GetDetail('`+value.Reg_No.trim()+`','`+value.File_No.trim()+`')><i class="fas fa-user-clock"></i> History</button>`
                          //     return btn;
													// 	},
													// },
													
												],
                        
												
											});


GetNewData();
function GetNewData() {
    cekDateAwal = document.getElementById('date_awal').value;
    cekDateAkhir = document.getElementById('date_akhir').value;
    if (cekDateAwal == null || cekDateAwal == '' ) {
      fromDate = document.getElementById('date_awal').value;
    }else{
      fromDate = document.getElementById('date_awal').value + ' 00:00:00';

    }

    if (cekDateAkhir == null || cekDateAkhir == '' ) {
      toDate = document.getElementById('date_akhir').value;
    }else{
      toDate = document.getElementById('date_akhir').value + ' 23:59:59';
      
    }

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

function FormNew(IP_Registration_No, File_No) {
  $('#ModalListLML').modal("show");
    const url = "<?=base_url()?>LaporanMedis/LML/GetListDokumen";

    const rowObject = {
    IP_Registration_No : IP_Registration_No,
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
      var DataList = ""

      for (let i = 0; i < data.length; i++) {
        DataList +=
        `
        <tr>
          <td><button class='btn btn-sm btn-success' type="button" onclick="FormApproveLML('`+data[i].Reg_No.trim()+`', '`+data[i].File_No.trim()+`', '`+data[i].Seq_No+`')"><i class='fas fa-eye'></i> View Dokumen</button></td>
          <td>`+data[i].Reg_No+`</td>
          <td>`+data[i].File_No+`</td>
          <td>`+data[i].File_Name+`</td>
        </tr>
        `
        
      }

      document.getElementById('SetList').innerHTML = DataList

    })
}

function FormApproveLML(Ip_Registration_No, File_No) {

    $('#ModalApproveLML').modal("show");
    const url = "<?=base_url()?>LaporanMedis/LML/GetDetailDataPasien";

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

    document.getElementById('Reg_No_LML').value = data.DataLML.IP_Registration_No
    document.getElementById('File_No_LML').value = File_No
    document.getElementById('NamaPatient_LML').innerHTML = data.DataLML.Patient_Name
    document.getElementById('MR_No_LML').innerHTML = data.DataLML.MR_No.trim()
    document.getElementById('Payer_LML').innerHTML = data.DataLML.Company_Name.trim()
    document.getElementById('Dokter_LML').innerHTML = data.DataLML.Doctor_Name.trim()
    document.getElementById('Nama_Dokumen_LML').value = data.FileName
    // const fileUrl = 'https://extranet.bethsaidahospitals.com:9002/LM/LMA/IP20230714-0022.pdf';
    // const fileUrl = '<?=base_url()?>uploads/2023/ER20230723-0048.pdf';
    
      var pdfData = atob(data.ImgBase64);

      // Loaded via <script> tag, create shortcut to access PDF.js exports.
      var pdfjsLib = window['pdfjs-dist/build/pdf'];

      // The workerSrc property shall be specified.
      pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js';

      var pdfDoc = null,
          pageNum = 1,
          pageRendering = false,
          pageNumPending = null,
          scale = 0.8,
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

    })
    .catch(error => {
    console.error('Error:', error);
    });
}

function ApproveLML(event) {
  event.preventDefault();

  var formData = new FormData(document.getElementById("FormApproveLML")); // Membuat objek FormData dari form
  const url = "<?=base_url()?>LaporanMedis/LML/ApproveLML"
  // Mengirim permintaan fetch ke server menggunakan metode POST
  fetch( url, {
    method: 'POST',
    body: formData
  })
    .then((response) => response.json())
    .then((data) => {

      if (data.ValReturn == true) {
        console.log("TRus")
        TblPatientData.setData("<?=base_url()?>LaporanMedis/LML/data_detail/");
        $('#ModalApproveLML').modal('hide')
        $("#FormApproveLML").fileinput("reset");
      }else{
        alert(data.ValReturn);
        
      }
      
    })
    .catch(error => {
    console.error('Upload error:', error);
    }); 
}



function GetDetail(IP_Regist, File_No) {
              $("#ModalTimeline").modal('show')

            const url = "<?=base_url()?>LaporanMedis/LML/CekTimeline";
            const data = {
              IP_Regist:IP_Regist,
              File_No:File_No
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
                                  html+= data.HistoryPasien[i].Create_User
                                } else {
                                  html+= data.HistoryPasien[i].Create_User
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