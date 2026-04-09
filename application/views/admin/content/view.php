<div class="container-fluid">
    <div class="main-content">
        <div class="section">
            <div class="section-header">

                <body>

                    <h1>Data Siswa</h1>

            </div>
            <div class="section-body">
                <a href="<?php echo base_url("index.php/Siswa/form"); ?>" class="btn btn-primary ml-2"
                    style="border-radius: 30px">Import Data</a>
                <br>
                <br>

                <a href="<?= base_url('Siswa/tambah') ?>" class="btn btn-success mb-3">
                    + Tambah Siswa
                </a>

                <div class="table-responsive mb-5">
                    <table id="table-1" class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NISN</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                <th>Kelas</th>
                                <th>Angkatan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                                $i = 1;
                                if (!empty($siswa)) {
                                    foreach ($siswa as $data) {
                                        echo "<tr>";
                                        echo "<td>".$i++."</td>";
                                        echo "<td>".$data->nis."</td>";
                                        echo "<td>".$data->nama."</td>";
                                        echo "<td>".$data->jk."</td>";
                                        echo "<td>".$data->alamat."</td>";
                                        echo "<td>".$data->kelas."</td>";
                                        echo "<td>".$data->angkatan."</td>";
                                        echo "<td>
                                                <a href='".base_url("Siswa/edit/".$data->nis)."' class='btn btn-warning btn-sm'>Edit</a>
                                                <a href='".base_url("Siswa/delete/".$data->nis)."' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin?\")'>Delete</a>
                                            </td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='7' class='text-center'>Data tidak ada</td></tr>";
                                }
                                ?>

                        </tbody>
                    </table>
                </div>
                </body>
            </div>
        </div>
    </div>
</div>