<?php
	//Koneksi Database
	include ("config.php");

	//jika tombol simpan diklik
	if(isset($_POST['bsimpan']))
	{
		//Pengujian Apakah data akan diedit atau disimpan baru
		if($_GET['hal'] == "edit")
		{
			//Data akan di edit
			$edit = mysqli_query($koneksi, "UPDATE jenisobat set
											 	nama_jenisobat = '$_POST[nama]',
												dosis_jenisobat = '$_POST[dosis]'
											 WHERE id_jenisobat = '$_GET[id]'
										   ");
			if($edit) //jika edit sukses
			{
				echo "<script>
						alert('Edit data suksess!');
						document.location='jenisobat.php';
				     </script>";
			}
			else
			{
				echo "<script>
						alert('Edit data GAGAL!!');
						document.location='jenisobat.php';
				     </script>";
			}
		}
		else
		{
			//Data akan disimpan Baru
			$simpan = mysqli_query($koneksi, "INSERT INTO jenisobat (nama_jenisobat, dosis_jenisobat)
										  VALUES ('$_POST[nama]', 
										  		 '$_POST[dosis]')
										 ");
			if($simpan) //jika simpan sukses
			{
				echo "<script>
						alert('Simpan data suksess!');
						document.location='jenisobat.php';
				     </script>";
			}
			else
			{
				echo "<script>
						alert('Simpan data GAGAL!!');
						document.location='jenisobat.php';
				     </script>";
			}
		}


		
	}


	//Pengujian jika tombol Edit / Hapus di klik
	if(isset($_GET['hal']))
	{
		//Pengujian jika edit Data
		if($_GET['hal'] == "edit")
		{
			//Tampilkan Data yang akan diedit
			$tampil = mysqli_query($koneksi, "SELECT * FROM jenisobat WHERE id_jenisobat = '$_GET[id]' ");
			$data = mysqli_fetch_array($tampil);
			if($data)
			{
				//Jika data ditemukan, maka data ditampung ke dalam variabel
				$vnama = $data['nama_jenisobat'];
				$valamat = $data['dosis_jenisobat'];;
			}
		}
		else if ($_GET['hal'] == "hapus")
		{
			//Persiapan hapus data
			$hapus = mysqli_query($koneksi, "DELETE FROM jenisobat WHERE id_jenisobat = '$_GET[id]' ");
			if($hapus){
				echo "<script>
						alert('Hapus Data Suksess!!');
						document.location='jenisobat.php';
				     </script>";
			}
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>CRUD 2020 PHP & MySQL + Bootstrap 4</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
<div class="container">
<button type="button" class="btn btn-success" value="kembali" onclick="history.back(-1)" ="bback">back</button>

	<!-- Awal Card Form -->
	<div class="card mt-3">
	  <div class="card-header bg-primary text-white">
	    Form Input Jenis Obat
	  </div>
	  <div class="card-body">
	    <form method="post" action="">
	    	<div class="form-group">
	    		<label>Nama Jenis Obat</label>
	    		<input type="text" name="nama" value="<?=@$vnama_jenisobat?>" class="form-control" placeholder="Input Nama jenis obat" required>
	    	</div>
	    	<div class="form-group">
	    		<label>Dosis Jenis Obat</label>
	    		<input type="text" name="dosis" value="<?=@$vdosis_jenisobat?>" class="form-control" placeholder="Input Dosis" required>
	    	</div>

	    	<button type="submit" class="btn btn-success" name="bsimpan">Simpan</button>
	    	<button type="reset" class="btn btn-danger" name="breset">Kosongkan</button>

	    </form>
	  </div>
	</div>
	<!-- Akhir Card Form -->

	<!-- Awal Card Tabel -->
	<div class="card mt-3">
	  <div class="card-header bg-success text-white">
	    Daftar Jenis Obat
	  </div>
	  <div class="card-body">
	    
	    <table class="table table-bordered table-striped">
	    	<tr>
	    		<th>No.</th>
	    		<th>Nama jenis obat</th>
	    		<th>dosis jenis obat</th>
	    		<th>Aksi</th>
	    	</tr>
	    	<?php
	    		$no = 1;
	    		$tampil = mysqli_query($koneksi, "SELECT * from jenisobat order by id_jenisobat desc");
	    		while($data = mysqli_fetch_array($tampil)) :

	    	?>
	    	<tr>
	    		<td><?=$no++;?></td>
	    		<td><?=$data['nama_jenisobat']?></td>
	    		<td><?=$data['dosis_jenisobat']?></td>
	    		<td>
	    			<a href="jenisobat.php?hal=edit&id=<?=$data['id_jenisobat']?>" class="btn btn-warning"> Edit </a>
	    			<a href="jenisobat.php?hal=hapus&id=<?=$data['id_jenisobat']?>" 
	    			   onclick="return confirm('Apakah yakin ingin menghapus data ini?')" class="btn btn-danger"> Hapus </a>
	    		</td>
	    	</tr>
	    <?php endwhile; //penutup perulangan while ?>
	    </table>

	  </div>
	</div>
	<!-- Akhir Card Tabel -->

</div>

<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>