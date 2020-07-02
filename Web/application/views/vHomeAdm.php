
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
        </div>
        <div class="content-body"><!-- Chart -->
<div class="row match-height">
    <div class="col-12">
        <div class="">
            <div id="gradient-line-chart1" class="height-250 GradientlineShadow1"></div>
        </div>
    </div>
</div>
<!-- Chart -->


<!-- Statistics -->
<div class="row match-height">
    
    <div class="col-xl-4 col-lg-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <h4 class="card-title">Barang</h4>
                    <h6 class="card-subtitle text-muted">List View</h6>
                </div>
                <div id="carousel-area" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-area" data-slide-to="0" ></li>
                        <li data-target="#carousel-area" data-slide-to="1"></li>
                        <li data-target="#carousel-area" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <?php foreach ($barangs as $brg):?>
                        <div class="carousel-item 
                        <?php if ($brg->kd_barang == "BR00001"){
                            echo "active";}
                            else {
                                echo "";
                            }?>">
                            <img src="theme-assets/images/barang/<?php echo $brg->gambar_brg;?>" class="d-block w-100 h-100" alt=" slide">
                        </div>
                        <?php   endforeach;?>
                    </div>
                    <a class="carousel-control-prev" href="#carousel-area" role="button" data-slide="prev">
                            <span class="la la-angle-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                    <a class="carousel-control-next" href="#carousel-area" role="button" data-slide="next">
                            <span class="la la-angle-right icon-next" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                </div>
                <div class="card-body">
                    <a href="" class="card-link">List barang</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-12">
            <div class="card">
               
            </div>
    </div>
    <div class="col-xl-4 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Reseller</h4>
                <a class="heading-elements-toggle">
                    <i class="fa fa-ellipsis-v font-medium-3"></i>
                </a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li>
                            <a data-action="reload">
                                <i class="ft-rotate-cw"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-content">
                <div id="recent-buyers" class="media-list">
                    <?php foreach($res as $reseller):?>
                    <a href="#" class="media border-0">
                        <div class="media-left pr-1">
                            <span class="avatar avatar-md avatar-online">
                                <img class="media-object rounded-circle" src="uploads/reseller/pas_foto/<?php echo $reseller->pas_foto?>" alt="Generic placeholder image">
                                <i></i>
                            </span>
                        </div>
                        <div class="media-body w-100">
                            <span class="list-group-item-heading"><?php echo $reseller->nama_reseller?>

                            </span>
                            
                            <p class="list-group-item-text mb-0">
                                <span class="blue-grey lighten-2 font-small-3"> <?php echo $reseller->no_tlp?>
                                </span></br>
                                <span class="blue-grey lighten-2 font-small-3"> <?php echo $reseller->alamat?>
                                </span>
                            </p>
                        </div>
                    </a>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ Statistics -->
        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <?php 
    $this->load->view("template/footer");
    ?>

   