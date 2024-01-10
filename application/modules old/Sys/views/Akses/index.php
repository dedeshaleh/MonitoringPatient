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
              <!-- <button class="btn btn-sm btn-success" data-target="#tambah" data-toggle="modal"><i class="fas fa-plus"></i> Tambah Menu</button> -->
              <div class="table-responsive">
                <table class="table table-sm table-stripped" id="data_akses">
                  <thead>
                    <tr>
                      <th>NO</th>
                      <th>Username</th>
                      <th>Nama Lengkap</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    
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
<form action="<?=base_url()?>Sys/Akses/Edit" method="post" enctype="multipart/form-data">
<div class="modal fade" id="modalEdit" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="tambahLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahLabel"><?=$judul?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id_user" id="id_user_edit">
        <table class="table table-bordered">
          <thead>
            <tr>
              <td>Nama Menu</td>
              <td>Akses Menu</td>
              <td>Add</td>
              <td>Edit</td>
              <td>Delete</td>
              
            </tr>
          </thead>
          <tbody id="tbl_menu"></tbody>
        </table>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>
</form>



<form action="<?=base_url()?>Sys/Akses/Delete" method="post" enctype="multipart/form-data">
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

<!-- bs-custom-file-input -->
<script src="<?=base_url()?>assets/adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script>
  var id_menu = localStorage.getItem('GetMenu');
  var id_user = '<?=$this->session->userdata('id_user')?>';
  var menu_akses = $.ajax({
        url : "<?=base_url()?>Sys/Akses/getAkses",
        type : "POST",
        dataType : "JSON",
        async : false,
        data : {id_menu:id_menu, id_user:id_user},
        success : function (data) {

        }
      }).responseJSON;
  $(document).ready(function() {
    $('#data_akses').DataTable( {
		destroy: true,
		ajax: {
            'url'	: "<?=base_url()?>Sys/Akses/Data_Detail",
            'type': "POST"
        },
		columns: [
			{
			  data : "id_user",
				render: function (data, type, row, meta) {
					return meta.row + meta.settings._iDisplayStart + 1;
				}
			},
			{ data: 'username' },
			{ data: 'full_name' },
			{ 
				data: 'id_user',
				render : function (data, type, row, meta) {
          if (menu_akses.edit_level == 'Y') {
            var edit = '<button type="button" onclick="GetEdit('+row.id_user+')" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></button>';
          }else{
            var edit = '';
          }
          if (menu_akses.edit_level == 'Y' && menu_akses.delete_level == 'Y') {
            var pembatas = ' || ';
          } else {
            var pembatas = '';
          }
          if (menu_akses.delete_level == 'Y') {
            var dele = '<button type="button" onclick="GetDelete('+row.id_user+')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>';
          }else{
            var dele = ''
          }
					return edit + pembatas + dele;
				}
			}
			]
		})
	});

  function GetEdit(id) {
    $.ajax({
      url : "<?=base_url()?>Sys/Akses/GetData",
      type : "POST",
      dataType : "JSON",
      data : {id:id},
      success : function (data) {
        $("#modalEdit").modal("show");
        document.getElementById('id_user_edit').value = id;
        var html = '';
        var i;
        for (let i = 0; i < data.menu.length; i++) {
          html += 
          `<tr >
            <td> <i class="fas fa-circle"></i> `+data.menu[i].nama_menu+`</td>
            <td style="text-align:center;">
              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" name="view_`+data.menu[i].id_menu+`" id="view_`+data.menu[i].id_menu+`" value="Y"
              `;
              if (data.menu[i].view_level == 'Y') {
                html += `checked`;
              };
              html+=
              `>
                <label for="view_`+data.menu[i].id_menu+`" class="custom-control-label"></label>
              </div>
            </td>
            <td style="text-align:center;">
              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" name="add_`+data.menu[i].id_menu+`" id="add_`+data.menu[i].id_menu+`" value="Y"
              `;
              if (data.menu[i].add_level == "Y") {
                html += `checked`;
              };
              html+=
              `>
                <label for="add_`+data.menu[i].id_menu+`" class="custom-control-label"></label>
              </div>
            </td>
            <td style="text-align:center;">
              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" name="edit_`+data.menu[i].id_menu+`" id="edit_`+data.menu[i].id_menu+`" value="Y"
              `;
              if (data.menu[i].edit_level == "Y") {
                html += `checked`;
              };
              html+=
              `>
                <label for="edit_`+data.menu[i].id_menu+`" class="custom-control-label"></label>
              </div>
            </td>
            <td style="text-align:center;">
              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" name="delete_`+data.menu[i].id_menu+`" id="delete_`+data.menu[i].id_menu+`" value="Y"
              `;
              if (data.menu[i].delete_level == "Y") {
                html += `checked`;
              };
              html+=
              `>
                <label for="delete_`+data.menu[i].id_menu+`" class="custom-control-label"></label>
              </div>
            </td>
          </tr>`;

          for (let iz = 0; iz < data.submenu.length; iz++) {
            if (data.submenu[iz].parent_id == data.menu[i].id_menu) {
              html += 
          `<tr >
            <td style="padding-left: 30px"><i class="far fa-circle"></i> `+data.submenu[iz].nama_menu+`</td>
            <td style="text-align:center;">
              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" name="view_`+data.submenu[iz].id_menu+`" id="view_`+data.submenu[iz].id_menu+`" value="Y"
              `;
              if (data.submenu[iz].view_level == 'Y') {
                html += `checked`;
              };
              html+=
              `>
                <label for="view_`+data.submenu[iz].id_menu+`" class="custom-control-label"></label>
              </div>
            </td>
            <td style="text-align:center;">
              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" name="add_`+data.submenu[iz].id_menu+`" id="add_`+data.submenu[iz].id_menu+`" value="Y"
              `;
              if (data.submenu[iz].add_level == "Y") {
                html += `checked`;
              };
              html+=
              `>
                <label for="add_`+data.submenu[iz].id_menu+`" class="custom-control-label"></label>
              </div>
            </td>
            <td style="text-align:center;">
              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" name="edit_`+data.submenu[iz].id_menu+`" id="edit_`+data.submenu[iz].id_menu+`" value="Y"
              `;
              if (data.submenu[iz].edit_level == "Y") {
                html += `checked`;
              };
              html+=
              `>
                <label for="edit_`+data.submenu[iz].id_menu+`" class="custom-control-label"></label>
              </div>
            </td>
            <td style="text-align:center;">
              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" name="delete_`+data.submenu[iz].id_menu+`" id="delete_`+data.submenu[iz].id_menu+`" value="Y"
              `;
              if (data.submenu[iz].delete_level == "Y") {
                html += `checked`;
              };
              html+=
              `>
                <label for="delete_`+data.submenu[iz].id_menu+`" class="custom-control-label"></label>
              </div>
            </td>
          </tr>`;
          for (let ix = 0; ix < data.submenu3.length; ix++) {
              if (data.submenu3[ix].parent_id == data.submenu[iz].id_menu) {
                html += 
            `<tr >
              <td style="padding-left: 50px"><i class="fas fa-dot-circle"></i> `+data.submenu3[ix].nama_menu+`</td>
              <td style="text-align:center;">
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" name="view_`+data.submenu3[ix].id_menu+`" id="view_`+data.submenu3[ix].id_menu+`" value="Y"
                `;
                if (data.submenu3[ix].view_level == 'Y') {
                  html += `checked`;
                };
                html+=
                `>
                  <label for="view_`+data.submenu3[ix].id_menu+`" class="custom-control-label"></label>
                </div>
              </td>
              <td style="text-align:center;">
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" name="add_`+data.submenu3[ix].id_menu+`" id="add_`+data.submenu3[ix].id_menu+`" value="Y"
                `;
                if (data.submenu3[ix].add_level == "Y") {
                  html += `checked`;
                };
                html+=
                `>
                  <label for="add_`+data.submenu3[ix].id_menu+`" class="custom-control-label"></label>
                </div>
              </td>
              <td style="text-align:center;">
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" name="edit_`+data.submenu3[ix].id_menu+`" id="edit_`+data.submenu3[ix].id_menu+`" value="Y"
                `;
                if (data.submenu3[ix].edit_level == "Y") {
                  html += `checked`;
                };
                html+=
                `>
                  <label for="edit_`+data.submenu3[ix].id_menu+`" class="custom-control-label"></label>
                </div>
              </td>
              <td style="text-align:center;">
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" name="delete_`+data.submenu3[ix].id_menu+`" id="delete_`+data.submenu3[ix].id_menu+`" value="Y"
                `;
                if (data.submenu3[ix].delete_level == "Y") {
                  html += `checked`;
                };
                html+=
                `>
                  <label for="delete_`+data.submenu3[ix].id_menu+`" class="custom-control-label"></label>
                </div>
              </td>
            </tr>`;
              }
            }
            }
              
            
          }
        }

        $("#tbl_menu").html(html);

      }
    })
  }
  function GetDelete(id) {
    $.ajax({
      url : "<?=base_url()?>Sys/Akses/GetData",
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