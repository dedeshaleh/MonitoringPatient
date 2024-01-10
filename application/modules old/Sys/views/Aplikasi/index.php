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
            <li class="breadcrumb-item active"><a href="#"><?=$judul?></a></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-chart-pie mr-1"></i>
                <?=$judul?>
              </h3>
              <div class="card-tools">
                <ul class="nav nav-pills ml-auto">
                  
                </ul>
              </div>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-sm table-stripped">
                  <thead>
                    <tr>
                      <th>Nama Owner</th>
                      <th>Alamat</th>
                      <th>Telephone</th>
                      <th>Title</th>
                      <th>Nama Aplikasi</th>
                      <th>Logo</th>
                      <th>Copyright</th>
                      <th>Versi</th>
                      <th>Tahun</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($data_aplikasi as $val) { ?>
                      <tr>
                        <td><?=$val->nama_owner?></td>
                        <td><?=$val->alamat?></td>
                        <td><?=$val->tlp?></td>
                        <td><?=$val->title?></td>
                        <td><?=$val->nama_aplikasi?></td>
                        <td><?=$val->logo?></td>
                        <td><?=$val->copy_right?></td>
                        <td><?=$val->versi?></td>
                        <td><?=$val->tahun?></td>
                        <td><button type="button" onclick="GetEdit('<?=$val->id?>')" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></button> || <button type="button" onclick="GetDelete('<?=$val->id?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div><!-- /.card-body -->
          </div>
          <!-- /.card -->

        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">

        
          <!-- /.card -->
        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal -->
<form action="<?=base_url()?>Sys/Aplikasi/Edit" method="post" enctype="multipart/form-data">
<div class="modal fade" id="modalEdit" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditLabel"><?=$judul?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id" id="id_edit">
        <div class="row">
          <div class="col-6">
          <div class="form-group">
            <label for="">Title</label>
            <input type="text" name="title" id="title_edit" class="form-control">
          </div>
          </div>
          <div class="col-6">
          <div class="form-group">
            <label for="">Nama Aplikasi</label>
            <input type="text" name="nama_aplikasi" id="nama_aplikasi_edit" class="form-control">
          </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
          <div class="form-group">
            <label for="">Nama Owner</label>
            <input type="text" name="nama_owner" id="nama_owner_edit" class="form-control">
          </div>
          </div>
          <div class="col-6">
          <div class="form-group">
            <label for="">Telephone</label>
            <input type="text" name="tlp" id="tlp_edit" class="form-control">
          </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
          <div class="form-group">
            <label for="">Copyright</label>
            <input type="text" name="copy_right" id="copy_right_edit" class="form-control">
          </div>
          </div>
          <div class="col-6">
          <div class="form-group">
            <label for="">Versi</label>
            <input type="text" name="versi" id="versi_edit" class="form-control">
          </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
          <div class="form-group">
            <label for="">Tahun</label>
            <input type="text" name="tahun" id="tahun_edit" class="form-control">
          </div>
          </div>
          <div class="col-6">
          <div class="form-group">
            <label for="exampleInputFile">Logo</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="logo" name="logo" onchange="loadFile(event)">
                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
              </div>
            </div>
          </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
          <div class="form-group">
            <label for="">Alamat</label>
            <textarea name="alamat" id="alamat_edit" cols="30" rows="6" class="form-control"></textarea>
          </div>
          </div>
          <div class="col-6">
            <table class="table-responsive">
              <tr>
                <td>Logo Sebelumnya</td>
                <td><span id="logo_pre" hidden>Logo Preview</span> </td>
              </tr>
              <tr>
                <td>
                  <img src="" alt="" id="logo_img" style="height: 100px; height: 100px;">
                </td>
                <td>
                  <img src="" alt="" id="output" style="height: 100px; height: 100px;">
                </td>
              </tr>
            </table>
            <div class="row">
              
             
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>
</form>



<script>

  function GetEdit(id) {
    $.ajax({
      url : "<?=base_url()?>Sys/Aplikasi/GetData",
      type : "POST",
      dataType : "JSON",
      data : {id:id},
      success : function (data) {
        $("#modalEdit").modal("show");
        document.getElementById("nama_owner_edit").value = data.nama_owner;
        document.getElementById("alamat_edit").value = data.alamat;
        document.getElementById("tlp_edit").value = data.tlp;
        document.getElementById("title_edit").value = data.title;
        document.getElementById("nama_aplikasi_edit").value = data.nama_aplikasi;
        document.getElementById("logo_img").src = '<?=base_url()?>assets/foto/logo/'+data.logo;
        document.getElementById("copy_right_edit").value = data.copy_right;
        document.getElementById("versi_edit").value = data.versi;
        document.getElementById("tahun_edit").value = data.tahun;
        document.getElementById("id_edit").value = data.id;

      }
    })
  }
  var loadFile = function(event) {
          var output = document.getElementById('output');
          output.src = URL.createObjectURL(event.target.files[0]);
          output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
          }
          document.getElementById("logo_pre").hidden = false;
        };
  $(function () {
    bsCustomFileInput.init();
  });
</script>