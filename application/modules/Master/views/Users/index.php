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
              <i class="fas fa-folder-open"></i>
                <?=$judul?>
              </h3>
              <div class="card-tools">
                <ul class="nav nav-pills ml-auto">
                  
                </ul>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <button class="btn btn-sm btn-success" data-target="#tambah" data-toggle="modal"><i class="fas fa-plus"></i> Tambah User</button>
              <div class="table-responsive">
              <table class="table table-sm table-stripped" id="data_user">
                  <thead>
                    <tr>
                      <th>Username</th>
                      <th>Nama Lengkap</th>
                      <th>Level</th>
                      <th>Image</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($data_users as $val) { ?>
                      <tr>
                        <td><?=$val->username?></td>
                        <td><?=$val->full_name?></td>
                        <td><?=$val->nama_level?></td>
                        <td><img src="<?=base_url()?>assets/foto/user/<?=$val->image?>" alt="" style="height: 100px; width: 100px;"></td>
                        <td><?=$val->is_active?></td>
                        <td><button type="button" onclick="GetEdit('<?=$val->id_user?>')" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></button> || <button type="button" onclick="GetDelete('<?=$val->id_user?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>
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
<form action="<?=base_url()?>Master/Users/Tambah" method="post" enctype="multipart/form-data">
<div class="modal fade" id="tambah" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="tambahLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahLabel"><?=$judul?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-6">
          <div class="form-group">
            <label for="">Username</label>
            <input type="text" name="username" id="username" class="form-control" required>
          </div>
          </div>
          <div class="col-6">
          <div class="form-group">
            <label for="">Nama Lengkap</label>
            <input type="text" name="full_name" id="full_name" class="form-control" required>
          </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
          <div class="form-group">
            <label for="">Level</label>
            <select name="id_level" id="id_level" class="form-control" required>
              <option value="">-Pilih-</option>
              <?php foreach ($data_level as $level) { ?>
                <option value="<?=$level->id_level?>"><?=$level->nama_level?></option>
              <?php } ?>
            </select>
          </div>
          </div>
          <div class="col-6">
          <div class="form-group">
            <label for="">password</label>
            <input type="password" name="password" id="password" class="form-control" required>
          </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
          <div class="form-group">
            <label for="">Status Active</label>
            <select name="is_active" id="is_active" class="form-control" required>
              <option value="">-Pilih-</option>
              <option value="Y">Active</option>
              <option value="N">Not Active</option>
            </select>
          </div>
          </div>
          <div class="col-6">
          <div class="form-group">
            <label for="exampleInputFile">Image</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="image" name="image" onchange="loadFile(event)">
                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  
              </div>
            </div>
            <br>
            <img src="" alt="" id="logo_img" style="height: 100px; height: 100px;">
           </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
          
          </div>
          <div class="col-6">
          
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

<!-- Modal Edit-->

<!-- Modal -->
<form action="<?=base_url()?>Master/Users/Edit" method="post" enctype="multipart/form-data">
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
        <div class="row">
          <div class="col-6">
          <div class="form-group">
            <label for="">Username</label>
            <input type="text" name="username" id="username_edit" class="form-control">
            <input type="hidden" name="id_user" id="id_user_edit" class="form-control">
          </div>
          </div>
          <div class="col-6">
          <div class="form-group">
            <label for="">Nama Lengkep</label>
            <input type="text" name="full_name" id="full_name_edit" class="form-control">
          </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
          <div class="form-group">
            <label for="">Level</label>
            <select name="id_level" id="id_level_edit" class="form-control">
              <option value="">-Pilih-</option>
              <?php foreach ($data_level as $level) { ?>
                <option value="<?=$level->id_level?>"><?=$level->nama_level?></option>
              <?php } ?>
            </select>
          </div>
          </div>
          <div class="col-6">
          <div class="form-group">
            <label for="">password</label>
            <input type="password" name="password" id="password_edit" class="form-control">
          </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
          <div class="form-group">
            <label for="">Status Active</label>
            <select name="is_active" id="is_active_edit" class="form-control">
              <option value="">-Pilih-</option>
              <option value="Y">Active</option>
              <option value="N">Not Active</option>
            </select>
          </div>
          </div>
          <div class="col-6">
          <div class="form-group">
            <label for="exampleInputFile">Image</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="image" name="image" onchange="loadFileEdit(event)">
                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  
              </div>
            </div>
           </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
          <table class="table-responsive">
              <tr>
                <td>Image Sebelumnya</td>
                <td><span id="logo_pre" hidden>Image Preview</span> </td>
              </tr>
              <tr>
                <td>
                  <img src="" alt="" id="image_edit" style="height: 100px; height: 100px;">
                </td>
                <td>
                  <img src="" alt="" id="output" style="height: 100px; height: 100px;">
                </td>
              </tr>
            </table>
          </div>
          <div class="col-6">
          
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


<form action="<?=base_url()?>Master/Users/Delete" method="post" enctype="multipart/form-data">
<div class="modal fade" id="modalDel" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalDelLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDelLabel"><?=$judul?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label for="">Apakah anda yakin ingin mendelete User ini : <span id="full_name_del"></span></label>
        <input type="hidden" name="id_user" id="id_user_del">
       
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Hapus</button>
      </div>
    </div>
  </div>
</div>
</form>

<script>
  $(function () {
    $("#data_user").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
  function GetEdit(id) {
    $.ajax({
      url : "<?=base_url()?>Master/Users/GetData",
      type : "POST",
      dataType : "JSON",
      data : {id:id},
      success : function (data) {
        $("#modalEdit").modal("show");
        document.getElementById("username_edit").value = data.username;
        document.getElementById("full_name_edit").value = data.full_name;
        document.getElementById("id_level_edit").value = data.id_level;
        document.getElementById("password_edit").value = data.password;
        document.getElementById("is_active_edit").value = data.is_active;
        document.getElementById("image_edit").src = '<?=base_url()?>assets/foto/user/'+data.image;
        document.getElementById("id_user_edit").value = data.id_user;

      }
    })
  }
  function GetDelete(id) {
    $.ajax({
      url : "<?=base_url()?>Master/Users/GetData",
      type : "POST",
      dataType : "JSON",
      data : {id:id},
      success : function (data) {
        $("#modalDel").modal("show");
        document.getElementById("full_name_del").innerHTML = data.full_name;
        document.getElementById("id_user_del").value = data.id_user;

      }
    })
  }
  var loadFile = function(event) {
          var output = document.getElementById('logo_img');
          output.src = URL.createObjectURL(event.target.files[0]);
          output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
          }
        };
        var loadFileEdit = function(event) {
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