	
	<?php 
    $this->load->view("utemplate/header");
    ?>

    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_testi.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span></p>
            <h1 class="mb-0 bread">Testimonials</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="site-section" id="portfolio-section">
      

      <div class="container">
        <div class="row mb-3">
          <div class="col-12 text-center" data-aos="fade"><br>
            <h2 class="section-title mb-3">Testimonials</h2>
          </div>
        </div>
        <div id="posts" class="row no-gutter">

        <?php
				include_once "config.php";
				$query = mysqli_query($koneksi,"SELECT * FROM konten");
				while ($data = mysqli_fetch_array($query)){
					$id = $data ['id_konten'];
					$keterangan = $data ['keterangan'];
				?>

          <div class="item web col-sm-6 col-md-4 col-lg-4 col-xl-3 mb-4">
              <img class="img-fluid" <?php echo "src='admin/img/konten/".$data['gambar']."'" ?>>
              <div class="text py-3 pb-4 px-3 text-center">
    						<h3><?php echo $keterangan?></h3>
              </div>
          </div>
        <?php } ?>

        </div>
      </div>

    </section>
    
		    				


<!--::review_part start::-->
<section class="ftco-section testimony-section">
      <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section ftco-animate text-center">
          	<span class="subheading">Testimoni</span>
            <h2 class="mb-4">Testimonial Para Macariners</h2>
             </div>
        </div>
        <div class="row ftco-animate">
          <div class="col-md-12">
            <div class="carousel-testimony owl-carousel">
              <div class="item">
                <div class="testimony-wrap p-4 pb-5">
                  <div class="user-img mb-5" style="background-image: url(images/testi1.jpg)">
                    <span class="quote d-flex align-items-center justify-content-center">
                      <i class="icon-quote-left"></i>
                    </span>
                  </div>
                  <div class="text text-center">
                    <p class="mb-5 pl-4 line">Jajanan asik dan enak</p>
                    <p class="name">Dinda Endy</p>
                    <span class="position">Customer Banyuwangi</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap p-4 pb-5">
                  <div class="user-img mb-5" style="background-image: url(images/testi2.jpg)">
                    <span class="quote d-flex align-items-center justify-content-center">
                      <i class="icon-quote-left"></i>
                    </span>
                  </div>
                  <div class="text text-center">
                    <p class="mb-5 pl-4 line">Asli bikin nagih</p>
                    <p class="name">Febby Eka</p>
                    <span class="position">Customer Jember</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap p-4 pb-5">
                  <div class="user-img mb-5" style="background-image: url(images/testi1.jpg)">
                    <span class="quote d-flex align-items-center justify-content-center">
                      <i class="icon-quote-left"></i>
                    </span>
                  </div>
                  <div class="text text-center">
                    <p class="mb-5 pl-4 line">Beli 1 kurang beli 2 kenyang wkwk</p>
					<p class="name">Avinda</p>
                    <span class="position">Customer Malang</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap p-4 pb-5">
                  <div class="user-img mb-5" style="background-image: url(images/testii.jpg)">
                    <span class="quote d-flex align-items-center justify-content-center">
                      <i class="icon-quote-left"></i>
                    </span>
                  </div>
                  <div class="text text-center">
                    <p class="mb-5 pl-4 line">Jajanan masa kecil dan pasti higenis</p>
					<p class="name">Nur Izzah</p>
                    <span class="position">Customer Surabaya</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap p-4 pb-5">
                  <div class="user-img mb-5" style="background-image: url(images/testi4.jpg)">
                    <span class="quote d-flex align-items-center justify-content-center">
                      <i class="icon-quote-left"></i>
                    </span>
                  </div>
                  <div class="text text-center">
                    <p class="mb-5 pl-4 line">Oleh-oleh asinan yang wajib dibeli di Jember</p>
					<p class="name">Adinda Putri</p>
                    <span class="position">Customer Mojokerto</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>  

    <!--::review_part end::-->


  	
	<?php 
    $this->load->view("utemplate/footer");
    ?>

  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

  <script src="<?php echo base_url("js/jquery.min.js")?>"></script>
  <script src="<?php echo base_url("js/jquery-migrate-3.0.1.min.js")?>"></script>
  <script src="<?php echo base_url("js/popper.min.js")?>"></script>
  <script src="<?php echo base_url("js/bootstrap.min.js")?>"></script>
  <script src="<?php echo base_url("js/jquery.easing.1.3.js")?>"></script>
  <script src="<?php echo base_url("js/jquery.waypoints.min.js")?>"></script>
  <script src="<?php echo base_url("js/jquery.stellar.min.js")?>"></script>
  <script src="<?php echo base_url("js/owl.carousel.min.js")?>"></script>
  <script src="<?php echo base_url("js/jquery.magnific-popup.min.js")?>"></script>
  <script src="<?php echo base_url("js/aos.js")?>"></script>
  <script src="<?php echo base_url("js/jquery.animateNumber.min.js")?>"></script>
  <script src="<?php echo base_url("js/bootstrap-datepicker.js")?>"></script>
  <script src="<?php echo base_url("js/scrollax.min.js")?>"></script>
  <script src="<?php echo base_url("https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false")?>"></script>
  <script src="<?php echo base_url("js/google-map.js")?>"></script>
  <script src="<?php echo base_url("js/main.js")?>"></script>

    
  </body>
</html>