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
									<label>Rombel</label>
									<input type="text" name="rombel" disabled  class="form-control text-dark" value="<?= $data->rombel  ?>">
								</div>
								<div class="form-group">
									<label>Rayon</label>
									<input type="text" name="rayon" disabled  class="form-control text-dark" value="<?= $data->rayon  ?>">
								</div>
								<div class="form-group">
									<label>Keterangan Sakit</label>
									<textarea class="form-control" name="ket" rows="2"  autofocus ><?= $data->keterangan ?></textarea>
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