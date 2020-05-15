<?php 
    $this->load->view("utemplate/header");
    ?>
  

    <div class="hero-wrap hero-bread" style="background-image: url(<?php echo base_url("images/Salinan macarina-8.jpg")?>);">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="<?php echo base_url('Home/index'); ?>">Home</a></span> <span>Products</span></p>
            <h1 class="mb-0 bread">Products</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section">
    	<div class="container">
    		<div class="row justify-content-center">
    			<div class="col-md-10 mb-5 text-center">
    				<ul class="product-category">
    					<li><a href="<?php echo base_url('Shop/Shop2');?>" class="active">Pack</a></li>
    					<li><a href="<?php echo base_url('Home/shop');?>" class="">Box</a></li>
    				</ul>
    			</div>
    		</div>
    		<div class="row">
			<?php
				//include_once "config.php";
				//$query = mysqli_query($koneksi,"SELECT * FROM barang");
				//while ($data = mysqli_fetch_array($query)){
				//	$id = $data ['kd_barang'];
				//	$price = $data ['harga'];
				?>
    			<div class="col-md-6 col-lg-3 ftco-animate">
    				<div class="product">
    					<a href="#" class="img-prod"><img class="img-fluid" <?php echo base_url "src='admin/img/barang/".$data['gambar_brg']."'" ?> alt="Colorlib Template">
    						<div class="overlay"></div>
    					</a>
    					<div class="text py-3 pb-4 px-3 text-center">
    						<h3><a href="#"><?php echo base_url $data['nama_barang']?></a></h3>
    						<div class="d-flex">
    							<div class="pricing">
								
		    						<p class="price"><span class="price-sale">Rp <?php echo $price?></span></p>
		    					</div>
	    					</div>
	    					<div class="bottom-area d-flex px-3">
	    						<div class="m-auto d-flex">
                                    <?php 
                                    //if(!isset($_SESSION['user_login'])){  ?>
	    							<a href="<?php echo base_url('Login/index');?>" class="buy-now d-flex justify-content-center align-items-center mx-1">
	    								<span><i class="ion-ios-cart"></i></span>	
									</a>
									<a href=" <?php echo base_url('Shop/Shop2');?>" class="buy-now d-flex justify-content-center align-items-center mx-1">
	    								<span><i class="ion-ios-menu"></i></span>	
									</a>
									<?php
											}
											//else{
											//	if(check_if_added_to_cart($data['kd_barang'])){
											//		echo '<a href="shop2.php"  class="buy-now d-flex justify-content-center align-items-center mx-1" disabled>
											//		<span><i class="ion-ios-cart"></i></span>
											//	</a>';
											//	}else{
													?>
													<a href="<?php echo base_url('Charts'); ?> id=<?php echo $data['kd_barang'];?>&price=<?php echo $data['harga'];?>" name="add" class="buy-now d-flex justify-content-center align-items-center mx-1">
	    											<span><i class="ion-ios-cart"></i></span>
													</a>
													<?php
													}
                                                }
                                                
												?>
	    							
    							</div>
    						</div>
    					</div>
    				</div>
				</div>
				<?php } ?>
    			
    		</div>
    		
    	
   
            <?php 
    $this->load->view("utemplate/footer");
    ?>
  

 