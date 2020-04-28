<?php 
    $this->load->view("template/header");
    ?>
  

    <!-- ////////////////////////////////////////////////////////////////////////////-->

	<?php 
    $this->load->view("template/sidebar");
    ?>
<div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Reseller</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Home</a>
                  </li>
                  <li class="breadcrumb-item active">Reseller
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="content-body">
<!-- Modal Edit -->
<div class="row" id="edit" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="col-12" role="document">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title" id="exampleModalLabel">EDIT DATA Reseller</h4>
        
        <?php if ($this->session->flashdata('success')): ?>
				<div class="alert alert-success" role="alert">
					<?php echo $this->session->flashdata('success'); ?>
				</div>
				<?php endif; ?>
      </div>
      <div class="card-body">
      <form action="<?php site_url("Reseller/edit") ?>" method="post" enctype="multipart/form-data">
					
                        <input type="hidden" name="id_reseller" value="<?php echo $reseller->id_reseller?>" />

                        <div class="form-group">
                            <label for="name">Nama Reseller</label>
                            <input class="form-control <?php echo form_error('nama_reseller') ? 'is-invalid':'' ?>"
                             type="text" name="nama_reseller" placeholder="Nama Reseller" value="<?php echo $reseller->nama_reseller ?>" />
                            <div class="invalid-feedback">
                                <?php echo form_error('nama_reseller') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="price">Alamat</label>
                            <input class="form-control <?php echo form_error('alamat') ? 'is-invalid':'' ?>"
                             type="textarea" name="alamat" placeholder="Alamat" value="<?php echo $reseller->alamat ?>" />
                            <div class="invalid-feedback">
                                <?php echo form_error('alamat') ?>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="name">No Telepon</label>
                            <input type="number"  class="form-control <?php echo form_error('no_tlp') ? 'is-invalid':'' ?>"
                             name="no_tlp" placeholder="No Telepon..." value="<?php echo $reseller->no_tlp ?>"></input>
                            <div class="invalid-feedback">
                                <?php echo form_error('no_tlp') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name">Scan KTP</label>
                            <?php echo "<img src='./theme-assets/images/reseller/scan/".$reseller->scan_ktp."' width='100px' height='100px'/>"?>
                            
                            <input type="file" name="scan_ktp" class="form-control <?php echo form_error('scan_ktp') ? 'is-invalid':'' ?>">
                            
                            <input type ="hidden" class="form-control" name="old_scan_ktp"  value="<?php echo $reseller->scan_ktp ?>"></input>
                            <div class="invalid-feedback">
                                <?php echo form_error('scan_ktp') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name">No KTP</label>
                            <input type="number"  class="form-control <?php echo form_error('no_ktp') ? 'is-invalid':'' ?>"
                             name="no_ktp" placeholder="No KTP..." value="<?php echo $reseller->no_ktp ?>"></input>
                            <div class="invalid-feedback">
                                <?php echo form_error('no_ktp') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name">Email</label>
                            <input type="email" class="form-control <?php echo form_error('email') ? 'is-invalid':'' ?>"
                             name="email" placeholder="EMail..." value="<?php echo $reseller->email ?>"></input>
                            <div class="invalid-feedback">
                                <?php echo form_error('email') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name">Password</label>
                            <input type="password" class="form-control <?php echo form_error('password') ? 'is-invalid':'' ?>"
                             name="password" placeholder="Password..." value="<?php echo $reseller->password ?>"></input>
                            <div class="invalid-feedback">
                                <?php echo form_error('password') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name">Status</label>
                            <input type="number" class="form-control <?php echo form_error('status') ? 'is-invalid':'' ?>"
                             name="status" placeholder="Status..." value="<?php echo $reseller->status ?>"></input>
                            <div class="invalid-feedback">
                                <?php echo form_error('status') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name">Pas Foto</label>
                            <?php echo "<img src='./theme-assets/images/reseller/pas/".$reseller->pas_foto."' width='100px' height='100px'/>"?>
                            
                            <input type="file" name="pas_foto" class="form-control <?php echo form_error('pas_foto') ? 'is-invalid':'' ?>">
                            
                            <input type ="hidden" class="form-control" name="old_pas_foto"  value="<?php echo $reseller->pas_foto ?>"></input>
                            <div class="invalid-feedback">
                                <?php echo form_error('pas_foto') ?>
                            </div>
                        </div>
                        <input class="btn btn-primary" type="submit" name="btn" value="Save" />
                        <a class="btn btn-danger" href="<?php echo site_url('Reseller') ?>">Back</a>
                    </form>
      </div>
    </div>
  </div>
</div>

<!-- Bordered table end -->
</div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
<?php 
    $this->load->view("template/footer");
    ?>