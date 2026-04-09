<div class="main-content">
    <section class="section">

        <div class="section-header text-center">
            <h4>Data Siswa</h4>
        </div>

        <div class="section-body">

            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5 col-12">

                    <div class="card shadow-sm">
                        <div class="card-header text-center">
                            <h5>Simpan Data</h5>
                        </div>

                        <div class="card-body">

                            <form action="<?= base_url('siswa/store') ?>" method="post">

                                <div class="form-group">
                                    <label>NIS</label>
                                    <input type="text" name="nis" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" name="nama" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select name="jk" class="form-control">
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea name="alamat" class="form-control"></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Kelas</label>
                                    <input type="text" name="kelas" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Angkatan</label>
                                    <input type="text" name="angkatan" class="form-control">
                                </div>


                                <div>
                                    <button class="btn btn-primary px-4" style="border-radius: 30px;">Simpan</button>
                                </div>

                            </form>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
</div>