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
          <div class="card-header">
            <label for="">Detail Pasien </label>
          </div>
          <div class="card-body">
            <table>
              <tr>
                <td>Nama Pasien</td>
                <td>:</td>
                <td id="NamaPasien"></td>
              </tr>
              <tr>
                <td>Tanggal Lahir</td>
                <td>:</td>
                <td id="tglLahir"></td>
              </tr>
             
            </table>
          </div>
        </div>
  <!-- <label for=""><?=$keyPasien?></label> -->
        <!-- Timelime example  -->
        <div class="row">
          <div class="col-md-12" >
            <div id="GetTimeLine"></div>
          </div>
          <!-- /.col -->
        </div>
      </div>
      <!-- /.timeline -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <script>
    GetDetail()
    function GetDetail() {
      const url = "<?=base_url()?>DataPasien/CekDetailPasien";
    
      fetch(url, {
        method: "POST",
        // body: JSON.stringify(data),
        headers: {
              "Content-Type": "application/json; charset=UTF-8"
            }	
      })
      .then((response) => response.json())
      .then((data) => {
		  
          var html = '';
          html += 
          `
          <!-- The time line -->
            <div class="timeline">
              <div class="time-label">
                <span class="bg-indigo"> <i class='fas fa-map-marker-alt'></i> You Here</span>
              </div>
          `;
          for (let i = 0; i < data.DataDetail.length; i++) {
            if (data.DatePerintahPulang <= data.DataDetail[i].Value) {
              if (data.DataDetail[i].Value == '' || data.DataDetail[i].Value == null) {
                  
                }else{
                html +=
                `
                <!-- timeline time label -->
                  <div class="time-label">
                    <span class="bg-blue">`+data.DataDetail[i].Value+`</span>
                  </div>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <div>
                    <i class="fas fa-check" style="background-color:
                    `;
                    if (data.DataDetail[i].NamaKolom == 'Date_Leave_Room') {
                        html += '#5cffd9'
                      }
                      if (data.DataDetail[i].NamaKolom == 'Date_Invoice') {
                        html += '#11fac4'
                      }
                      if (data.DataDetail[i].NamaKolom == 'Date_Terima_Jaminan') {
                        html += '#11c8fa'
                      }
                      if (data.DataDetail[i].NamaKolom == 'Date_Kirim_Jaminan') {
                        html += '#077df2'
                      }
                      if (data.DataDetail[i].NamaKolom == 'Date_Discharge') {
                        html += '#8b43f7'
                      }
                      if (data.DataDetail[i].NamaKolom == 'Date_Perintah_Pulang') {
                        html += '#660af0'
                      }
                      if (data.DataDetail[i].NamaKolom == 'Date_Confrm_Retur_Presc') {
                        html += '#ca16f7'
                      }
                      if (data.DataDetail[i].NamaKolom == 'Date_Last_Retur_Presc') {
                        html += '#db0fb3'
                      }
                      if (data.DataDetail[i].NamaKolom == 'Date_Last_Confrm_Presc') {
                        html += '#e61755'
                      }
                      if (data.DataDetail[i].NamaKolom == 'Date_Last_Order_Presc') {
                        html += '#f08935'
                      }
                      if (data.DataDetail[i].NamaKolom == 'Last_Terima_EKTM_Obat') {
                        html += '#defa61'
                      }
                      if (data.DataDetail[i].NamaKolom == 'Last_Order_EKTM_Obat') {
                        html += '#3efa48'
                      }
                    html+=`
                    ;"></i>
                    <div class="timeline-item">
                      <!-- <span class="time"><i class="fas fa-clock"></i> 12:05</span> -->
                      <h3 class="timeline-header">`;
                      if (data.DataDetail[i].NamaKolom == 'Date_Leave_Room') {
                        html += 'Tanggal Keluar Ruangan'
                      }
                      if (data.DataDetail[i].NamaKolom == 'Date_Invoice') {
                        html += 'Tanggal Invoice'
                      }
                      if (data.DataDetail[i].NamaKolom == 'Date_Terima_Jaminan') {
                        html += 'Tanggal Terima Jaminan'
                      }
                      if (data.DataDetail[i].NamaKolom == 'Date_Kirim_Jaminan') {
                        html += 'Tanggal Pengiriman Jaminan'
                      }
                      if (data.DataDetail[i].NamaKolom == 'Date_Discharge') {
                        html += 'Tanggal Discharge'
                      }
                      if (data.DataDetail[i].NamaKolom == 'Date_Perintah_Pulang') {
                        html += 'Tanggal Perintah Pulang'
                      }
                      if (data.DataDetail[i].NamaKolom == 'Date_Confrm_Retur_Presc') {
                        html += 'Tanggal Retur Resep'
                      }
                      if (data.DataDetail[i].NamaKolom == 'Date_Last_Retur_Presc') {
                        html += 'Tanggal Terakhir Retur Resep'
                      }
                      if (data.DataDetail[i].NamaKolom == 'Date_Last_Confrm_Presc') {
                        html += 'Tanggal Konfirmasi Resep'
                      }
                      if (data.DataDetail[i].NamaKolom == 'Date_Last_Order_Presc') {
                        html += 'Tanggal Pemesanan Resep Terakhir'
                      }
                      if (data.DataDetail[i].NamaKolom == 'Last_Terima_EKTM_Obat') {
                        html += 'Tanggal Terima EKTM Obat'
                      }
                      if (data.DataDetail[i].NamaKolom == 'Last_Order_EKTM_Obat') {
                        html += 'Tanggal Order Terakhir EKTM Obat'
                      }


                      
                      html+=
                      `
                      </h3>
                      <!-- 
                      <div class="timeline-body">
                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                        quora plaxo ideeli hulu weebly balihoo...
                      </div>
                      -->
                      <!-- <div class="timeline-footer">
                        <a class="btn btn-primary btn-sm">Read more</a>
                        <a class="btn btn-danger btn-sm">Delete</a>
                      </div> -->
                    </div>
                  </div>
                  <!-- END timeline item -->
                `;
              }
            }

        }
          html +=
            `
              <div>
                <i class='fas fa-map-marker-alt'></i> 
              </div>
              
            </div>
            `;
          document.getElementById('GetTimeLine').innerHTML = html


          document.getElementById('NamaPasien').innerHTML = data.DataPasien.Patient_Name
          d = new Date(data.DataPasien.DOB)
          document.getElementById('tglLahir').innerHTML = d.getDate()+'/'+(d.getMonth()+1)+'/'+d.getFullYear() ;
      })
    }
  </script>