
<?php 

$apl = $this->db->get("aplikasi")->row();
?>
<!-- main-header navbar navbar-expand navbar-default navbar-dark navbar-cyan -->
<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-default navbar-dark navbar-indigo">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Home</a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
    </ul>



    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a href="#" class="nav-link">
          <div class="user-panel">
        <!-- <div class="image"> -->
          <img src="<?php echo base_url();?>assets/foto/user/<?php echo $this->session->userdata['image'];?>" class="img-circle" alt="User Image">
          <?php echo $this->session->userdata['full_name']; ?>
        </div>
      <!-- </div> -->
        
        </a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('webcontrol/logout') ?>" role="button">
          <i class="fas fa-sign-out-alt" title="Sign Out" ></i>
        </a>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-indigo elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url('cdashboard'); ?>" class="brand-link bg-indigo">
      <img src="<?php echo base_url();?>assets/foto/logo/<?php echo $apl->logo; ?>" alt="<?php echo $apl->title; ?>" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"><?php echo  $apl->title; ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url();?>assets/foto/user/<?php echo $this->session->userdata['image']; ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $this->session->userdata['full_name']; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-compact nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
          
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

      <?php
            // data main menu


      $idlevel  = $this->session->userdata['id_level'];

      $id_user = $this->session->userdata('id_user');
      $q1 = $this->db->query("SELECT a.* FROM tbl_menu AS a LEFT JOIN tbl_akses_menu AS b ON b.id_menu = a.id_menu where status_menu = '1' AND is_active = 'Y' AND b.id_user = '$id_user' AND b.view_level = 'Y' ")->result();
    
      foreach ($q1 as $menu) { ?>
          <li class="nav-item<?php if($this->uri->segment(1) == $menu->link){echo ' menu-open';}?>">
            <a href="<?=base_url().$menu->link?>" class="nav-link <?php if($this->uri->segment(1) == $menu->link){echo 'active';}?>" >
              <i class="nav-icon fas <?=$menu->icon?>"></i>
              <p>
                <?=$menu->nama_menu?>
                <?php $q_menu1 = $this->db->query("SELECT a.* FROM tbl_menu AS a LEFT JOIN tbl_akses_menu AS b ON b.id_menu = a.id_menu where a.parent_id = '$menu->id_menu' AND status_menu = '2' AND b.id_user = '$id_user' AND b.view_level = 'Y' ")->num_rows(); if($q_menu1 > 0){echo '<i class="right fas fa-angle-left"></i>';}?>
                <input type="hidden" class="GetIdMenu" value="<?php if($this->uri->segment(1) == $menu->link){echo $menu->id_menu;}?>">
              </p>
            </a>
            <?php if($q_menu1 > 0){echo '<ul class="nav nav-treeview">';}?>
            
           <?php 
            $q =$this->db->query("SELECT a.* FROM tbl_menu AS a LEFT JOIN tbl_akses_menu AS b ON b.id_menu = a.id_menu where status_menu = '2' AND parent_id = '$menu->id_menu' AND b.id_user = '$id_user' AND b.view_level = 'Y' ORDER BY urutan ASC")->result();

            foreach ($q as $submenu1) { ?>
              <li class="nav-item">
                <a href="<?=base_url().$menu->link?>/<?=$submenu1->link?>" class="nav-link <?php if($this->uri->segment(2) == $submenu1->link){echo 'active';}?>" >
                  <i class="<?=$submenu1->icon?> nav-icon"></i>
                  <p><?=$submenu1->nama_menu?> <?php $q3 = $this->db->query("SELECT a.* FROM tbl_menu AS a LEFT JOIN tbl_akses_menu AS b ON b.id_menu = a.id_menu where parent_id = '$submenu1->id_menu' AND status_menu = '3' AND b.id_user = '$id_user' AND b.view_level = 'Y' ")->num_rows(); if($q3 > 0 ){echo '<i class="right fas fa-angle-left"></i>';}?></p>
                </a>
                <input type="hidden" class="GetIdMenu" value="<?php if($this->uri->segment(2) == $submenu1->link){echo $submenu1->id_menu;}?>">
                <?php if($q3 > 0 ){echo '<ul class="nav nav-treeview">';}?>

                  <?php 
                  $q2 = $this->db->query("SELECT a.* FROM tbl_menu AS a LEFT JOIN tbl_akses_menu AS b ON b.id_menu = a.id_menu where status_menu = '3' AND parent_id = '$submenu1->id_menu' AND b.id_user = '$id_user' AND b.view_level = 'Y' ORDER BY urutan ASC")->result();
                  foreach ($q2 as $submenu2) { ?>
                   <li class="nav-item">
                    <a href="<?=base_url().$menu->link?>/<?=$submenu1->link?>/<?=$submenu2->link?>" class="nav-link <?php if($this->uri->segment(3) == $submenu2->link){echo 'active';}?>" >
                      <i class="<?=$submenu2->icon?> nav-icon"></i>
                      <p><?=$submenu2->nama_menu?></p>
                    </a>
                    <input type="hidden" class="GetIdMenu" value="<?php if($this->uri->segment(3) == $submenu2->link){echo $submenu2->id_menu;}?>">
                  </li>
                  <?php } ?>
                <?php if($q3 > 0 ){echo '</ul>';}?>
              </li>
          <?php } ?> 
          <?php if($q_menu1 > 0){echo '</ul>';}?>
    </li>
      <?php } ?>
     
          
            <li class="nav-item">
              <a href="<?=base_url('webcontrol/logout')?>" class="nav-link">
              <i class="nav-icon fas  fa-sign-out-alt text-bold"></i>
                <p>Sign out</p>
              </a>
            </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <script>
    //  var id_menu = document.getElementById('id_menu').value;
     var id_me = document.getElementsByClassName('GetIdMenu');
     var name = '';
     for (let i = 0; i < id_me.length; i++) {
        if (id_me[i].value != "") {
          name = id_me[i].value;
        }
     }
     localStorage.setItem('GetMenu', name);
  </script>