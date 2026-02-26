<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h4>Input Siswa Sakit</h4>
        </div>

        <?php if ($this->session->flashdata('flash')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Data <strong>berhasil</strong> <?php echo $this->session->flashdata('flash'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php elseif ($this->session->flashdata('cari')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong><?php echo $this->session->flashdata('cari'); ?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php endif ?>

        <div class="section-body">
            <div class="row">
                <div class="col-3">
                    <div class="card">
                        <div class="card-header">
                            <h4>Form Input</h4>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('admin/cari') ?>" method="post">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <div class="row">
                                        <div class="col-8">
                                            <input type="text" name="nama" class="form-control"
                                                placeholder="Nama : ex Asep" maxlength="50" style="float: left;"
                                                required="" autofocus="">
                                        </div>
                                        <div class="col-4">
                                            <button class="form-control btn btn-info"><i
                                                    class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-9">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Siswa Sakit</h4>
                        </div>
                        <div class="card-body">
                            <table id="table-1" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>NISN</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Alamat</th>
                                        <th>Hari/Tanggal</th>
                                        <th>Jam</th>
                                        <th>TD</th>
                                        <th>Suhu</th>
                                        <th>Keluhan</th>
                                        <th>Diagnosa</th>
                                        <th>Penanganan</th>
                                        <th width="15%" style="">Pengaturan Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
										$no = 1; 
										foreach ($sakit as $sakut) { ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $sakut->nis ?></td>
                                        <td><?= $sakut->nama ?></td>
                                        <td><?= $sakut->kelas ?></td>
                                        <td><?= $sakut->alamat ?></td>
                                        <!-- <td><?= $sakut->tgl_sakit  ?></td> -->
                                        <td>
                                            <?= date('l, d-m-Y', strtotime($sakut->tgl_sakit)); ?>
                                        </td>
                                        <td>
                                            <?= date('H:i', strtotime($sakut->tgl_sakit)); ?>
                                        </td>
                                        <th><?= $sakut->tekanan_darah ?></th>
                                        <th><?= $sakut->suhu ?></th>
                                        <th><?= $sakut->keluhan ?></th>
                                        <th><?= $sakut->diagnosa ?></th>
                                        <td><?= $sakut->penanganan ?></td>
                                        <td>
                                            <?= anchor(base_url('admin/edit/') . $sakut->id_sakit, '<button class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>') ?>
                                            <a onclick="return confirm('Apakah Kamu Yakin ?')"
                                                href="<?= site_url('admin/delete/'.$sakut->id_sakit)?>"
                                                class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>