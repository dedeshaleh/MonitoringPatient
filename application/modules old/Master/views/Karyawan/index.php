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
              <button class="btn btn-sm btn-success" data-target="#tambah" data-toggle="modal"><i class="fas fa-plus"></i> Tambah Menu</button>
              <div class="table-responsive">
              <table class="table table-sm table-stripped" id="data_user">
                  <thead>
                    <tr>
                      <th>NIK</th>
                      <th>Nama</th>
                      <th>Bisnis Unit</th>
                      <th>Jabatan</th>
                      <th>Tanggal Bergabung</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($data_karyawan as $val) { ?>
                      <tr>
                        <td><?=$val->nik?></td>
                        <td><?=$val->name?></td>
                        <td><?=$val->bisnis_unit?></td>
                        <td><?=$val->jabatan?></td>
                        <td><?=$val->tgl_bergabung?></td>
                        <td><?=$val->aktif?></td>
                        <td><button type="button" onclick="GetEdit('<?=$val->nik?>')" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></button> || <button type="button" onclick="GetDelete('<?=$val->nik?>')" class="btn btn-xs btn-danger"><i class="fas fa-ban"></i></button></td>
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
<form action="<?=base_url()?>Master/karyawan/Tambah" method="post" enctype="multipart/form-data">
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
            <label for="">NIK</label>
            <input type="text" name="nik" id="nik" class="form-control">
          </div>
          </div>
          <div class="col-6">
          <div class="form-group">
            <label for="">Nama Lengkap</label>
            <input type="text" name="name" id="name" class="form-control">
          </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
          <div class="form-group">
            <label for="">Bisnis Unit</label>
            <input type="text" name="bisnis_unit" id="bisnis_unit" class="form-control" readonly value="Paramount Enterprise International">
          </div>
          </div>
          <div class="col-6">
          <div class="form-group">
            <label for="">Jabatan</label>
            <input type="text" name="jabatan" id="jabatan" class="form-control">
          </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
          <div class="form-group">
            <label for="">Tanggal Bergabung</label>
            <input type="date" name="tgl_bergabung" id="tgl_bergabung" class="form-control">
          </div>
          </div>
          <div class="col-6">
          
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
<form action="<?=base_url()?>Master/Karyawan/Edit" method="post" enctype="multipart/form-data">
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
            <label for="">NIK</label>
            <input type="text" name="nik" id="nik_edit" class="form-control" readonly>
          </div>
          </div>
          <div class="col-6">
          <div class="form-group">
            <label for="">Nama Lengkap</label>
            <input type="text" name="name" id="name_edit" class="form-control">
          </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
          <div class="form-group">
            <label for="">Bisnis Unit</label>
            <input type="text" name="bisnis_unit" id="bisnis_unit_edit" class="form-control" readonly value="Paramount Enterprise International">
          </div>
          </div>
          <div class="col-6">
          <div class="form-group">
            <label for="">Jabatan</label>
            <input type="text" name="jabatan" id="jabatan_edit" class="form-control">
          </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
          <div class="form-group">
            <label for="">Tanggal Bergabung</label>
            <input type="date" name="tgl_bergabung" id="tgl_bergabung_edit" class="form-control">
          </div>
          </div>
          <div class="col-6">
          <div class="form-group">
            <label for="">Status Karyawan</label>
            <select name="aktif" id="aktif_edit" class="form-control">
              <option value="">-Pilih-</option>
              <option value="Y">Aktif</option>
              <option value="N">Tidak Aktif</option>
            </select>
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
        <button type="submit" class="btn btn-warning">Edit</button>
      </div>
    </div>
  </div>
</div>
</form>


<form action="<?=base_url()?>Master/Karyawan/Delete" method="post" enctype="multipart/form-data">
<div class="modal fade" id="modalDel" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalDelLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDelLabel"><?=$judul?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label for="">Apakah anda yakin ingin mendelete Menu ini : <span id="nik_name_del"></span></label>
        <input type="hidden" name="nik" id="nik_del">
       
        
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
  function GetEdit(nik) {
    $.ajax({
      url : "<?=base_url()?>Master/Karyawan/GetData",
      type : "POST",
      dataType : "JSON",
      data : {nik:nik},
      success : function (data) {
        $("#modalEdit").modal("show");
        document.getElementById("nik_edit").value = data.nik;
        document.getElementById("name_edit").value = data.name;
        document.getElementById("bisnis_unit_edit").value = data.bisnis_unit;
        document.getElementById("jabatan_edit").value = data.jabatan;
        document.getElementById("tgl_bergabung_edit").value = data.tgl_bergabung;
        document.getElementById("aktif_edit").value = data.aktif;

      }
    })
  }
  function GetDelete(nik) {
    $.ajax({
      url : "<?=base_url()?>Master/Karyawan/GetData",
      type : "POST",
      dataType : "JSON",
      data : {nik:nik},
      success : function (data) {
        $("#modalDel").modal("show");
        document.getElementById("nik_name_del").innerHTML = data.nik+" - "+data.name;
        document.getElementById("nik_del").value = data.nik;

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