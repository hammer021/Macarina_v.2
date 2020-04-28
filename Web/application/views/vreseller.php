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
          <p><span class="text-bold-600"><button class="btn btn-primary"
           data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah Data Reseller</button></span></p>
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
<!-- Modal Input Baru-->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">INPUT DATA RESELLER</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo base_url().'Reseller/add'; ?>" enctype="multipart/form-data">

        <div class="form-group">
                <label for="name">Nama Reseller</label>
                <input type="text" name="nama_reseller" class="form-control">
                <label for="name">Alamat Lengkap</label>
                <input type="text" name="alamat" class="form-control">
                <label for="name">No Telepon</label>
                <input type="text" max ="13" name="no_tlp" class="form-control">
                <label for="name">Scan KTP</label>
                <input type="file" name="scan_ktp" class="form-control">
                <label for="name">No KTP</label>
                <input type="text" max="16" name="no_ktp" class="form-control">
                <label for="name">Email</label>
                <input type="email" name="email" class="form-control">
                <label for="name">Password</label>
                <input type="password" max="8" name="password" class="form-control">
                <label for="name">Pas Foto</label>
                <input type="file" name="pas_foto" class="form-control">
        
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="reset" class="btn btn-danger" data-dismiss="modal">Cancel</button>

        </form>
      </div>
    </div>
  </div>
</div>


  <?php 
    
    $this->load->view("template/footer");
    ?>
