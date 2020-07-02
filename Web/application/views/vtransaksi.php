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
                      
                    <a href="<?php echo site_url('Transaksi/bayar/'.$trans->kd_transaksi); ?>">
                    </i> <?php
                       if($status=="belum_bayar"){
                        echo '<svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-check2-square" fill="green" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M15.354 2.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L8 9.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                        <path fill-rule="evenodd" d="M1.5 13A1.5 1.5 0 0 0 3 14.5h10a1.5 1.5 0 0 0 1.5-1.5V8a.5.5 0 0 0-1 0v5a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V3a.5.5 0 0 1 .5-.5h8a.5.5 0 0 0 0-1H3A1.5 1.5 0 0 0 1.5 3v10z"/>
                        </svg>';
                    }
                    else if($status=="sudah_bayar"){
                      echo "-";
                    }?></a></br>
                    <a href="<?php echo site_url('Transaksi/tampil/'.$trans->kd_transaksi) ?>">
                    <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-eye" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 0 0 1.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0 0 14.828 8a13.133 13.133 0 0 0-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 0 0 1.172 8z"/>
                    <path fill-rule="evenodd" d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                    </svg></a>

                    <a onclick="return confirm('Apakah Anda Ingin Menghapus Data <?=$trans->nama_reseller;?> ?');" 
                       href="<?php echo site_url('Transaksi/delete/'.$trans->kd_transaksi); ?>">
                      <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="red" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                      </svg></a>
                       
                                    
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
