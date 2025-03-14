<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h4>Data Siswa</h4>
		</div>
		<div class="section-body">
			<div class="row">	
				<div class="col-6">
						<div class="card">	
							<div class="card-header">
							<h4>Update Data</h4>
						</div>
						<div class="card-body">	
							<?php 
									foreach ($sakit as $data) {
								?>
							<form action="<?= base_url('admin/update/') . $data->id_sakit ?>" method="post">
								<div class="form-group">
									<label>Nama</label>
									<input type="text" name="nama" disabled class="form-control text-dark" value="<?= $data->nama  ?>">
								</div>
								<div class="form-group">
									<label>Kelas</label>
									<input type="text" name="kelas" disabled  class="form-control text-dark" value="<?= $data->rombel  ?>">
								</div>
								<div class="form-group">
									<label>Alamat</label>
									<input type="text" name="alamat" disabled  class="form-control text-dark" value="<?= $data->rayon  ?>">
								</div>
								<div class="form-group">
									<label>Tanggal</label>
									<input type="date" name="tgl_sakit" class="form-control text-dark" value="<?= $data->tgl_sakit  ?>">
								</div>
								<div class="form-group">
									<label>Tekanan Darah</label>
									<input type="text" name="tekanan_darah" class="form-control text-dark" value="<?= $data->tekanan_darah  ?>">
								</div>
								<div class="form-group">
									<label>Suhu</label>
									<input type="text" name="suhu" class="form-control text-dark" value="<?= $data->suhu  ?>">
								</div>
								<div class="form-group">
									<label>Keluhan</label>
									<textarea class="form-control" name="keluhan" rows="2"  autofocus ><?= $data->keluhan ?></textarea>
								</div>
								<div class="form-group">
									<label>Diagnosa</label>
									<textarea class="form-control" name="diagnosa" rows="2"  autofocus ><?= $data->diagnosa ?></textarea>
								</div>
								<div class="form-group">
									<label>Penanganan</label>
									<textarea class="form-control" name="penanganan" rows="2"  autofocus ><?= $data->penanganan ?></textarea>
								</div>
								<div class="row">
									<div class="col-6">	
										<button class="btn btn-primary form-control">UPDATE</button>
										<br>
										<br>
										<a href="<?= base_url('admin/siswa') ?>" class="btn-danger form-control" style="text-decoration: none; text-align: center; margin-left: 260px; margin-top: -60px;">KEMBALI</a>
									</div>

								</div>
								<?php } ?>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>