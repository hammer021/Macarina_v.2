<?php 
    $this->load->view("utemplate/header");
    ?>
  

    
  <div class="container">
    <h1>REGISTER</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>
      <form method ="POST" action="<?php echo base_url('Daftar/aksi_daftar');?>" enctype="multipart/form-data">
    <label for="nama-lengkap"><b>Nama Lengkap</b></label></br>
    <input type="text" placeholder="Enter Nama (sesuai KTP)"  name="nama-lengkap" required>
    </br>
    <label for="email"><b>Email</b></label></br>
    <input type="text" placeholder="Enter Email" name="email" required>
    </br>
    <label for="no-hp"><b>Nomor HP</b></label></br>
    <input type="text" placeholder="Enter Nomor HP" name="no-hp" required>
    </br>
    <label for="psw"><b>Password</b></label></br>
    <input type="password" placeholder="Enter Password"  name="password" required>
    </br>
    <label for="psw-repeat"><b>Repeat Password</b></label></br>
    <input type="password" placeholder="Repeat Password" name="psw-repeat" required>

    <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
    <input type="submit" name ="submit" class="registerbtn" value="Register"></input>
  
  <div class="container signin">
    <p>Already have an account? <a href="<?php echo base_url('Login/index')?>">Sign In</a>.</p>
  </div>
  <div style="text-align:center;margin-top:40px;">
  <span class="step"></span>
  <span class="step"></span>
  <span class="step"></span>
  <span class="step"></span>
</div>
</form> 

<?php 
    $this->load->view("utemplate/footer");
    ?>