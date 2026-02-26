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
                                    <input type="text" disabled name="nama" class="form-control text-dark"
                                        value="<?= $data->nama  ?>">
                                </div>
                                <div class="form-group">
                                    <label>Kelas</label>
                                    <input type="text" disabled name="kelas" class="form-control text-dark"
                                        value="<?= $data->kelas  ?>">
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" name="alamat" disabled class="form-control text-dark"
                                        value="<?= $data->alamat  ?>">
                                </div>
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="datetime-local" class="form-control" name="tgl_sakit" id="tgl_sakit"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label>Tekanan Darah</label>
                                    <input type="text" class="form-control" name="tekanan_darah"></input>
                                </div>
                                <div class="form-group">
                                    <label>Suhu</label>
                                    <input type="text" class="form-control" name="suhu"></input>
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
                                    <label>Petugas UKS</label>
                                    <select name="id_petugas" class="form-control" required>
                                        <option value="">-- Pilih Petugas --</option>
                                        <?php foreach ($petugas as $p): ?>
                                        <option value="<?= $p->id ?>">
                                            <?= $p->nama_petugas ?> - <?= $p->jabatan ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button class="form-control btn btn-primary"
                                        style="border-radius: 30px;">Simpan</button>
                                </div>
                                <?php } ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        let now = new Date();

        let year = now.getFullYear();
        let month = String(now.getMonth() + 1).padStart(2, '0');
        let day = String(now.getDate()).padStart(2, '0');
        let hours = String(now.getHours()).padStart(2, '0');
        let minutes = String(now.getMinutes()).padStart(2, '0');

        let formatted = `${year}-${month}-${day}T${hours}:${minutes}`;

        document.getElementById("tgl_sakit").value = formatted;
    });
    </script>

</div>