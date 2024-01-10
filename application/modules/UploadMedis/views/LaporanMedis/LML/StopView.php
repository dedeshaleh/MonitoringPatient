<html>
  <head>
  <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url()?>assets/foto/logo/logo_beth1.png" />
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
  </head>
    <style>
      body {
        text-align: center;
        padding: 40px 0;
        background: #EBF0F5;
      }
        h1 {
          color: <?php if($header->Position_Status == 3){echo '#88B04B';}else if($header->Position_Status == 6){echo '#88B04B';}else{echo '#fc3d3d';}?>;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-weight: 900;
          font-size: 40px;
          margin-bottom: 10px;
        }
        p {
          color: <?php if($header->Position_Status == 3){echo '#404F5E';}else if($header->Position_Status == 6){echo '#404F5E';}else{echo '#fc3d3d';}?>;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-size:20px;
          margin: 0;
        }
      i {
        color: <?php  if($header->Position_Status == 3){echo '#9ABC66';}else if($header->Position_Status == 6){echo '#9ABC66';}else{echo '#fc3d3d';}?>;
        font-size: 100px;
        line-height: 200px;
        margin-left:-15px;
      }
      .card {
        background: white;
        padding: 60px;
        border-radius: 4px;
        box-shadow: 0 2px 3px #C8D0D8;
        display: inline-block;
        margin: 0 auto;
      }

	  /* Gaya tombol dasar */
		.my-button {
		display: inline-block;
		padding: 10px 20px;
		background-color: #4CAF50;
		color: white;
		border: none;
		text-align: center;
		text-decoration: none;
		font-size: 16px;
		cursor: pointer;
		}

		/* Efek hover ketika kursor berada di atas tombol */
		.my-button:hover {
		background-color: #45a049;
		}

		/* Efek ketika tombol ditekan */
		.my-button:active {
		background-color: #3e8e41;
		}
    </style>
    <body>
	



      <div class="card">
      <div style="border-radius:200px; height:200px; width:200px; background: <?php if($header->Position_Status == 3){echo '#F8FAF5';}else if($header->Position_Status == 6){echo '#F8FAF5';}else{echo '#fc3d3d';}?>; margin:0 auto;">
      

    <?php if ($header->Position_Status == 3) { ?>
      <i class="checkmark">✓</i>
		</div>
    <h1>Konfirmasi</h1> 
        <p>Proses Telah Di Konfirmasi Oleh Casemix, Terima Kasih</p>
      </div>
    <?php } if( $header->Position_Status == 6 ) { ?>
      <i class="checkmark">✓</i>
		</div>
    <h1>Konfirmasi</h1> 
        <p>Proses Telah Diterima Oleh Kasir, Terima Kasih</p>
      </div>
     <?php } else{ ?>
      <i class="checkmark">X</i>
		</div>
    <h1>Prosessing</h1> 
        <p>Anda Sudah Melakukan Proses Ini Mohon Tunggu Casemix Konfirmasi, Terima Kasih</p>
      </div>
    <?php } ?>
        
    </body>
</html>