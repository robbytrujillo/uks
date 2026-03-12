<div class="main-content">
    <div class="section">

        <div class="section-header">
            <h4>Form Import</h4>
        </div>

        <div class="section-body">
            <a href="<?= base_url('csv/format.csv'); ?>" class="btn btn-primary" style="border-radius: 30px;">
                Download Format
            </a>
            <br>
            <br>

            <form method="post" action="<?= base_url('Siswa/import') ?>" enctype="multipart/form-data">

                <input type="file" name="file" class="form-control" required>
                <br>
                <button type="submit" class="btn btn-success" style="border-radius: 30px;">
                    Import CSV
                </button>
            </form>
            <br>

            <!-- <form method="post" action="<?= base_url('Siswa/import_excel') ?>" enctype="multipart/form-data">

<div class="form-group">
<label>Upload Excel</label>
<input type="file" name="file" class="form-control" required>
</div>

<button type="submit" class="btn btn-success">
Import Excel
</button>

</form> -->

            <br>

            <?php
                if(isset($_POST['preview'])){

                if(isset($upload_error)){
                    echo "<div class='alert alert-danger'>".$upload_error."</div>";
                    die;
                }

                echo "<form method='post' action='".site_url("Siswa/import")."'>";

                echo "<table class='table table-bordered table-striped'>";

                echo "<thead>
                        <tr>
                            <th colspan='6'>Preview Data</th>
                        </tr>
                        <tr>
                            <th>NISN</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Kelas</th>
                            <th>Angkatan</th>
                        </tr>
                    </thead>";

                echo "<tbody>";
                    $numrow = 1;
                    $kosong = 0;

                    foreach($sheet as $row){

                    $cellIterator = $row->getCellIterator();
                    $cellIterator->setIterateOnlyExistingCells(false);

                    $get = array();

                    foreach ($cellIterator as $cell) {
                        array_push($get, $cell->getValue());
                    }

                    $nis = $get[0];
                    $nama = $get[1];
                    $jk = $get[2];
                    $alamat = $get[3];
                    $kelas = $get[4];
                    $angkatan = $get[5];

                    if(empty($nis) && empty($nama) && empty($jk) && empty($alamat) && empty($kelas) && empty($angkatan))
                    continue;

                    if($numrow > 1){

                    $nis_td = (!empty($nis))? "" : "style='background:#E07171'";
                    $nama_td = (!empty($nama))? "" : "style='background:#E07171'";
                    $jk_td = (!empty($jk))? "" : "style='background:#E07171'";
                    $alamat_td = (!empty($alamat))? "" : "style='background:#E07171'";
                    $kelas_td = (!empty($kelas))? "" : "style='background:#E07171'";
                    $angkatan_td = (!empty($angkatan))? "" : "style='background:#E07171'";

                    if(empty($nis) or empty($nama) or empty($jk) or empty($alamat) or empty($kelas) or empty($angkatan)){
                        $kosong++;
                    }

                    echo "<tr>";
                    echo "<td $nis_td>$nis</td>";
                    echo "<td $nama_td>$nama</td>";
                    echo "<td $jk_td>$jk</td>";
                    echo "<td $alamat_td>$alamat</td>";
                    echo "<td $kelas_td>$kelas</td>";
                    echo "<td $angkatan_td>$angkatan</td>";
                    echo "</tr>";
                }

                $numrow++;
                }

                echo "</tbody></table>";

                if($kosong > 0){

                echo "<div class='alert alert-danger'>
                    Ada <b>$kosong</b> data yang belum lengkap.
                </div>";

                }else{

                echo "<button type='submit' name='import' class='btn btn-success' style='border-radius: 30px;'>
                    Import Data
                </button>

                <a href='".site_url("Siswa")."' class='btn btn-danger' style='border-radius: 30px;'>
                    Cancel
                </a>";

                }

                echo "</form>";
                }
            ?>
        </div>
    </div>
</div>