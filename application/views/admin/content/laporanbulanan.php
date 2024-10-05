<div class="container">
	<style>
		@media print {
		.print{
			display: none;
		}
	}
	</style>
	<div class="text-center">
		<br>
			<h1 align="center" style="color: black;"><img src="../image/1.png" style="height: 50px; padding-bottom: 10px;"> UKS UKS SEKOLAH</h1>
			<p align="center" style="color: black;"> Jl. Raya xxx, xxxx, xxxx, xxxx., Kxxxx, xxxxx 1xxxx</p>
			<hr>
			<br>
		<h5>Laporan Sakit Bulan <?= $bulan?></h5>

		<table class="table table-bordered table-md">
			<thead>
				<tr>
					<th>No.</th>
					<th>Tanggal</th>
					<th>NIS</th>
					<th>Nama</th>
					<th>Rombel</th>
					<th>Rayon</th>
					<th>Keterangan Sakit</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$no = 1;
				foreach ($data as $value) {
					
				?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $value->tgl_sakit ?></td>
						<td><?= $value->nis ?></td>
						<td><?= $value->nama ?></td>
						<td><?= $value->rombel ?></td>
						<td><?= $value->rayon ?></td>
						<td><?= $value->keterangan ?></td>
					</tr>
				<?php } ?>
				
			</tbody>
		</table>

		<div class="text-right">
			<button class="print btn btn-primary" onclick="window.print()">CETAK</button>
			<a href="<?= base_url('admin/report') ?>" class="print btn btn-danger">KEMBALI</a>
		</div>
	</div>
</div>