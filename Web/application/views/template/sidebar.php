<?php 
      $url =  $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>
<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true" data-img="<?php echo base_url('theme-assets/images/backgrounds/02.jpg')?> ?>">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">       
          <li class="<?php  
          if($url == "localhost/Macarina_v.2/Web/HomeAdm/index")
          echo 'active';
          else
          echo 'nav-item mr-auto'; ?>">
          <a class="navbar-brand" href="<?php echo base_url('HomeAdm/index')?>">
          <img class="brand-logo" alt="Chameleon admin logo" src="<?php echo base_url('theme-assets/images/logo/logo.png')?>"/>
              <h3 class="brand-text">Macarina</h3></a></li>
          <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
        </ul>
      </div>
      <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        
          <li class="<?php  
          if($url == "localhost/Macarina_v.2/Web/HomeAdm/index")
          echo 'active';
          else
          echo 'nav-item'; ?>">
          <a href="<?php echo base_url('HomeAdm/index')?>"><i class="ft-home"></i><span class="menu-title" data-i18n="">Dashboard</span></a>
          </li>
          <li class="<?php
          if($url == "localhost/Macarina_v.2/Web/Home/charts")
          echo 'active';
          else
          echo 'nav-item';
           ?>"><a href="<?php echo base_url('HomeAdm/charts')?>"><i class="ft-pie-chart"></i><span class="menu-title" data-i18n="">Charts</span></a>
          </li>
          <li class="<?php
          if($url == "localhost/Macarina_v.2/Web/HomeAdm/barang")
          echo 'active';
          else
          echo 'nav-item';
           ?>"><a href="<?php echo base_url('HomeAdm/barang')?>"><i class="ft-message-circle"></i><span class="menu-title" data-i18n="">Data Barang</span></a>
          </li>
          <li class="<?php
          if($url == "localhost/Macarina_v.2/Web/HomeAdm/reseller")
          echo 'active';
          else
          echo 'nav-item';
           ?>"><a href="<?php echo base_url('HomeAdm/reseller')?>"><i class="ft-message-circle"></i><span class="menu-title" data-i18n="">Data Reseller</span></a>
          </li>
          </li>
          <li class="<?php
          if($url == "localhost/Macarina_v.2/Web/HomeAdm/shop")
          echo 'active';
          else
          echo 'nav-item';
           ?>"><a href="<?php echo base_url('HomeAdm/shop')?>"><i class="ft-message-circle"></i><span class="menu-title" data-i18n="">shop</span></a>
          </li>
        </ul>
      </div>
      <div class="navigation-background"></div>
    </div>

    
         
          