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
							<h4>Simpan Data</h4>
						</div>
						<div class="card-body">	
							<?php 
									foreach ($siswa as $data) {
								?>
							<form action="<?= base_url('admin/add/') . $data->nis ?>" method="post">
								<div class="form-group">
									<label>Nama</label>
									<input type="text" disabled name="nama"  class="form-control text-dark" value="<?= $data->nama  ?>">
								</div>
								<div class="form-group">
									<label>Rombel Kelas</label>
									<input type="text" disabled name="rombel"  class="form-control text-dark" value="<?= $data->rombel  ?>">
								</div>
								<div class="form-group">
									<label>Asal</label>
									<input type="text" name="rayon" disabled  class="form-control text-dark" value="<?= $data->rayon  ?>">
								</div>
								<div class="form-group">
									<label>Tanggal</label>
									<input type="date" class="form-control" name="tgl_sakit" autofocus required></input>
								</div>
								<div class="form-group">
									<label>Tekanan Darah</label>
									<input type="text" class="form-control" name="tekanan_darah" ></input>
								</div>
								<div class="form-group">
									<label>Suhu</label>
									<input type="text" class="form-control" name="suhu" ></input>
								</div>
								<div class="form-group">
									<label>Keluhan</label>
									<textarea class="form-control" name="keluhan" rows="2"></textarea>
								</div>
								<div class="form-group">
									<label>Diagnosa</label>
									<textarea class="form-control" name="diagnosa" rows="2"></textarea>
								</div>
								<div class="form-group">
									<label>Penanganan</label>
									<textarea class="form-control" name="penanganan" rows="2"></textarea>
								</div>
								<div class="form-group">	
									<button class="form-control btn btn-primary">Simpan</button>
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