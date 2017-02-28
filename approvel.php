<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>INTERNAL WEBSITE GNFI</title>
    <!--REQUIRED STYLE SHEETS-->
    <link rel="shortcut icon" type="image/x-icon" href="1487735199.ico">
    <!-- BOOTSTRAP CORE STYLE CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLE CSS -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
    <!--ANIMATED FONTAWESOME STYLE CSS -->
    <link href="assets/css/font-awesome-animation.css" rel="stylesheet" />
     <!--PRETTYPHOTO MAIN STYLE -->
    <link href="assets/css/prettyPhoto.css" rel="stylesheet" />
       <!-- CUSTOM STYLE CSS -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <link href="assets/css/ihover.css" rel="stylesheet" />
</head>
<body>
    <?php include 'header.php'; ?>
    <?php include 'koneksi.php'; ?>
    <!--HOME SECTION-->
    <div id="home-sec">
    <div class="container" >
        <div class="row text-center">
            <div  class="col-md-12 col-sm-12" >
                <div class="col-md-12">
                <!-- <img src="assets/img/gnfi.png" style="width: 350px; height: 110px;" alt="">                    -->
                </div>
                <a  href="#port-sec">
                <?php  
                   $id_pegawai = $_SESSION['id_pegawai'];
                   $sql = mysqli_query($conn,"SELECT * FROM pegawai WHERE id_pegawai = '$id_pegawai'") or die(mysqli_error($conn));
                   while ($b = mysqli_fetch_assoc($sql)) {
                ?>
                <img src="<?php echo"admin/img/".$b['foto']; ?>" alt="..." class="img-circle profile_img" style="width: 200px; height: 200px">
                <?php } ?>
                </a>
            </div>
            <?php 
                $id_pegawai = $_SESSION['id_pegawai'];
                $sql = "SELECT * FROM pegawai WHERE id_pegawai ='$id_pegawai'";
                $s = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                while ($row = mysqli_fetch_assoc($s)) {
                ?>
                <div class="col-md-4 col-md-offset-4  col-sm-6 col-sm-offset-3">
                <h4>Welcome To Good News <?php echo $_SESSION['username']; ?></h4>
                <h4>Sisa Cuti Anda <?php echo $row['jatah_cuti']; }?> Hari</h4>
                </div>
        </div>
    </div>
    </div>
    <div class="container">
        <h2><center>Halaman Approvel</center></h2>
        <table border="2" align="center">
            <caption>table title</caption>
            <thead>
                <tr>
                    <th>header</th>
                    <th>header</th>
                    <th>header</th>
                    <th>header</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>data</td>
                    <td>data</td>
                    <td>data</td>
                    <td>data</td>
                </tr>
            </tbody>
        </table>
    </div>
    <!--END CONTACT SECTION-->

    <!--FOOTER SECTION -->
    <?php include 'footer.php'; ?>
    <!-- END FOOTER SECTION -->

    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
<!--     <script src="jquery-2.2.2.js"></script> -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <!-- BOOTSTRAP CORE SCRIPT   -->
    <script src="assets/plugins/bootstrap.min.js"></script>  
     <!-- ISOTOPE SCRIPT   -->
  <!--   <script src="assets/plugins/jquery.isotope.min.js"></script> -->
    <!-- PRETTY PHOTO SCRIPT   -->
    <script src="assets/plugins/jquery.prettyPhoto.js"></script>    
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
  <!--   <script src="http://cdn.jsdelivr.net/webshim/1.12.4/extras/modernizr-custom.js"></script> -->
    <!-- polyfiller file to detect and load polyfills -->
    <!-- <script src="http://cdn.jsdelivr.net/webshim/1.12.4/polyfiller.js"></script>
    <script>
      webshims.setOptions('waitReady', false);
      webshims.setOptions('forms-ext', {types: 'date'});
      webshims.polyfill('forms forms-ext');
    </script> -->
</body>
</html>
