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
            <h3 class="content-header-title">Tables</h3>
          </div>
          <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
              <div class="breadcrumb-wrapper mr-1">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Home</a>
                  </li>
                  <li class="breadcrumb-item active">Tables
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
				<h4 class="card-title">Data Mobil</h4>
				<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
				<div class="heading-elements">
				</div>
			</div>
			<div class="card-content collapse show">
				<div class="card-body">
					<p class="card-text">Data mobil anda yang dapat di sewakan : </p>
					<p><span class="text-bold-600"><button class="btn btn-primary" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah Data Mobil</button></span></p>
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th>No</th>
									<th>Merek Mobil</th>
									<th>Warna Mobil</th>
									<th>Status</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
              
              <?php foreach ($mobilku as $mobilme): ?>
									<tr>
										<td width="150">
											<?php echo $mobilme->id_mobil ?>
										</td>
										<td>
											<?php echo $mobilme->merk_mobil ?>
										</td>
										<td>
											<?php echo $mobilme->warna_mobil ?>
										</td>
										<td>
											<a href="<?php echo site_url('Mobil/edit/'.$mobilme->id_mobil) ?>"
											 class="btn btn-small"><i class="fas fa-edit"></i> Edit</a>
											<a onclick="deleteConfirm('<?php echo site_url('Mobil/delete/'.$mobilme->id_mobil) ?>')"
											 href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i> Hapus</a>
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
<!-- Modal -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">INPUT DATA MOBIL</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo base_url().'Mobil/add'; ?>">

        <div class="form-group">
                <label name="merk_mobil">Merek Mobil</label>
                <input type="text" name="merk_mobil" class="form-control">
                <label name="warna_mobil">Warna Mobil</label>
                <input type="text" name="warna_mobil" class="form-control">
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
