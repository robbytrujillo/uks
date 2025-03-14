
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <br><br><br><br><br>
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <?php  
                  if ($this->session->flashdata('msg') == true) {?>
                    <div class="alert alert-danger" role="alert"><?= $this->session->flashdata('msg') ?></div>
                  <?php }?>
            <div class="card card-primary" style="border-radius: 5%;">
              <style>
                body{
                  /* background-image:url("image/ihbs-smp.jpg"); */
                  background-color: #eaeaea;
                  background-size: cover;
                }
              </style>
              <img src="image/uks1.png" style="width: 100px; margin-left: 34%; margin-top: 5%;" >
              <!-- <div class="card-header">
                <h4 style="text-align: center">Unit Kesehatan Sekolah</h4> 
              </div> -->
            
              <div class="card-body">
                <form method="POST" action="<?= base_url('auth/login') ?>" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="email">Username</label>
                    <input id="email" type="text" class="form-control" name="username" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Please fill in your username
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password" class="control-label">Password</label>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                      please fill in your password
                    </div>
                  </div>

                  <div class="form-group; rounded-pill">
                    <button type="submit" class="btn btn-primary btn-lg btn-block rounded-pill" tabindex="4" style="font-size: medium">
                      Login
                    </button>
                  </div>

                  
                </form>
                

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  