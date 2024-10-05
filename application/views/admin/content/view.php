<div class="container-fluid">
<div class="main-content">
	<div class="section">
		<div class="section-header">
<body>
	
	<h1>Data Siswa</h1>

		</div>
	<div class="section-body">
		<a href="<?php echo base_url("index.php/Siswa/form"); ?>" class="btn btn-primary ml-2">Import Data</a>
		<br>	
		<br>

	<table id="table-1" class="table table-striped table-hovered table-bordered">
	<thead>	
			<tr>
				<th>NIS</th>
				<th>Nama</th>
				<th>Jenis Kelamin</th>
				<th>Rayon</th>
				<th>Rombel</th>
				<th>Kelas</th>
			</tr>
	</thead>
	<tbody>	

	<?php
	if( ! empty($siswa)){ // Jika data pada database tidak sama dengan empty (alias ada datanya)
		foreach($siswa as $data){ // Lakukan looping pada variabel siswa dari controller
			echo "<tr>";
			echo "<td>".$data->nis."</td>";
			echo "<td>".$data->nama."</td>";
			echo "<td>".$data->jk."</td>";
			echo "<td>".$data->rayon."</td>";
			echo "<td>".$data->rombel."</td>";
			echo "<td>".$data->kelas."</td>";
			echo "</tr>";
		}
	}else{ // Jika data tidak ada
		echo "<tr><td colspan='6'><center>Data tidak ada</center></td></tr>";
	}
	?>
	</tbody>
	</table>
</body>
		</div>
	</div>
</div>
</div>