
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<?php $apl = $this->db->get('aplikasi')->row();?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?=$apl->title?></title>

  <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url()?>assets/foto/logo/<?=$apl->logo?>" />

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?=base_url()?>assets/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url()?>assets/adminlte/dist/css/adminlte.min.css">
</head>
<body class="hold-transition layout-top-nav" style="font-family: monserrat;">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="" class="navbar-brand">
        <img src="<?=base_url()?>assets/foto/logo/<?=$apl->logo?>" alt="Bethsaida Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><?=$apl->nama_aplikasi?></span>
      </a>

      <!-- <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button> -->

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <!-- <li class="nav-item">
            <a href="index3.html" class="nav-link">Home</a>
          </li> -->
     
        
        </ul>

      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
      
        <li class="nav-item">
          <button class="btn btn-success btn-sm" type="button" onclick="CloseTab()">Close</button>
        </li>
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> <?=$judul?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <!-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Layout</a></li>
              <li class="breadcrumb-item active">Top Navigation</li>
            </ol> -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="card">
          <div class="card-body">
            <table>
              <tr>
                <td>Nomor MR</td>
                <td style="width: 20px; text-align: center;">:</td>
                <td><?=$DataPasien->MR_No?></td>
              </tr>
              <tr>
                <td>Nama Pasien</td>
                <td style="width: 20px; text-align: center;">:</td>
                <td><?=$DataPasien->Patient_Name?></td>
              </tr>
              <tr>
                <td>Payer</td>
                <td style="width: 20px; text-align: center;">:</td>
                <td><?=$DataPasien->Company_Name?></td>
              </tr>
              <tr>
                <td>Dokter GP</td>
                <td style="width: 20px; text-align: center;">:</td>
                <td><?=$DataPasien->Doctor_Name?></td>
              </tr>
            </table>
            
            <br>
            <br>
            <div id="loading"></div>
            <form id="UploadForm" onsubmit="UploadData(event)" method="post" enctype="multipart/form-data"> 
            <button id="AddFIle" class="btn btn-success btn-sm" type="button"><i class="fas fa-plus"></i> Tambah File</button> 
            <input type="hidden" name="IP_Registration_No" value="<?=trim($DataPasien->IP_Registration_No)?>">
              <div class="table-responsive" >
                <table class="table table-borderless">
                  <tbody id="RowAdd"></tbody>
                </table>
              </div>
            </form>
            <div style="overflow: auto;" id="PreviewPDF" hidden>
            
            <div>
              <button id="prev" type="button" class="btn btn-sm btn-success">Previous</button>
              <button id="next" type="button" class="btn btn-sm btn-success">Next</button>
              &nbsp; &nbsp;
              <span>Page: <span id="page_num"></span> / <span id="page_count"></span></span>
            </div>

            <canvas id="the-canvas"></canvas>
            </div>

            <br>
            <button class="btn btn-success btn-sm" type="button" onclick="UploadData(event)" id="UploadBtn">Upload</button> <button class="btn btn-success btn-sm" type="button" id="ConfirmBtn" data-target="#Konfirmasi" data-toggle="modal" disabled>Confirm</button> <button class="btn btn-warning btn-sm" type="button" id="ReuploadBtn" onclick="window.location.reload();" hidden>Reupload</button> 
          </div>
          <div class="card-footer"></div>
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      <!-- Anything you want -->
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; <?=$apl->tahun?> Version <?=$apl->versi?>.</strong> By. <?=$apl->nama_owner?>
    <!-- <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved. -->
  </footer>
</div>
<!-- Modal -->
<form action="<?=base_url()?>UploadMedis/LML/ConfirmData" method="post">
<div class="modal fade" id="Konfirmasi" tabindex="-1" role="dialog" aria-labelledby="KonfirmasiLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="KonfirmasiLabel">Konfirmasi Dokumen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label for="">Apakah Anda Yakin Akan Konfirmasi File Tersebut?</label>
        <input type="hidden" name="IP_Regis" id="" value="<?=trim($DataPasien->IP_Registration_No)?>">
        <input type="hidden" name="FilePath" id="FilePath">
        <input type="hidden" name="FileName" id="FileName">
        <input type="hidden" name="User" id="" value="<?=$Dokter->Doctor_Code?>">
        <input type="hidden" name="FileNo" id="" value="<?=$File_No?>">
        <div class="form-group">
          <label for="">Nama Dokumen</label>
          <input type="text" name="Initial_Document" id="Initial_Document" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Simpan Dokumen</button>
      </div>
    </div>
  </div>
</div>
</form>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?=base_url()?>assets/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url()?>assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>assets/adminlte/dist/js/adminlte.min.js"></script>
<!-- bs-custom-file-input -->
<script src="<?=base_url()?>assets/adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="<?=base_url()?>assets/adminlte/dist/js/demo.js"></script> -->
<script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>

<script>

	$(document).ready(function(){
  var i=1;  
  var z=0;  
  $('#AddFIle').click(function(){
	html = "";

		// Membuat objek Date baru

		i++; 
		z++; 
		html +=
		`
		<tr id="row`+i+`">
			
			<td style="white-space: nowrap; vertical-align: middle;"><label>Page `+z+`</label> </td>
			<td style='text-align:left;'>
				<div class="form-group ">
          <div class="custom-file">
          <input type="file" name="images[]" class="custom-file-input" id="customFile`+i+`"><label class="custom-file-label" for="customFile`+i+`">Choose file</label>
          </div>
				</div>
			</td>
		
			<td><button type="button" name="remove" id="`+i+`" class="btn btn-danger btn_remove btn-sm">X</button></td>
		</tr>
		`
	
       $('#RowAdd').append(html);
	

  });
  $(document).on("change", ".custom-file-input", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").text(fileName);
  });

  $(function () {
    bsCustomFileInput.init();
  });

  $(document).on('click', '.btn_remove', function(){
      var button_id = $(this).attr("id");
      $('#row'+button_id+'').remove();
      });
});  


function UploadData(event) {
	event.preventDefault(); // Mencegah aksi default pengiriman form
  document.getElementById('loading').innerHTML = `<div class="spinner-grow text-success" role="status">
  <span class="sr-only">Loading...</span>
</div>`;
  document.getElementById('UploadBtn').disabled = true
  document.getElementById('ConfirmBtn').disabled = true
	var formData = new FormData(document.getElementById("UploadForm")); // Membuat objek FormData dari form
	const url = "<?=base_url()?>UploadMedis/LML/UploadData";
	// Mengirim permintaan fetch ke server menggunakan metode POST
	fetch( url, {
		method: 'POST',
		body: formData
	})
		.then((response) => response.json())
		.then((data) => {
			if (data.status == 'success') {
        document.getElementById('ConfirmBtn').disabled = false
        document.getElementById('UploadBtn').disabled = true
        document.getElementById('PreviewPDF').hidden = false
        document.getElementById('UploadForm').hidden = true

        document.getElementById('loading').innerHTML = data.message

				// DataPenerimaan.setData("<?=base_url()?>UploadMedis/LML/UploadData");
        var pdfData = atob(data.DataPdf);

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
        document.getElementById('ReuploadBtn').hidden = false
        document.getElementById('FilePath').value = data.FilePath
        document.getElementById('FileName').value = data.FileName

			}else{
				// alert(data.message);
        document.getElementById('UploadBtn').disabled = false
        document.getElementById('ConfirmBtn').disabled = true
        document.getElementById('UploadForm').hidden = false
        document.getElementById('loading').innerHTML = data.message

				
			}
			
		})
		.catch(error => {
		console.error('Upload error:', error);
		});
}

function GetUpload(IdPenerimaan) {
	$("#UploadDataHasil").modal("show")
	document.getElementById('IdPenerimaan_Upload').value = IdPenerimaan
}

</script>
</body>
</html>
