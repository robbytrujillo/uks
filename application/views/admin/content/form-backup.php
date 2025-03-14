<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Data Siswa</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
</head>
<body>
<div class="container mt-4">
    <h3 class="mb-3">Import Data Siswa dari CSV</h3>

    <!-- Form Upload CSV -->
    <form method="post" action="<?= site_url('siswa/form'); ?>" enctype="multipart/form-data">
        <div class="form-group">
            <label for="file">Pilih File CSV</label>
            <input type="file" name="file" class="form-control" required accept=".csv">
        </div>
        <button type="submit" name="preview" class="btn btn-primary">Preview</button>
    </form>

    <hr>

    <!-- Menampilkan Error Upload -->
    <?php if(isset($upload_error)): ?>
        <div class="alert alert-danger"><?= $upload_error; ?></div>
    <?php endif; ?>

    <!-- Menampilkan Data Preview -->
    <?php if(isset($sheet)): ?>
        <h4>Preview Data:</h4>
        <form method="post" action="<?= site_url('siswa/import'); ?>">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>Kelas</th>
                        <th>Angkatan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $numrow = 1; ?>
                    <?php foreach($sheet as $row): ?>
                        <?php if($numrow > 1): // Lewati header CSV ?>
                            <tr>
                                <td><?= $row[0]; ?></td>
                                <td><?= $row[1]; ?></td>
                                <td><?= $row[2]; ?></td>
                                <td><?= $row[3]; ?></td>
                                <td><?= $row[4]; ?></td>
                                <td><?= $row[5]; ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php $numrow++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button type="submit" class="btn btn-success">Import Data</button>
        </form>
    <?php endif; ?>
</div>
</body>
</html>
