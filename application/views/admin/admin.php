 <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Dashboard</h1>
            
          </div>

          <div class="section-body">
            <h2 class="section-title">Siswa Yang Sering Sakit</h2>
            <div class="card">
              <div class="card-header">
                <h4>Data Siswa</h4>
              </div>  
              <div class="col-12">
                <div class="card card-primary">
                  <div class="card-header">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">No.</th>
                          <th scope="col">NIS</th>
                          <th scope="col">Nama</th>
                          <th scope="col">Rombel</th>
                          <th scope="col">Rayon</th>
                          <th>Jumlah Sakit</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $no = 1;
                        foreach ($sakit as $data) { ?>
                        <tr>
                          <th scope="row"><?= $no++ ?></th>
                          <td><?= $data->nis ?></td>
                          <td><?= $data->nama ?></td>
                          <td><?= $data->rombel ?></td>
                          <td><?= $data->rayon ?></td>
                          <?php 
                          if ($data->data <= 1) { ?>
                            <td><span class="badge badge-primary"><?= $data->data?></span></td>
                          <?php }elseif ($data->data <= 2) { ?>
                            <td><span class="badge badge-warning"><?= $data->data?></span></td>
                          <?php }elseif ($data->data >= 2) { ?>
                            <td><span class="badge badge-danger"><?= $data->data?></span></td>
                          <?php } ?>
                        </tr>
                      <?php } ?>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>