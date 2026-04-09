<div class="container">
    <h3>Ubah Siswa</h3>

    <form action="<?= base_url('Siswa/update') ?>" method="post">
        <input type="hidden" name="nis" value="<?= $siswa->nis ?>">

        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="<?= $siswa->nama ?>">
        </div>

        <div class="form-group">
            <label>Jenis Kelamin</label>
            <select name="jk" class="form-control">
                <option value="L" <?= $siswa->jk == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                <option value="P" <?= $siswa->jk == 'P' ? 'selected' : '' ?>>Perempuan</option>
            </select>
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control"><?= $siswa->alamat ?></textarea>
        </div>

        <div class="form-group">
            <label>Kelas</label>
            <input type="text" name="kelas" class="form-control" value="<?= $siswa->kelas ?>">
        </div>

        <div class="form-group">
            <label>Angkatan</label>
            <input type="text" name="angkatan" class="form-control" value="<?= $siswa->angkatan ?>">
        </div>

        <button class="btn btn-success">Update</button>
    </form>
</div>