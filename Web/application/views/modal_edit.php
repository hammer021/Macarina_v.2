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
            <h3 class="content-header-title">Barang</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Home</a>
                  </li>
                  <li class="breadcrumb-item active">Barang
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
        <h4 class="card-title" id="exampleModalLabel">EDIT DATA BARANG</h4>
        
        <?php if ($this->session->flashdata('success')): ?>
				<div class="alert alert-success" role="alert">
					<?php echo $this->session->flashdata('success'); ?>
				</div>
				<?php endif; ?>
      </div>
      <div class="card-body">
      <form action="<?php site_url("Produk/edit") ?>" method="post" enctype="multipart/form-data">
					
                        <input type="hidden" name="kd_barang" value="<?php echo $barang->kd_barang?>" />

                        <div class="form-group">
                            <label for="name">Nama Barang</label>
                            <input class="form-control <?php echo form_error('nama_barang') ? 'is-invalid':'' ?>"
                             type="text" name="nama_barang" placeholder="Nama Barang" value="<?php echo $barang->nama_barang ?>" />
                            <div class="invalid-feedback">
                                <?php echo form_error('nama_barang') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="price">Harga</label>
                            <input class="form-control <?php echo form_error('harga') ? 'is-invalid':'' ?>"
                             type="number" name="harga" min="0" placeholder="Harga Barang" value="<?php echo $barang->harga ?>" />
                            <div class="invalid-feedback">
                                <?php echo form_error('harga') ?>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="name">Stok</label>
                            <input class="form-control <?php echo form_error('stok') ? 'is-invalid':'' ?>"
                             name="stok" placeholder="Stok..." value="<?php echo $barang->stok ?>"></input>
                            <div class="invalid-feedback">
                                <?php echo form_error('stok') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name">Gambar</label>
                            <?php echo "<img src='./theme-assets/images/barang/".$barang->gambar_brg."' width='100px' height='100px'/>"?>
                            
                            <input type="file" name="gambar" class="form-control <?php echo form_error('gambar') ? 'is-invalid':'' ?>">
                            
                            <input type ="hidden" class="form-control" name="old_image"  value="<?php echo $barang->gambar_brg ?>"></input>
                            <div class="invalid-feedback">
                                <?php echo form_error('stok') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name">Deskripsi</label>
                            <input class="form-control <?php echo form_error('deskripsi') ? 'is-invalid':'' ?>"
                             name="deskripsi" placeholder="Deskripsi..." value="<?php echo $barang->deskripsi ?>"></input>
                            <div class="invalid-feedback">
                                <?php echo form_error('stok') ?>
                            </div>
                        </div>

                        <input class="btn btn-primary" type="submit" name="btn" value="Save" />
                        <a class="btn btn-danger" href="<?php echo site_url('Produk') ?>">Back</a>
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