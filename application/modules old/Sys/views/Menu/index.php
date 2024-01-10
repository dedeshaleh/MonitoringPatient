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
  <?php 
    $idlevel  = $this->session->userdata['id_level'];
    $q1 = $this->db->query("SELECT * FROM tbl_menu where status_menu = '1' AND is_active = 'Y'")->result();
  ?>
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
              <button class="btn btn-sm btn-success" data-target="#tambah" data-toggle="modal"><i class="fas fa-plus"></i> Tambah Menu</button>
              <div class="table-responsive">
                <table class="table table-sm table-stripped" id="data_menu">
                  <thead>
                    <tr>
                      <th>Nama Menu</th>
                      <th>Link</th>
                      <th>Icon</th>
                      <th>Urutan</th>
                      <th>Status</th>
                      <th>Status Menu</th>
                      <th>Parent ID</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($data_menu as $val) { ?>
                      <tr>
                        <td><?=$val->nama_menu?></td>
                        <td><?=$val->link?></td>
                        <td><?=$val->icon?></td>
                        <td><?=$val->urutan?></td>
                        <td><?=$val->is_active?></td>
                        <td><?php if ($val->status_menu == 1) {
                          echo "Menu";
                        }elseif ($val->status_menu == 2) {
                          echo "Sub Menu";
                        }elseif ($val->status_menu == 3) {
                          echo "Main Menu";
                        }?></td>
                        <td><?php if($menu->get_menu($val->parent_id)){echo $menu->get_menu($val->parent_id);}else{echo "Menu Utama";}?></td>
                        <td><button type="button" onclick="GetEdit('<?=$val->id_menu?>')" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></button> || <button type="button" onclick="GetDelete('<?=$val->id_menu?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>
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
<form action="<?=base_url()?>Sys/Menu/Tambah" method="post" enctype="multipart/form-data">
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
            <label for="">Nama Menu</label>
            <input type="text" name="nama_menu" id="nama_menu" class="form-control">
          </div>
          </div>
          <div class="col-6">
          <div class="form-group">
            <label for="">Link</label>
            <input type="text" name="link" id="link" class="form-control">
          </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
          <div class="form-group">
            <label for="">Icon</label>
            <input type="text" name="icon" id="icon" class="form-control" placeholder="kode Icon Font Awesome">
          </div>
          </div>
          <div class="col-6">
          <div class="form-group">
            <label for="">Urutan</label>
            <input type="number" name="urutan" id="urutan" class="form-control">
          </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
          <div class="form-group">
            <label for="">Status Active</label>
            <select name="is_active" id="is_active" class="form-control">
              <option value="">-Pilih-</option>
              <option value="Y">Active</option>
              <option value="N">Not Active</option>
            </select>
          </div>
          </div>
          <div class="col-6">
          <div class="form-group">
            <label for="">Status Menu</label>
            <select name="status_menu" id="status_menu" class="form-control">
              <option value="">-Pilih-</option>
              <option value="1">Menu</option>
              <option value="2">Sub Menu</option>
              <option value="3">Main Menu</option>
            </select>
          </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
          <div class="form-group">
            <label for="">Parent Menu</label>
            <select name="parent_id" id="parent_id" class="form-control">
              <option value="0">Menu Utama</option>
              <?php foreach ($data_menu as $v) { ?>
                <option value="<?=$v->id_menu?>"><?=$v->nama_menu?></option>
              <?php } ?>
            </select>
          </div>
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
<form action="<?=base_url()?>Sys/Menu/Edit" method="post" enctype="multipart/form-data">
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
            <label for="">Nama Menu</label>
            <input type="hidden" name="id_menu" id="id_menu_edit" class="form-control">
            <input type="text" name="nama_menu" id="nama_menu_edit" class="form-control">
          </div>
          </div>
          <div class="col-6">
          <div class="form-group">
            <label for="">Link</label>
            <input type="text" name="link" id="link_edit" class="form-control">
          </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
          <div class="form-group">
            <label for="">Icon</label>
            <input type="text" name="icon" id="icon_edit" class="form-control" placeholder="kode Icon Font Awesome">
          </div>
          </div>
          <div class="col-6">
          <div class="form-group">
            <label for="">Urutan</label>
            <input type="number" name="urutan" id="urutan_edit" class="form-control">
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
            <label for="">Status Menu</label>
            <select name="status_menu" id="status_menu_edit" class="form-control">
              <option value="">-Pilih-</option>
              <option value="1">Menu</option>
              <option value="2">Sub Menu</option>
              <option value="3">Main Menu</option>
            </select>
          </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
          <div class="form-group">
            <label for="">Parent Menu</label>
            <select name="parent_id" id="parent_id_edit" class="form-control">
              <option value="0">Menu Utama</option>
              <?php foreach ($data_menu as $v) { ?>
                <option value="<?=$v->id_menu?>"><?=$v->nama_menu?></option>
              <?php } ?>
            </select>
          </div>
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


<form action="<?=base_url()?>Sys/Menu/Delete" method="post" enctype="multipart/form-data">
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
        <label for="">Apakah anda yakin ingin mendelete Menu ini : <span id="nama_menu_del"></span></label>
        <input type="hidden" name="id_menu" id="id_menu_del">
       
        
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
    $("#data_menu").DataTable({
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
      url : "<?=base_url()?>Sys/Menu/GetData",
      type : "POST",
      dataType : "JSON",
      data : {id:id},
      success : function (data) {
        $("#modalEdit").modal("show");
        document.getElementById("nama_menu_edit").value = data.nama_menu;
        document.getElementById("link_edit").value = data.link;
        document.getElementById("icon_edit").value = data.icon;
        document.getElementById("urutan_edit").value = data.urutan;
        document.getElementById("is_active_edit").value = data.is_active;
        document.getElementById("status_menu_edit").value = data.status_menu;
        document.getElementById("parent_id_edit").value = data.parent_id;
        document.getElementById("id_menu_edit").value = data.id_menu;

      }
    })
  }
  function GetDelete(id) {
    $.ajax({
      url : "<?=base_url()?>Sys/Menu/GetData",
      type : "POST",
      dataType : "JSON",
      data : {id:id},
      success : function (data) {
        $("#modalDel").modal("show");
        document.getElementById("nama_menu_del").innerHTML = data.nama_menu;
        document.getElementById("id_menu_del").value = data.id_menu;

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