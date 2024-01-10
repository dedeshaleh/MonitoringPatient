
<!DOCTYPE html>
<html lang="en">
<head>
<?php 
    $apl = $this->db->get("aplikasi")->row();
  ?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?=$apl->nama_aplikasi?> | Log in</title>
  
  <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url()?>assets/foto/logo/<?=$apl->logo?>" />
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url()?>assets/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?=base_url()?>assets/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url()?>assets/adminlte/dist/css/adminlte.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?=base_url()?>assets/adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?=base_url()?>assets/adminlte/plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url()?>assets/adminlte/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    
    <img style="max-width: 100px; max-width: 100px;" src="<?=base_url()?>assets/foto/logo/<?=$apl->logo?>" alt="">
    <a href="#"><b>Monitoring Patient</b> By Marketing</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="" id="quickForm" role="form" method="post">
        <div class="input-group mb-3">
        <input type="text" id="username" name="username" class="form-control" placeholder="Username" value="<?php echo set_value('username'); ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-users"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
        <input type="password" id="password" name="password"  class="form-control" placeholder="Password" value="<?php echo set_value('password'); ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
          <?php
            if(!empty($pesan)) {
            echo $pesan;
            }
          ?>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="button" id="login" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- /.social-auth-links -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?=base_url()?>assets/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url()?>assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>assets/adminlte/dist/js/adminlte.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?=base_url()?>assets/adminlte/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?=base_url()?>assets/adminlte/plugins/toastr/toastr.min.js"></script>

<script>

var username = document.getElementById("username");
username.addEventListener("keydown", function (e) {
    if (e.keyCode === 13) {
        login();
    }
});
var password = document.getElementById("password");
password.addEventListener("keydown", function (e) {
    if (e.keyCode === 13) {
        login();
    }
});
  $("#login").on('click',function() {
      $.ajax({
        url : '<?php echo base_url('webcontrol/login') ?>',
        type : 'POST',
        data : $('#quickForm').serialize(),
        dataType : 'JSON',
        success : function(data) {
          if (data.status) {
            toastr.success('Login Berhasil!');
            var url = '<?php echo base_url('Dashboard') ?>';
            window.location = url;
          }else if (data.error) {
            toastr.error(
              data.pesan
            );
          }else{
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').addClass('is-invalid');
                    $('[name="'+data.inputerror[i]+'"]').closest('.kosong').append('<span></span>');
                    $('[name="'+data.inputerror[i]+'"]').next().next().text(data.error_string[i]).addClass('invalid-feedback');
                }
          }
        }
      });
      
  });
  function login() {
    $.ajax({
        url : '<?php echo base_url('webcontrol/login') ?>',
        type : 'POST',
        data : $('#quickForm').serialize(),
        dataType : 'JSON',
        success : function(data) {
          if (data.status) {
            toastr.success('Login Berhasil!');
            var url = '<?php echo base_url('Dashboard') ?>';
            window.location = url;
          }else if (data.error) {
            toastr.error(
              data.pesan
            );
          }else{
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').addClass('is-invalid');
                    $('[name="'+data.inputerror[i]+'"]').closest('.kosong').append('<span></span>');
                    $('[name="'+data.inputerror[i]+'"]').next().next().text(data.error_string[i]).addClass('invalid-feedback');
                }
          }
        }
      });
  }
</script>
</body>
</html>
