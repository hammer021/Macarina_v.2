<?php
// require 'koneksi.php';
// define('BASEPATH', dirname(__FILE__));
// //include_once('../config/head.php'); 
// include_once "head.php";
?>
<?php
// include_once "topNavbar.php";

  

?>
<?php 
    $this->load->view("atemplate/head");
    ?>
  <!-- Page Wrapper -->
  <div id="wrapper">

 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="home.php">
  <div class="sidebar-brand-icon rotate-n-15">
    <i class="fas fa-laugh-wink"></i>
  </div>
  <div class="sidebar-brand-text mx-3">Macarina</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item">
  <a class="nav-link" href="home.php">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Dashboard</span></a>
</li>

<!-- Nav Item - Charts -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
    <i class="fas fa-fw fa-chart-area"></i>
    <span>Grafik</span>
  </a>
  <div id="collapse2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Data :</h6>
      <a class="collapse-item" href="charts.php">Grafik Produk</a>
      <a class="collapse-item" href="charts2.php">Grafik Reseller</a>
      <!--<a class="collapse-item" href="charts3.php">Grafik Penjualan</a>-->
    </div>
  </div>
</li>

<!-- Nav Item - Tables -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
    <i class="fas fa-fw fa-cog"></i>
    <span>Tables</span>
  </a>
  <div id="collapse3" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Data :</h6>
      <a class="collapse-item" href="admin/tAdmin.php">Admin</a>
      <a class="collapse-item" href="reseller/tReseller.php">Reseller</a>
      <a class="collapse-item" href="barang/tBarang.php">Barang</a>
      <a class="collapse-item" href="transaksi/transaksi.php">Transaksi</a>
    </div>
  </div>
</li>

<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
    <i class="fas fa-fw fa-folder"></i>
    <span>Laporan</span>
  </a>
  <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Report:</h6>
      <a class="collapse-item" href="report/laporan_transaksi.php">Laporan Transaksi</a>
    </div>
  </div>
</li>
                           
<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>
</ul>

   
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1></div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Reseller</div>
                      <?php
                      $query = mysqli_query($koneksi,"SELECT * FROM reseller");
                      $data = mysqli_num_rows($query);
                      ?>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $data; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Reseller (Aktif)</div>
                      <?php
                      $ak="1"; 
                      $query2 = mysqli_query($koneksi,"SELECT * FROM reseller WHERE status ='$ak'");
                      $data2 = mysqli_num_rows($query2);
                      ?>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $data2; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Admin (Karyawan)</div>
                      <?php
                      $query3 = mysqli_query($koneksi,"SELECT * FROM admin");
                      $data3 = mysqli_num_rows($query3);
                      ?>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $data3; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Jumlah Barang</div>
                      <?php
                      $query4 = mysqli_query($koneksi,"SELECT * FROM barang");
                      $data4 = mysqli_num_rows($query4);
                      ?>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $data4; ?></div>
                    </div>
                    <div class="col-auto">
                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->

          <div class="row">

           
            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Pendapatan Produk</h6>
                </div>
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                  </div>
                  <hr>
                  <span class="text-danger">Data Penjualan Produk Tiap Bulan</span>
                </div>
              </div>
            </div>

            <div class="col-lg-5 col-xl-4 mb-4">
       
              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Pembayaran Transaksi Terbaru</h6>
                </div>
                <div class="card-body">
                  <?php 

                  $query = "SELECT reseller.nama_reseller, transaksi.grand_total
                  FROM reseller, transaksi, pembayaran
                  WHERE transaksi.id_reseller = reseller.id_reseller AND
                  transaksi.kd_transaksi = pembayaran.kd_transaksi
                  AND pembayaran.status_pesan = '0'
                  ORDER BY transaksi.tgl_transaksi DESC LIMIT 5";
                    
                    $hasil = mysqli_query($koneksi, $query);
                    
                    while ($pembayaran_terbaru = mysqli_fetch_array($hasil)) {
                                        
                  ?>

                  <div class="row">
                    
                    <div class="col-12">
                      <h3 class="h6 font-weight-bolder text-dark"><?php echo $pembayaran_terbaru['nama_reseller']; ?></h3>
                      <p class="text-muted">Rp <?php echo number_format($pembayaran_terbaru['grand_total']); ?></p>
                    </div>
                  </div>
                    <?php } ?>
                  <a href="transaksi/transaksi.php" class="btn btn-outline-primary btn-block">Selengkapnya</a>
                </div>
              </div>
            </div>

          </div>

          <!-- Content Row -->
          
          <div class="row">
            

            <div class="col-lg-6 mb-4">


              <!-- Approach -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Macarina</h6>
                </div>
                <div class="card-body">
                  <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce CSS bloat and poor
                    page performance. Custom CSS classes are used to create custom components and custom utility
                    classes.</p>
                  <p class="mb-0">Before working with this theme, you should become familiar with the Bootstrap
                    framework, especially the utility classes.</p>
                </div>
              </div>

            </div>
            </div>

        </div>
     
        <!-- /.container-fluid -->

      </div>
</div>
      <!-- End of Main Content -->

    <!-- Footer -->
 <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Website Macarina 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="index.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

 <!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <script>
Chart.defaults.global.defaultFontFamily = 'Nunito',
      '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    function number_format(number, decimals, dec_point, thousands_sep) {
      // *     example: number_format(1234.56, 2, ',', ' ');
      // *     return: '1 234,56'
      number = (number + '').replace(',', '').replace(' ', '');
      var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
          var k = Math.pow(10, prec);
          return '' + Math.round(n * k) / k;
        };
      // Fix for IE parseFloat(0.55).toFixed(0) = 0;
      s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
      if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
      }
      if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
      }
      return s.join(dec);
    }
var ctx = document.getElementById("myAreaChart");
    var myLineChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: [
          <?php 
            $query = "SELECT SUM(transaksi.grand_total) AS TOTAL, DATE_FORMAT(transaksi.tgl_transaksi, '%M %Y') AS BULAN
            FROM transaksi, pembayaran
            WHERE pembayaran.kd_transaksi = transaksi.kd_transaksi AND pembayaran.status_pesan = '0'
            GROUP BY MONTH (transaksi.tgl_transaksi)
            HAVING SUM(transaksi.grand_total)
            ORDER BY (transaksi.tgl_transaksi) ASC";

            $hasil = mysqli_query($koneksi, $query);
  
            while($data_bulanan = mysqli_fetch_array($hasil)){
              echo "'".$data_bulanan['BULAN']."'".", ";
            }
            ?>
        ],
        datasets: [{
          label: "Pendapatan",
          lineTension: 0.3,
          backgroundColor: "rgba(78, 115, 223, 0.05)",
          borderColor: "rgba(78, 115, 223, 1)",
          pointRadius: 3,
          pointBackgroundColor: "rgba(78, 115, 223, 1)",
          pointBorderColor: "rgba(78, 115, 223, 1)",
          pointHoverRadius: 3,
          pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
          pointHoverBorderColor: "rgba(78, 115, 223, 1)",
          pointHitRadius: 10,
          pointBorderWidth: 2,
          data: [
            <?php   
             $query = "SELECT SUM(transaksi.grand_total) AS TOTAL, DATE_FORMAT(transaksi.tgl_transaksi, '%M %Y') AS BULAN
             FROM transaksi, pembayaran
             WHERE pembayaran.kd_transaksi = transaksi.kd_transaksi AND pembayaran.status_pesan = '0'
             GROUP BY MONTH (transaksi.tgl_transaksi)
             HAVING SUM(transaksi.grand_total)
             ORDER BY (transaksi.tgl_transaksi) ASC";

              $hasil = mysqli_query($koneksi, $query);

              while($data_bulanan = mysqli_fetch_array($hasil)){
                echo $data_bulanan['TOTAL'].', ';
              }
              ?>
          ],
        }],
      },
      options: {
        maintainAspectRatio: false,
        layout: {
          padding: {
            left: 10,
            right: 25,
            top: 25,
            bottom: 0
          }
        },
        scales: {
          xAxes: [{
            time: {
              unit: 'date'
            },
            gridLines: {
              display: false,
              drawBorder: false
            },
            ticks: {
              maxTicksLimit: 7
            }
          }],
          yAxes: [{
            ticks: {
              maxTicksLimit: 5,
              padding: 10,
              // Include a dollar sign in the ticks
              callback: function (value, index, values) {
                return 'Rp ' + number_format(value);
              }
            },
            gridLines: {
              color: "rgb(234, 236, 244)",
              zeroLineColor: "rgb(234, 236, 244)",
              drawBorder: false,
              borderDash: [2],
              zeroLineBorderDash: [2]
            }
          }],
        },
        legend: {
          display: false
        },
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          titleMarginBottom: 10,
          titleFontColor: '#6e707e',
          titleFontSize: 14,
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          intersect: false,
          mode: 'index',
          caretPadding: 10,
          callbacks: {
            label: function (tooltipItem, chart) {
              var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
              return datasetLabel + ': Rp ' + number_format(tooltipItem.yLabel);
            }
          }
        }
      }
    });

  </script>
</body>

</html>
