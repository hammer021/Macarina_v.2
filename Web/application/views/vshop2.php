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
    					<li><a href="<?php echo base_url('Home/shop');?>" class="">Box </a></li>
    				</ul>
    			</div>
    		</div>
    		<div class="row">
			<?php
				foreach ($barang as $produk):
				?>
    			<div class="col-md-6 col-lg-3 ftco-animate">
    				<div class="product">
    					<a href="#" class="img-prod"><img class="img-fluid" <?php echo "src='".$produk->gambar_brg."'" ?> alt="Colorlib Template">
    						<div class="overlay"></div>
    					</a>
    					<div class="text py-3 pb-4 px-3 text-center">
							<h3><a href="#"> <?php echo $produk->nama_barang?></a></h3>
    						<div class="d-flex">
    							<div class="pricing">
								
		    						<p class="price"><span class="price-sale">Rp <?php echo $produk->harga?></span></p>
		    					</div>
	    					</div>
	    					<div class="bottom-area d-flex px-3">
	    						<div class="m-auto d-flex">
                                    <?php 
									 
											endforeach;
												?>
	    							
    							</div>
    						</div>
    					</div>
    				</div>
				</div>
    			
    		</div>
		</div>
    </section>
    	
   
            <?php 
    $this->load->view("utemplate/footer");
    ?>
  

 