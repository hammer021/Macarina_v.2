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
            <h3 class="content-header-title">Transaksi</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Home</a>
                  </li>
                  <li class="breadcrumb-item active">Transaksi
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="content-body">

<!-- Basic Tables start -->
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Data Transaksi</h4>
				<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
				<div class="heading-elements">
				</div>
			</div>
			<div class="card-content collapse show">
				<div class="card-body">
					<p class="card-text">Data Transaksi yang ada : </p>
         
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									
									<th>Kode Transaksi</th>
									<th>Nama Reseller</th>
									<th>Grand Total</th>
									<th>Tgl Transaksi</th>
                  <th>Status Bayar</th>
                  <th>Bukti Bayar</th>
								</tr>
							</thead>
							<tbody>
              
              <?php foreach ($transaksi as $trans): ?>
									<tr>
										<td width="150">
											<?php echo $trans->kd_transaksi ?>
										</td>
										<td>
											<?php echo $trans->nama_reseller ?>
										</td>
										<td>
											<?php echo $trans->grand_total ?>
                    </td>
                    <td>
											<?php echo $trans->tgl_transaksi ?>
                    </td>
                    <td>
                    <?php 
                      $status=$trans->status_bayar;
                      if($status=="belum_bayar"){
                          echo "Belum Bayar";
                      }
                      else if($status=="sudah_bayar"){
                        echo "Sudah Bayar";
                      }
                       ?>
										</td>
                    <td>
                    <?php echo "<img src='./uploads/reseller/bukti_bayar/".$trans->bukti_bayar."'  width='100px' height='100px'/>" ?>
											
										</td>
                    
										<td>
                    <a href="<?php echo site_url('Transaksi/tampil/'.$trans->kd_transaksi) ?>"
                      class="btn btn-small">
                      <i class="fas fa-edit"></i> Detail</a>
                    	<a onclick="return confirm('Apakah Anda Ingin Menghapus Data <?=$trans->nama_reseller;?> ?');" 
                       href="<?php echo site_url('Transaksi/delete/'.$trans->kd_transaksi); ?>" class="btn btn-small text-danger"><i class="fas fa-trash"></i> Hapus</a>
                       
                                    
										</td>
									</tr>
									<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Basic Tables end -->	


<!-- Bordered table end -->
        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->



  <?php 
    
    $this->load->view("template/footer");
    ?>
