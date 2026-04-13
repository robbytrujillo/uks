<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h4>Input Siswa Sakit</h4>
        </div>

        <?php if ($this->session->flashdata('flash')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Data <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
        <?php elseif ($this->session->flashdata('cari')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong><?= $this->session->flashdata('cari'); ?></strong>
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
        <?php endif ?>

        <div class="section-body">

            <!-- ================= FORM INPUT (ATAS) ================= -->
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">

                    <div class="card">
                        <div class="card-header">
                            <h4>Form Input</h4>
                        </div>

                        <div class="card-body">

                            <form action="<?= base_url('admin/cari') ?>" method="post">

                                <div class="form-group">
                                    <label>Nama Siswa</label>

                                    <div class="input-group">

                                        <input type="text" id="nama_siswa" name="nama" class="form-control"
                                            placeholder="Ketik Nama Siswa..." maxlength="50" required autofocus>

                                        <div class="input-group-append">
                                            <button class="btn btn-info">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>

                                    </div>

                                </div>

                            </form>

                        </div>
                    </div>

                </div>
            </div>

            <!-- ================= TABEL DATA (BAWAH) ================= -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Siswa Sakit</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="table-1" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Waktu Sakit</th>
                                            <!-- <th>Jam</th> -->
                                            <th>Nama</th>
                                            <th>Kelas</th>
                                            <th>Keluhan</th>
                                            <th>Diagnosa</th>
                                            <th width="18%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($sakit as $sakut): ?>
                                        <tr>

                                            <td><?= $no++ ?></td>

                                            <!-- <td>
                                                <?= date('l, d-m-Y', strtotime($sakut->tgl_sakit)); ?>
                                            </td>

                                            <td>
                                                <?= date('H:i', strtotime($sakut->tgl_sakit)); ?>
                                            </td> -->

                                            <td>
                                                <?= hari_indo($sakut->tgl_sakit) ?>,
                                                <?= date('d', strtotime($sakut->tgl_sakit)) ?>
                                                <?= bulan_indo(date('m', strtotime($sakut->tgl_sakit))) ?>
                                                <?= date('Y', strtotime($sakut->tgl_sakit)) ?><br>
                                                Pukul : <span
                                                    style="color: red; font-weight: bold"><?= date('H:i', strtotime($sakut->tgl_sakit)) ?></span>
                                                WIB
                                            </td>

                                            <td><?= $sakut->nama ?></td>

                                            <td><?= $sakut->kelas ?></td>

                                            <td><?= $sakut->keluhan ?></td>

                                            <td><?= $sakut->diagnosa ?></td>

                                            <td>

                                                <!-- DETAIL -->
                                                <a href="<?= base_url('admin/detail/'.$sakut->id_sakit) ?>"
                                                    class="btn btn-sm btn-info" style="border-radius: 30px;">
                                                    <i class="fa fa-eye"></i>
                                                </a>

                                                <!-- UPDATE -->
                                                <a href="<?= base_url('admin/edit/'.$sakut->id_sakit) ?>"
                                                    class="btn btn-sm btn-primary" style="border-radius: 30px;">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                <!-- DELETE -->
                                                <a onclick="return confirm('Apakah Kamu Yakin ?')"
                                                    href="<?= site_url('admin/delete/'.$sakut->id_sakit)?>"
                                                    class="btn btn-sm btn-danger" style="border-radius: 30px;">
                                                    <i class="fa fa-trash"></i>
                                                </a>

                                            </td>

                                        </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ===================================================== -->

        </div>
    </section>
</div>