<?php 

$this->load->view("utemplate/header");
?>
    <section class="ftco-section ftco-no-pb ftco-no-pt bg-light">
			<div class="container">
				<div class="row">
					<div class="col-md-5 p-md-5" >
          <p>Anda belum punya akun ? Yuk Join!<p>
					<p>Dengan bergabung sebagai reseller, Anda akan lebih mudah untuk mengorganisir stok ketersediaan dan masih banyak promo untuk Reseller</p>
          <a href="#" class="btn btn-primary">Daftar Sekarang</a>
					</div>
					<div class="col-md-7 py-5 wrap-about pb-md-5 ftco-animate">
	          <div class="heading-section-bold mb-4 mt-md-5">
	          	<div class="ml-md-0">
		            <h2 class="mb-4">Selamat Datang di Website Macarina</h2>
	            </div>
	          </div>
	          <div class="pb-md-5">
           
            <form class="user" method="post" action="<?php echo base_url('Login/aksi_login');?>">
                    <div class="form-group">
                      <input type="email" name ="email"  class="form-control form-control-user" id="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                      <input type="password" name ="password" class="form-control form-control-user" id="password" placeholder="Password">
                    </div>
                    
                    <label>
                        <input type="checkbox"  name="login">Remember Me</label>
						<a href="<?php echo base_url('LupaPassword/index'); ?>">Lupa Password?</a>
                              <button class="btn btn-primary btn-user btn-block" href="<?php echo base_url('Home');?>">
							Login
						</button>
    
                <?php 
	                  if(isset($_GET['pesan'])){
		                  if($_GET['pesan'] == "gagal"){
		          	        echo "Login gagal! email dan password salah!";
		                  }else if($_GET['pesan'] == "gagalstatus"){
                        echo "Akun anda belum diaktifkan oleh Admin";
                      }
		               }
	                ?>
            </form>
            </div>
            
					</div>
				</div>
			</div>
		</section>

        <?php 
    $this->load->view("utemplate/footer");
    ?>
    
  
