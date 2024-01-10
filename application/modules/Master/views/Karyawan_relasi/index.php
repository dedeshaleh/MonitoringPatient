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
                      <th>Nama Karyawan</th>
                      <th>Relasi</th>
                      <th>Nama Relasi</th>
                      <th>Status Plafond</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($data_karyawan as $val) { ?>
                      <tr>
                        <td><?=$val->name?></td>
                        <td><?=$val->relasi?></td>
                        <td><?=$val->nama_relasi?></td>
                        <td><?php if ($val->flag_plafond == 1) {
                          echo "Aktif";
                        }else{
                          echo "Tidak Aktif";
                        }?></td>
                        <td><button type="button" onclick="GetEdit('<?=$val->id_relasi?>')" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></button> || <button type="button" onclick="GetDelete('<?=$val->id_relasi?>')" class="btn btn-xs btn-danger"><i class="fas fa-ban"></i></button></td>
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
<form action="<?=base_url()?>Master/karyawan_relasi/Tambah" method="post" enctype="multipart/form-data">
<div class="modal fade" id="tambah" data-backdrop="static" role="dialog" aria-labelledby="tambahLabel" aria-hidden="true">
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
            <select name="nik" id="nik" class="form-control select2bs4">
              <option value="">-Pilih-</option>
              <?php foreach ($data_karyawan_pei as $va) { ?>
                <option value="<?=$va->nik?>"><?=$va->nik?> - <?=$va->name?></option>
              <?php } ?>
            </select>
          </div>
          </div>
          <div class="col-6">
          <div class="form-group">
            <label for="">Nama Relasi</label>
            <input type="text" name="nama_relasi" id="nama_relasi" class="form-control">
          </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
          <div class="form-group">
            <label for="">Relasi</label>
            <select name="relasi" id="relasi" class="form-control">
              <option value="">-Pilih-</option>
              <option value="Sendiri">Sendiri</option>
              <option value="Istri">Istri</option>
              <option value="Anak1">Anak1</option>
              <option value="Anak2">Anak2</option>
            </select>
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
<form action="<?=base_url()?>Master/Karyawan_relasi/Edit" method="post" enctype="multipart/form-data">
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
            <input type="hidden" name="id_relasi" id="id_relasi_edit">
            <input type="hidden" name="nik" id="nik_edit2">
            <select name="" id="nik_edit" class="form-control select2bs4" disabled>
              <option value="">-Pilih-</option>
              <?php foreach ($data_karyawan_pei as $va) { ?>
              <option value="<?=$va->nik?>"><?=$va->nik?> - <?=$va->name?></option>
              <?php } ?>
            </select>
          </div>
          </div>
          <div class="col-6">
          <div class="form-group">
            <label for="">Nama Relasi</label>
            <input type="text" name="nama_relasi" id="nama_relasi_edit" class="form-control">
          </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
          <div class="form-group">
            <label for="">Relasi</label>
            <select name="relasi" id="relasi_edit" class="form-control">
              <option value="">-Pilih-</option>
              <option value="Sendiri">Sendiri</option>
              <option value="Istri">Istri</option>
              <option value="Anak1">Anak1</option>
              <option value="Anak2">Anak2</option>
            </select>
          </div>
          </div>
          <div class="col-6">
          <div class="form-group">
            <label for="">Status Relasi</label>
            <select name="flag_plafond" id="flag_plafond_edit" class="form-control">
              <option value="">-Pilih-</option>
              <option value="1">Aktif</option>
              <option value="0">Tidak Aktif</option>
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


<form action="<?=base_url()?>Master/Karyawan_relasi/Delete" method="post" enctype="multipart/form-data">
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
        <label for="">Apakah anda yakin ingin mendelete Relasi ini : </label>
        <label for=""><span id="nama_relasi_del"></span></label>
        <input type="hidden" name="id_relasi" id="id_relasi_del">
       
        
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
  function GetEdit(id_relasi) {
    $.ajax({
      url : "<?=base_url()?>Master/Karyawan_relasi/GetData",
      type : "POST",
      dataType : "JSON",
      data : {id_relasi:id_relasi},
      success : function (data) {
        $("#modalEdit").modal("show");
        document.getElementById("id_relasi_edit").value = data.id_relasi;
        document.getElementById("nik_edit2").value = data.nik;
        document.getElementById("nama_relasi_edit").value = data.nama_relasi;
        document.getElementById("relasi_edit").value = data.relasi;
        document.getElementById("flag_plafond_edit").value = data.flag_plafond;

        // Set selected 
        $('#nik_edit').val(data.nik);
        $('#nik_edit').select2({
            theme: 'bootstrap4'
          }).trigger('change');
        // document.getElementById("flag_plafond_edit").value = data.flag_plafond;

      }
    })
  }
  function GetDelete(id_relasi) {
    $.ajax({
      url : "<?=base_url()?>Master/Karyawan_relasi/GetData",
      type : "POST",
      dataType : "JSON",
      data : {id_relasi:id_relasi},
      success : function (data) {
        $("#modalDel").modal("show");
        document.getElementById("nama_relasi_del").innerHTML = data.name+" - "+data.relasi+" - "+data.nama_relasi;
        document.getElementById("id_relasi_del").value = data.id_relasi;

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
  
  $('.select2').select2()
  

//Initialize Select2 Elements
  $('.select2bs4').select2({
    theme: 'bootstrap4'
  })
</script>