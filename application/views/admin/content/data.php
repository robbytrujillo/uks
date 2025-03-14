<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Data Hasil Import</title>
	</head>
	<style media="screen">
		table {
			border: 1px solid #ddd;
			border-collapse: collapse;
		}
		th {
			text-align: left;
		}
		th, td {
			border: 1px solid #ddd;
			padding: 10px;
		}
	</style>
	<body>
		<a href="<?php echo site_url('import'); ?>">Import Data</a>
		<br>
		<h2>Data Hasil Import</h2>
		<table>
			<thead>
				<tr>
					<th>No.</th>
					<th width="200px">NIS</th>
					<th width="140px">Nama</th>
					<th width="180px">Jenis Kelamin</th>
					<th width="250px">Alamat</th>
					<th width="250px">Kelas</th>
					<th width="250px">Angkatan</th>
				</tr>
			</thead>
			<tbody>
				<?php if ( ! empty($siswa)) { ?>
					<?php
						$no = 0;
						foreach ($siswa as $data) {
						$no++;
					?>
						<tr>
							<td><?php echo $no; ?></td>
							<td><?php echo $data['nis']; ?></td>
							<td><?php echo $data['nama']; ?></td>
							<td><?php echo $data['jk']; ?></td>
							<td><?php echo $data['alamat']; ?></td>
							<td><?php echo $data['kelas']; ?></td>
							<td><?php echo $data['angkatan']; ?></td>
						</tr>
					<?php } ?>
				<?php } else {?>
					<tr>
						<td colspan="5">Tidak ada data!</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</body>
</html>