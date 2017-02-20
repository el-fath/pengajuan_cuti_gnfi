<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
  <!--   <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- Font Awesome -->
    <!-- <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet"> -->
    <!-- NProgress -->
    <!-- <link href="vendors/nprogress/nprogress.css" rel="stylesheet"> -->
    <!-- iCheck -->
<!--     <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet"> -->
    <!-- bootstrap-progressbar -->
    <!-- <link href="vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet"> -->
    <!-- JQVMap -->
    <!-- <link href="vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/> -->
    <!-- bootstrap-daterangepicker -->
    <!-- <link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet"> -->

    <!-- Custom Theme Style -->
<!--     <link href="build/css/custom.min.css" rel="stylesheet"> -->
  </head>

  <body class="nav-md">
 <?php 
    session_start();
    include 'koneksi.php';
    if ($_SESSION['status_pegawai'] != 'admin') {
      header('location:../login.php');
    } else {    
  ?>
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.php" class="site_title"><img src="img/gnfi_logo.png" style="width: 30px; height: 30px; padding-left: 5px;" alt=""> <span>GNFI Dashboard</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
              <?php  
               $id_pegawai = $_SESSION['id_pegawai'];
               $sql = mysqli_query($conn,"SELECT * FROM pegawai WHERE id_pegawai = '$id_pegawai'") or die(mysqli_error($conn));
               while ($b = mysqli_fetch_assoc($sql)) {
              ?>
                <img src="<?php echo"img/".$b['foto']; ?>" alt="..." class="img-circle profile_img">
                <?php } ?>
              </div>

              <div class="profile_info" style="padding-left: 30px">
                <span><h3>Welcome,</h3></span>
                <h2><?php echo $_SESSION['username']; ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <!-- <h3>General</h3> -->
                <ul class="nav side-menu">
                  <li><a href="index.php"><i class="fa fa-home"></i> Home </span></a>
                  </li>
                  <li><a><i class="fa fa-tasks"></i> Master Data <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="list_jabatan.php">List Jabatan</a></li>
                      <li><a href="list_kategori.php">List Kategori Barang</a></li>
                      <li><a href="list_jenis_cuti.php">List Jenis Cuti</a></li>
                      <li><a href="list_pegawai.php">Data Pegawai</a></li>
                      <li><a href="data_barang.php">Data Pengajuan Barang</a></li>
                      <li><a href="data_cuti.php" title="">Data Pengajuan Cuti</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
              
            </div>
            <!-- /sidebar menu -->

            
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <!-- <img src="images/img.jpg" alt=""> --><?php echo $_SESSION['username']; ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="../ubah_password.php?&id_pegawai=<?php echo $_SESSION['id_pegawai']; ?>">Ganti Password</a></li>
                    <li><a href="proses/logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

       

        <!-- footer content -->
       <!--  <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer> -->
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <!-- <script src="vendors/jquery/dist/jquery.min.js"></script> -->
    <!-- Bootstrap -->
    <!-- <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script> -->
    <!-- FastClick -->
    <!-- <script src="vendors/fastclick/lib/fastclick.js"></script> -->
    <!-- NProgress -->
    <!-- <script src="vendors/nprogress/nprogress.js"></script> -->
    <!-- Chart.js -->
   <!--  <script src="vendors/Chart.js/dist/Chart.min.js"></script> -->
    <!-- gauge.js -->
    <!-- <script src="vendors/gauge.js/dist/gauge.min.js"></script> -->
    <!-- bootstrap-progressbar -->
    <!-- <script src="vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script> -->
    <!-- iCheck -->
    <!-- <script src="vendors/iCheck/icheck.min.js"></script> -->
    <!-- Skycons -->
    <!-- <script src="vendors/skycons/skycons.js"></script> -->
    <!-- Flot -->
    <!-- <script src="vendors/Flot/jquery.flot.js"></script> -->
    <!-- <script src="vendors/Flot/jquery.flot.pie.js"></script> -->
    <!-- <script src="vendors/Flot/jquery.flot.time.js"></script> -->
    <!-- <script src="vendors/Flot/jquery.flot.stack.js"></script> -->
    <!-- <script src="vendors/Flot/jquery.flot.resize.js"></script> -->
    <!-- Flot plugins -->
    <!-- <script src="vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script> -->
    <!-- <script src="vendors/flot-spline/js/jquery.flot.spline.min.js"></script> -->
    <!-- <script src="vendors/flot.curvedlines/curvedLines.js"></script> -->
    <!-- DateJS -->
    <!-- <script src="vendors/DateJS/build/date.js"></script> -->
    <!-- JQVMap -->
    <!-- <script src="vendors/jqvmap/dist/jquery.vmap.js"></script> -->
    <!-- <script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script> -->
    <!-- <script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script> -->
    <!-- bootstrap-daterangepicker -->
    <!-- <script src="vendors/moment/min/moment.min.js"></script> -->
    <!-- <script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script> -->

    <!-- Custom Theme Scripts -->
    <!-- <script src="build/js/custom.min.js"></script> -->


    <!-- Flot -->
   
  </body>
  <?php } ?>
</html>
