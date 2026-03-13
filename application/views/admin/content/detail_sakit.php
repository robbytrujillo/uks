<div class="main-content">
    <section class="section">

        <div class="section-header">
            <h1><i class="fas fa-notes-medical"></i> Detail Rekam Medis</h1>
        </div>

        <div class="row">

            <!-- DATA SISWA -->
            <div class="col-md-6">

                <div class="card card-primary shadow">
                    <div class="card-header">
                        <h4><i class="fas fa-user"></i> Data Siswa</h4>
                    </div>

                    <div class="card-body">

                        <table class="table table-borderless">

                            <tr>
                                <td width="150"><b>NIS</b></td>
                                <td><?= $detail->nis ?></td>
                            </tr>

                            <tr>
                                <td><b>Nama</b></td>
                                <td><?= $detail->nama ?></td>
                            </tr>

                            <tr>
                                <td><b>Kelas</b></td>
                                <td><?= $detail->kelas ?></td>
                            </tr>

                            <tr>
                                <td><b>Alamat</b></td>
                                <td><?= $detail->alamat ?></td>
                            </tr>

                            <tr>
                                <td><b>Tanggal</b></td>
                                <td><?= date('d F Y H:i', strtotime($detail->tgl_sakit)) ?></td>
                            </tr>

                            <tr>
                                <td><b>Petugas</b></td>
                                <td><?= $detail->nama_petugas ?></td>
                            </tr>

                        </table>

                    </div>
                </div>

            </div>


            <!-- KONDISI KESEHATAN -->
            <div class="col-md-6">

                <div class="card card-danger shadow">
                    <div class="card-header">
                        <h4><i class="fas fa-heartbeat"></i> Kondisi Kesehatan</h4>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <label><i class="fas fa-stethoscope"></i> Tekanan Darah</label>
                            <div class="alert alert-light border">
                                <?= $detail->tekanan_darah ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label><i class="fas fa-thermometer-half"></i> Suhu</label>
                            <div class="alert alert-light border">
                                <?= $detail->suhu ?> °C
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>


        <!-- CATATAN MEDIS -->

        <div class="card mt-4 mb-3 shadow">

            <div class="card-header bg-light">
                <h5><i class="fas fa-stethoscope"></i> Catatan Medis</h5>
            </div>

            <div class="card-body">

                <div class="alert alert-warning">
                    <h6><i class="fas fa-comment-medical"></i> Keluhan</h6>
                    <?= $detail->keluhan ?>
                </div>

                <div class="alert alert-info">
                    <h6><i class="fas fa-diagnoses"></i> Diagnosa</h6>
                    <?= $detail->diagnosa ?>
                </div>

                <div class="alert alert-success">
                    <h6><i class="fas fa-hand-holding-medical"></i> Penanganan</h6>
                    <?= $detail->penanganan ?>
                </div>

            </div>

        </div>


        <a href="<?= base_url('admin/siswa') ?>" class="btn btn-primary mt-3 mb-3" style="border-radius: 30px;">
            Kembali
        </a>

    </section>
</div>