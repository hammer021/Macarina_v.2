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

<!-- Basic Tables start -->
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Data Barang</h4>
				<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
				<div class="heading-elements">
				</div>
			</div>
			<div class="card-content collapse show">
				<div class="card-body">
					<p class="card-text">Data barang yang tersedia : </p>
					<p><span class="text-bold-600"><button class="btn btn-primary" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah Data Barang</button></span></p>
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									
									<th>Nama Barang</th>
									<th>Harga</th>
									<th>Stok</th>
									<th>Gambar</th>
                  <th>Deskripsi</th>
                  <th>Aksi</th>
								</tr>
							</thead>
							<tbody>
              
              <?php foreach ($brg as $produk): ?>
									<tr>
										<td width="150">
											<?php echo $produk->nama_barang ?>
										</td>
										<td>
											<?php echo $produk->harga ?>
										</td>
										<td>
											<?php echo $produk->stok ?>
										</td>
                    <td>
											<?php //echo $produk->gambar_brg ?>
                      <img src="<?= base_url('uploads/barang/') . $produk->gambar_brg;?>" class="logo-komunitas mx-auto d-block mb-5" style="width:150px">
										</td>
                    <td>
											<?php echo $produk->deskripsi ?>
										</td>
										<td>
											<a href="<?php echo site_url('Produk/edit/'.$produk->kd_barang) ?>"
											 class="btn btn-small"><i class="fas fa-edit"></i> Edit</a>
											<a onclick="deleteConfirm('<?php echo site_url('Produk/delete/'.$produk->kd_barang) ?>')"
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
        <h4 class="modal-title" id="exampleModalLabel">INPUT DATA BARANG</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo base_url().'Produk/add'; ?>">

        <div class="form-group">
                <label name="nama_barang">Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control">
                <label name="harga">Harga</label>
                <input type="number" name="harga" class="form-control">
                <label name="stok">Stok</label>
                <input type="number" name="stok" class="form-control">
                <label name="gambar">Gambar</label>
                <input type="file" name="gambar_brg" class="input-group">
                <label name="deskripsi">Deskripsi</label>
                <input type="text" name="deskripsi" class="form-control">
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
