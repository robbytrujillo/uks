<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">Siswa Yang Sering Sakit</h2>
            <br>
            <p>Silahkan Input Siswa Sakit <a href="<?= base_url('admin/siswa')?>" class="button"><span
                        style="color: red">disini!</span></a></p>

            <div class="card">
                <div class="card-header">
                    <h4>Data Siswa</h4>
                </div>

                <div class="card-body">

                    <div class="table-responsive">

                        <table id="table-sakit" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <!--<th>NISN</th>-->
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <!--<th>Alamat</th>-->
                                    <th>Jumlah Sakit</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php 
        $no = $start + 1;
        foreach ($sakit as $data) { ?>
                                <tr>

                                    <td><?= $no++ ?></td>
                                    <!--<td><?= $data->nis ?></td>-->
                                    <td><?= $data->nama ?></td>
                                    <td><?= $data->kelas ?></td>
                                    <!--<td><?= $data->alamat ?></td>-->

                                    <?php 
        if ($data->data <= 1) { ?>
                                    <td><span class="badge badge-primary"><?= $data->data?></span></td>

                                    <?php } elseif ($data->data <= 2) { ?>
                                    <td><span class="badge badge-warning"><?= $data->data?></span></td>

                                    <?php } else { ?>
                                    <td><span class="badge badge-danger"><?= $data->data?></span></td>

                                    <?php } ?>

                                </tr>
                                <?php } ?>

                            </tbody>
                        </table>

                        <div class="mt-3">
                            <?= $pagination; ?>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </section>
</div>