<div class="main-content">
    <section class="section">

        <div class="section-header text-center">
            <h4>Edit Data Siswa</h4>
        </div>

        <div class="section-body">

            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5 col-12">

                    <div class="card shadow-sm">
                        <div class="card-header text-center">
                            <h5>Ubah Data</h5>
                        </div>

                        <div class="card-body">

                            <form action="<?= base_url('siswa/update') ?>" method="post">

                                <!-- NIS -->
                                <div class="form-group">
                                    <label>NIS</label>
                                    <input type="text" name="nis" class="form-control" value="<?= $siswa->nis ?>"
                                        readonly>
                                </div>

                                <!-- Nama -->
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" name="nama" class="form-control" value="<?= $siswa->nama ?>"
                                        required>
                                </div>

                                <!-- Jenis Kelamin -->
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select name="jk" class="form-control">
                                        <option value="L" <?= ($siswa->jk == 'L') ? 'selected' : '' ?>>
                                            Laki-laki
                                        </option>
                                        <option value="P" <?= ($siswa->jk == 'P') ? 'selected' : '' ?>>
                                            Perempuan
                                        </option>
                                    </select>
                                </div>

                                <!-- Alamat -->
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea name="alamat" class="form-control"><?= $siswa->alamat ?></textarea>
                                </div>

                                <!-- Kelas -->
                                <div class="form-group">
                                    <label>Kelas</label>
                                    <input type="text" name="kelas" class="form-control" value="<?= $siswa->kelas ?>">
                                </div>

                                <!-- Angkatan -->
                                <div class="form-group">
                                    <label>Angkatan</label>
                                    <input type="text" name="angkatan" class="form-control"
                                        value="<?= $siswa->angkatan ?>">
                                </div>

                                <!-- Button -->
                                <div class="text-center mt-3">
                                    <button class="btn btn-warning px-4" style="border-radius: 30px;">
                                        Update
                                    </button>
                                    <a href="<?= base_url('siswa') ?>" class="btn btn-secondary px-4"
                                        style="border-radius: 30px;">
                                        Kembali
                                    </a>
                                </div>

                            </form>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
</div>