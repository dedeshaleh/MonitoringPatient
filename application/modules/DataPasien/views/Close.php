<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Timeline</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Timeline</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">Maaf Akun Anda Sudah ditutup</div>
        </div>
      </div>
      <!-- /.timeline -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <script>
    function GetDetail() {
      const url = "<?=base_url()?>DataPasien/CekDetailPasien";
      const data = {
        Ward_Code: Ward_Code
      }
      fetch(url, {
        method: "POST",
        body: JSON.stringify(data),
        headers: {
              "Content-Type": "application/json; charset=UTF-8"
            }	
      })
      .then((response) => response.json())
      .then((data) => {
        $("#RinciModal").modal('show');
        var html = '';

        for (let i = 0; i < data.length; i++) {
          html+= `
          <tr>
            <td>`+data[i].Description+`</td>
            <td>`+data[i].Room+`</td>
            <td>`+data[i].Room_Type+`</td>
            <td>`+data[i].Class+`</td>
            <td>`+data[i].Status+`</td>
          </tr>
          `
          
        }

        document.getElementById('DetailKamar').innerHTML = html;

      
      })
    }
  </script>