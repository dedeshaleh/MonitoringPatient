<html>
  <head>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
  </head>
    <style>
      body {
        text-align: center;
        padding: 40px 0;
        background: #EBF0F5;
      }
        h1 {
          color: <?php if($Status == 0){echo '#fc3d3d';}else if($Status == 1){echo '#88B04B';}?>;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-weight: 900;
          font-size: 40px;
          margin-bottom: 10px;
        }
        p {
          color: <?php if($Status == 0){echo '#fc3d3d';}else if($Status == 1){echo '#404F5E';}?>;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-size:20px;
          margin: 0;
        }
      i {
        color: <?php if($Status == 0){echo '#fff';}else if($Status == 1){echo '#9ABC66';}?> ;
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
      <div style="border-radius:200px; height:200px; width:200px; background: <?php if($Status == 0){echo '#fc3d3d';}else if($Status == 1){echo '#F8FAF5';}?>; margin:0 auto;">
	  <?php if ($Status == 0) { ?>

		<i class="checkmark">X</i>
		</div>
        <h1>Gagal</h1> 
        <p><?=$this->session->flashdata('msg');?></p>
		<br>
		<a class="my-button" href="<?=$LinkBack?>">Klik Disini Untuk ReUpload..</a>

		<?php }else if ($Status == 1){ ?>

			<i class="checkmark">✓</i>
			</div>
			<h1>Berhasil</h1> 
			<p><?=$this->session->flashdata('msg');?></p>
			<button type="button" class="my-button" onclick="closePage();">Tutup Halaman</button>
			
			<?php }?>

			<script>
				function closePage() {
				// Menutup halaman menggunakan window.close()
				window.open('', '_self', '');
window.close();
				}
			</script>
    </body>
</html>