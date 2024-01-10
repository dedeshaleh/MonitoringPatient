<!DOCTYPE html>
<html lang="en">
<head>
<?php 

$apl = $this->db->get("aplikasi")->row();
?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title><?=$judul?> | <?=$apl->nama_aplikasi;?></title>
  <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url()?>assets/foto/logo/<?=$apl->logo?>" />
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url()?>assets/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url()?>assets/adminlte/dist/css/adminlte.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?=base_url()?>assets/adminlte/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  
  
  <!-- jQuery -->
  <script src="<?=base_url()?>assets/adminlte/plugins/jquery/jquery.min.js"></script>

  <!-- Bootstrap 4 -->
  <script src="<?=base_url()?>assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?=base_url()?>assets/adminlte/dist/js/adminlte.js"></script>
  <!-- bs-custom-file-input -->
  <script src="<?=base_url()?>assets/adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
  <!-- Select2 -->
  <script src="<?=base_url()?>assets/adminlte/plugins/select2/js/select2.full.min.js"></script>
</head>
<?php $uri = $this->uri->segment(1);?>

<body <?php if($uri == "Dashboard") {echo 'class="sidebar-closed sidebar-collapse"';}else{echo"";};?> style="font-family: monserrat;">
<div class="wrapper">