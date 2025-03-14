<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h4>Siswa Sakit</h4>
		</div>
		<div class="section-body">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h4>Data Siswa Sakit</h4>
						</div>
						<div class="card-body">
							<table class="table table-striped" id="table-2">
								<thead>
									<tr>
										<th>Tanggal</th>
										<th>NISN</th>
										<th>Nama</th>
										<th>Kelas</th>
										<th>Alamat</th>
										<th>Diagnosa</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										foreach ($data as $value) {
									 ?>
									<tr>
										<td><?= $value->tgl_sakit ?></td>
										<td><?= $value->nis ?></td>
										<td><?= $value->nama ?></td>
										<td><?= $value->kelas ?></td>
										<td><?= $value->alamat ?></td>
										<td><?= $value->diagnosa ?></td>
									</tr>
								<?php } ?>
								</tbody>
							</table>
							<div class="col-4">
								<div class="text-left">
									<?= anchor(base_url('admin/laporan/') . date('Y-m-d') , '<button class="btn btn-primary"><i class="fa fa-print">&nbsp;Cetak Laporan Harian</i></button>')?>
								</div>
								<br>
								<div class="text-left">
									<form action="<?= base_url('admin/laporanbulanan') ?>" method="post">
										<div class="form-group">
											<select name="bulan" class="form-control" required="">
												<option disabled="" selected="">Pilih Bulan</option>
												<option value="01">Januari</option>
												<option value="02">Februari</option>
												<option value="03">Maret</option>
												<option value="04">April</option>
												<option value="05">Mei</option>
												<option value="06">Juni</option>
												<option value="07">Juli</option>
												<option value="08">Agustus</option>
												<option value="09">September</option>
												<option value="10">Oktober</option>
												<option value="11">November</option>
												<option value="12">Desember</option>
											</select>
										</div>
										<div class="form-group">
											<button class="btn btn-success fa fa-print"> Cetak Laporan</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>