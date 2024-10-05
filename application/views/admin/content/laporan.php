<style>
	@media print {
		.print{
			display: none;
		}
	}
</style>

<div class="container">
	<div class="text-center">
		<div class="title text-center">
			<br>
			<h1 align="center" style="color: black;"><img src="../../image/1.png" style="height: 50px; padding-bottom: 10px;"> UKS IHBS </h1>
			<p align="center" style="color: black;"> Jl. Raya xxx, xxxx, xxxx, xxxx., Kxxxx, xxxxx 1xxxx</p>
			<hr>
		</div>
		<br>
		<h5>Laporan Harian Siswa Sakit</h5>

		<table class="table table-bordered table-md">
			<thead>
				<tr>
					<th>Tanggal</th>
					<th>NIS</th>
					<th>Nama</th>
					<th>Rombel</th>
					<th>Rayon</th>
					<th>Keterangan Sakit</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($data as $value){ ?>
					<tr>
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
			<a class="print btn btn-danger" href="<?= base_url('admin/report') ?>">KEMBALI</a>
			</div>
			
		
	</div>
</div>