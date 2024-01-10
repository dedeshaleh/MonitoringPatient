<?php 

$apl = $this->db->get("aplikasi")->row();
?>
  <footer class="main-footer">
    <strong>Copyright &copy; <?=$apl->tahun?> <?=$apl->copy_right?>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> <?=$apl->versi?>
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- <a href="https://adminlte.io">AdminLTE.io</a> -->
<!-- Thanks To AdminLte -->

</body>
</html>
