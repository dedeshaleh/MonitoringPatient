<?php 

$apl = $this->db->get("aplikasi")->row();
?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="" class="navbar-brand">
        <img src="<?=base_url()?>assets/foto/logo/<?=$apl->logo?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><?=$apl->nama_aplikasi;?></span>
      </a>

      

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          
        </ul>

      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
      
        <li class="nav-item">
          <?=$NamaPasien?>
        </li>
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->