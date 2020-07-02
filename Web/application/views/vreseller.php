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

<!-- Basic Tables start -->
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Data Reseller</h4>
				<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
				<div class="heading-elements">
				</div>
			</div>
			<div class="card-content collapse show">
				<div class="card-body">
					<p class="card-text">Data Reseller yang terdaftar : </p>
         
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									
									<th>Nama Reseller</th>
									<th>Alamat</th>
									<th>No Telepon</th>
									<th>Foto</th>
                  <th>Status</th>
								</tr>
							</thead>
							<tbody>
              
              <?php foreach ($reseller as $res): ?>
									<tr>
										<td width="150">
											<?php echo $res->nama_reseller ?>
										</td>
										<td>
											<?php echo $res->alamat ?>
										</td>
										<td>
											<?php echo $res->no_tlp ?>
										</td>
                    <td>
                    <?php echo "<img src='./theme-assets/images/reseller/pas/".$res->pas_foto."'  width='100px' height='100px'/>" ?>
											
										</td>
                    <td>
                      <?php 
                      $status=$res->status;
                      if($status==0){
                          echo "Belum diAktifkan";
                      }
                      else if($status==1){
                        echo "Sudah diAktifkan";
                      }
                       ?>
										</td>
										<td>
                      <a href="<?php echo site_url('Reseller/edit/'.$res->id_reseller) ?>"
                      class="btn btn-small">
                      <i class="fas fa-edit"></i> Edit</a>
											<a onclick="return confirm('Apakah Anda Ingin Menghapus Data <?=$res->nama_reseller;?> ?');" 
                       href="<?php echo site_url('Reseller/delete/'.$res->id_reseller); ?>" class="btn btn-small text-danger"><i class="fas fa-trash"></i> Hapus</a>
                       
                                    
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
