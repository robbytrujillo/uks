<div class="main-content">
	<div class="section">
		<div class="section-header">
			<h4>Form Import</h4>
<html>
<head>
	
	<!-- Load File jquery.min.js yang ada difolder js -->
	<script src="<?php echo base_url('js/jquery.min.js'); ?>"></script>
	
	<script>
	$(document).ready(function(){
		// Sembunyikan alert validasi kosong
		$("#kosong").hide();
	});
	</script>
</head>
<body>
		</div>
		<div class="section-body">
	
	<a href="<?php echo base_url("csv/format.csv"); ?>" class="btn btn-primary">Download Format</a>
	<br>
	<br>
	
	<!-- Buat sebuah tag form dan arahkan action nya ke controller ini lagi -->
	<form method="post" action="<?php echo base_url("index.php/Siswa/form"); ?>" enctype="multipart/form-data">

		<!-- 
		-- Buat sebuah input type file
		-- class pull-left berfungsi agar file input berada di sebelah kiri
		-->
		<input type="file" name="file" class="form-control ">
		
		<!--
		-- BUat sebuah tombol submit untuk melakukan preview terlebih dahulu data yang akan di import
		-->
		<br>	

		<input type="submit" name="preview" value="Preview" class="btn btn-info">
		<br>	
		<br>	
		
	</form>
	
	<?php
	if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form 
		if(isset($upload_error)){ // Jika proses upload gagal
			echo "<div style='color: red;'>".$upload_error."</div>"; // Muncul pesan error upload
			die; // stop skrip
		}
		
		// Buat sebuah tag form untuk proses import data ke database
		echo "<form method='post' action='".base_url("index.php/Siswa/import")."'>";
		
		// Buat sebuah div untuk alert validasi kosong
		// echo "<div style='color: red;' id='kosong'>
		// Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum terisi semua.
		// </div>";
		
		echo "<table border='1' cellpadding='8' class='table table-hovered table-striped table-bordered' id='table-1'>
		<thead>
		<tr>
			<th colspan='6'>Preview Data</th>
		</tr>
		<tr>
			<th>NISN</th>
			<th>Nama</th>
			<th width='15px'>Jenis Kelamin</th>
			<th>Rayon</th>
			<th>Rombel</th>
			<th>Kelas</th>
		</tr>
		</thead>"
		;
		echo "<tbody>";
		
		$numrow = 1;
		$kosong = 0;
		
		// Lakukan perulangan dari data yang ada di csv
		// $sheet adalah variabel yang dikirim dari controller
		foreach($sheet as $row){ 
			// START -->
			// Skrip untuk mengambil value nya
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
			
			$get = array(); // Valuenya akan di simpan kedalam array,dimulai dari index ke 0
			foreach ($cellIterator as $cell) {
				array_push($get, $cell->getValue()); // Menambahkan value ke variabel array $get
			}
			// <-- END
			
			// Ambil data value yang telah di ambil dan dimasukkan ke variabel $get
			$nis = $get[0]; // Ambil data NIS
			$nama = $get[1]; // Ambil data nama
			$jk = $get[2]; // Ambil data jenis kelamin
			$rayon = $get[3]; // Ambil data alamat
			$rombel = $get[4];
			$kelas = $get[5];
			
			// Cek jika semua data tidak diisi
			if(empty($nis) && empty($nama) && empty($jk) && empty($rayon) && empty($rombel) && empty($kelas))
				continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
			
			// Cek $numrow apakah lebih dari 1
			// Artinya karena baris pertama adalah nama-nama kolom
			// Jadi dilewat saja, tidak usah diimport
			if($numrow > 1){
				// Validasi apakah semua data telah diisi
				$nis_td = ( ! empty($nis))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
				$nama_td = ( ! empty($nama))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
				$jk_td = ( ! empty($jk))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
				$rayon_td = ( ! empty($rayon))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
				$rombel_td = ( ! empty($rombel))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
				$kelas_td = ( ! empty($kelas))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
				
				// Jika salah satu data ada yang kosong
				if(empty($nis) or empty($nama) or empty($jk) or empty($rayon) or empty($rombel) or empty($kelas)){
					$kosong++; // Tambah 1 variabel $kosong
				}
				
				echo "<tr>";
				echo "<td".$nis_td.">".$nis."</td>";
				echo "<td".$nama_td.">".$nama."</td>";
				echo "<td".$jk_td.">".$jk."</td>";
				echo "<td".$rayon_td.">".$rayon."</td>";
				echo "<td".$rombel_td.">".$rombel."</td>";
				echo "<td".$kelas_td.">".$kelas."</td>";
				echo "</tr>";
			}
			
			$numrow++; // Tambah 1 setiap kali looping
		}
		echo "</tbody>";
		echo "</table>";
		
		// Cek apakah variabel kosong lebih dari 0
		// Jika lebih dari 0, berarti ada data yang masih kosong
		if($kosong > 0){
		?>	
			<script>
			$(document).ready(function(){
				// Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
				$("#jumlah_kosong").html('<?php echo $kosong; ?>');
				
				$("#kosong").show(); // Munculkan alert validasi kosong
			});
			</script>
		<?php
		}else{ // Jika semua data sudah diisi
			echo "<hr>";
			
			// Buat sebuah tombol untuk mengimport data ke database
			echo "<button type='submit' name='import' class='btn btn-success'>Import</button> ";
			echo "<a href='".base_url("index.php/Siswa")."' class='btn btn-danger'>Cancel</a>";
		}
		
		echo "</form>";
	}
	?>
	<br>	
	<br>	
</body>
</html>
		</div>
	</div>
</div>
