<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true" data-img="<?php echo base_url('theme-assets/images/backgrounds/02.jpg')?> ?>">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">       
          <li class="nav-item mr-auto"><a class="navbar-brand" href="index.html"><img class="brand-logo" alt="Chameleon admin logo" src="<?php echo base_url('theme-assets/images/logo/logo.png')?>"/>
              <h3 class="brand-text">Chameleon</h3></a></li>
          <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
        </ul>
      </div>
      <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <?php 
          $url =  $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>
          <li class="<?php  
          if($url == "localhost/rentcar/Home/index")
          echo 'active';
          else
          echo 'nav-item'; ?>">
          <a href="<?php echo base_url('Home/index')?>"><i class="ft-home"></i><span class="menu-title" data-i18n="">Dashboard</span></a>
          </li>
          <li class="<?php
          if($url == "localhost/rentcar/Home/charts")
          echo 'active';
          else
          echo 'nav-item';
           ?>"><a href="<?php echo base_url('Home/charts')?>"><i class="ft-pie-chart"></i><span class="menu-title" data-i18n="">Charts</span></a>
          </li>
          <li class="<?php
          if($url == "localhost/rentcar/Home/tables")
          echo 'active';
          else
          echo 'nav-item';
           ?>"><a href="<?php echo base_url('Home/tables')?>"><i class="ft-message-circle"></i><span class="menu-title" data-i18n="">Tables</span></a>
          </li>
        </ul>
      </div><a class="btn btn-danger btn-block btn-glow btn-upgrade-pro mx-1" href="https://themeselection.com/products/chameleon-admin-modern-bootstrap-webapp-dashboard-html-template-ui-kit/" target="_blank">Download PRO!</a>
      <div class="navigation-background"></div>
    </div>

    
         
          