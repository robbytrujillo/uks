<div class="main-content">
<section class="section">

    <div class="section-header justify-content-center">
        <h4>Data Siswa</h4>
    </div>

    <div class="section-body">
        <div class="row justify-content-center">

            <div class="col-12 col-md-8 col-lg-6">

                <div class="card">
                    <div class="card-header">
                        <h4>Update Data</h4>
                    </div>

                    <div class="card-body">

                    <?php foreach ($sakit as $data) { ?>

                    <form action="<?= base_url('admin/update/') . $data->id_sakit ?>" method="post">

                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" disabled
                            class="form-control text-dark"
                            value="<?= $data->nama ?>">
                        </div>

                        <div class="form-group">
                            <label>Kelas</label>
                            <input type="text" disabled
                            class="form-control text-dark"
                            value="<?= $data->kelas ?>">
                        </div>

                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" disabled
                            class="form-control text-dark"
                            value="<?= $data->alamat ?>">
                        </div>

                        <div class="form-group">
                            <label>Tanggal & Jam</label>
                            <input type="datetime-local"
                            name="tgl_sakit"
                            class="form-control"
                            value="<?= date('Y-m-d\TH:i', strtotime($data->tgl_sakit)) ?>">
                        </div>

                        <div class="form-group">
                            <label>Tekanan Darah</label>
                            <input type="text"
                            name="tekanan_darah"
                            class="form-control"
                            value="<?= $data->tekanan_darah ?>">
                        </div>

                        <div class="form-group">
                            <label>Suhu</label>
                            <input type="text"
                            name="suhu"
                            class="form-control"
                            value="<?= $data->suhu ?>">
                        </div>

                        <div class="form-group">
                            <label>Keluhan</label>
                            <textarea class="form-control"
                            name="keluhan"
                            rows="2"><?= $data->keluhan ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Diagnosa</label>
                            <textarea class="form-control"
                            name="diagnosa"
                            rows="2"><?= $data->diagnosa ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Penanganan</label>
                            <textarea class="form-control"
                            name="penanganan"
                            rows="2"><?= $data->penanganan ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Petugas UKS</label>
                            <select name="id_petugas" class="form-control">
                                <?php foreach ($petugas as $p): ?>
                                <option value="<?= $p->id ?>"
                                    <?= ($p->id == $data->id_petugas) ? 'selected' : '' ?>>
                                    <?= $p->nama_petugas ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Tombol -->
                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-primary btn-block"
                                style="border-radius:30px;">
                                UPDATE
                                </button>
                            </div>

                            <div class="col-6">
                                <a href="<?= base_url('admin/siswa') ?>"
                                class="btn btn-danger btn-block"
                                style="border-radius:30px;">
                                KEMBALI
                                </a>
                            </div>
                        </div>

                    </form>

                    <?php } ?>

                    </div>
                </div>

            </div>
        </div>
    </div>

</section>
</div>