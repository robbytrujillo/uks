<style>
@media print {
    .print {
        display: none;
    }
}
</style>

<div class="container">
    <div class="text-center">
        <div class="title text-center">
            <br>
            <h1 align="center" style="color: black;"><img src="../../image/ihbs-logo-2.png"
                    style="height: 50px; padding-bottom: 10px;"><span style="color: #467228">UKS IHBS</span></h1>
            <p align="center" style="color: black;"> Jl. Bungur 2 Harjamukti Cimanggis Depok Jawa Barat</p>
            <hr>
        </div>
        <br>
        <h5>Laporan Harian Siswa Sakit</h5>

        <table class="table table-bordered table-md">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>NISN</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Alamat</th>
                    <th>Diagnosa</th>
                    <th>Penanganan</th>
                    <th>Petugas</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $value){ ?>
                <tr>
                    <!-- <td><?= $value->tgl_sakit ?></td> -->
                    <td>
                        <?= date('l, d-m-Y', strtotime($value->tgl_sakit)); ?>
                    </td>
                    <td>
                        <?= date('H:i', strtotime($value->tgl_sakit)); ?>
                    </td>
                    <td><?= $value->nis ?></td>
                    <td><?= $value->nama ?></td>
                    <td><?= $value->kelas ?></td>
                    <td><?= $value->alamat ?></td>
                    <td><?= $value->diagnosa ?></td>
                    <td><?= $value->penanganan ?></td>
                    <td><?= $value->nama_petugas ?></td>
                </tr>
                <?php } ?>

            </tbody>
        </table>

        <div class="mt-5 mb-5">
            <p>Hormat Kami</p>
            <br><br><br>
            <p>Petugas UKS SMA Putra</p>
        </div>


        <div class="text-right">
            <button class="print btn btn-primary" style="border-radius: 30px;" onclick="window.print()">CETAK</button>
            <a class="print btn btn-danger" style="border-radius: 30px;"
                href="<?= base_url('admin/report') ?>">KEMBALI</a>
        </div>


    </div>
</div>