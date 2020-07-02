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
            <h3 class="content-header-title">Detail Transaksi</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Home</a>
                  </li>
                  <li class="breadcrumb-item active">Detail Transaksi
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
        <h4 class="card-title" id="exampleModalLabel">Detail Transaksi</h4>
        <a href="<?php echo site_url('HomeAdm/transaksi') ?>">
        <button type="button" class="btn btn-secondary">Kembali</button></a>
        <?php if ($this->session->flashdata('success')): ?>
				<div class="alert alert-success" role="alert">
					<?php echo $this->session->flashdata('success'); ?>
				</div>
				<?php endif; ?>
      </div>
      <div class="card-body">
      <form action="#" method="post" enctype="multipart/form-data">
					
                        
                        <div class="form-group">
                            <label for="name">Kode Transaksi</label>
                            <label class="form-control" type="text" name="kode"><?php echo $transaksi->kd_transaksi?>
                            </label>
                        </div>

                        <div class="form-group">
                            <label for="name">Nama Reseller</label>
                            <label class="form-control" type="text" name="kode"><?php echo $transaksi->nama_reseller?>
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="name">Tanggal Transaksi</label>
                            <label class="form-control" type="text" name="kode"><?php echo $transaksi->tgl_transaksi?>
                            </label>
                        </div>

                        <div class="table-responsive">
                          <table class="table">
                            <thead>
                              <tr>
                                <th>Nama Barang</th>
                                <th>Harga Barang</th>
                                <th>Jumlah Beli</th>
                                <th>Subtotal</th>
                              </tr>
                            </thead>
                            <tbody>
              
              <?php foreach ($dettransaksi as $dettrans): ?>
									<tr>
										<td width="150">
											<?php echo $dettrans->nama_barang ?>
										</td>
										<td>
											<?php echo $dettrans->harga ?>
										</td>
										<td>
											<?php echo $dettrans->qty_det ?>
                    </td>
                    <td>
											<?php echo $dettrans->subtotal ?>
                    </td>
                   
                    
                    
									</tr>
									<?php endforeach; ?>
              </tbody>
                      <tfoot>
                              <tr>
                                <th></th>
                                <th></th>
                                <th>Grand Total :</th>
                                <th> <?php echo $transaksi->grand_total?></th>
                              </tr>
                      </tfoot>
                          </table>
                        </div>

                        
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