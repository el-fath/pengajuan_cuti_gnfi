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
<body >
    <<?php include 'header.php'; ?>
    <<?php include 'koneksi.php'; ?>
    <!--HOME SECTION-->
    <div id="home-sec">
    <div class="container"  >
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
                        <h4>Welcome To GNFI <?php session_start(); echo $_SESSION['username']; ?> Sisa Cuti Anda <?php echo $row['jatah_cuti']; }?> Hari</h4>
                </div>
        </div>
    </div>
    </div>
    <!--END HOME SECTION--> 
    <!-- PORTFOLIO SECTION-->
   <section id="port-sec">
       <div class="container-fluid">
           <div class="row g-pad-bottom" >
                    <?php
                    if(isset($_GET['id_pcuti'])){
                    include "cetak_men.php";
                    }?> <div class="col-md-4 col-sm-4">
                        <div class="portfolio-item">
                            <div class="item-main">
                                <div class="portfolio-image">
                                    <img src="assets/img/98598-OLDMHL-591.jpg" alt="">
                                    <div class="overlay">
                                        <button class="preview btn btn-primary" data-toggle="modal" data-target=".ajukan_cuti"><i class="glyphicon glyphicon-pencil"></i></button>
                                    </div>
                                </div>
                                <h5>AJUKAN CUTI</h5>
                            </div>
                        </div>
                        </div>                     
                        <div class="col-md-4 col-sm-4">
                        <div class="portfolio-item">
                            <div class="item-main">
                                <div class="portfolio-image">
                                  <?php  
                                       $id_pegawai = $_SESSION['id_pegawai'];
                                       $sql = mysqli_query($conn,"SELECT * FROM pegawai WHERE id_pegawai = '$id_pegawai'") or die(mysqli_error($conn));
                                       while ($b = mysqli_fetch_assoc($sql)) {
                                    ?>
                                    <img src="<?php echo "admin/img/".$b['foto']; ?>" alt="" style="width: 275px; height: 275px">
                                     <?php } ?>
                                    <div class="overlay">
                                        <button class="preview btn btn-success" data-toggle="modal" data-target=".biodata"><i class="glyphicon glyphicon-eye-open"></i></button>
                                    </div>
                                </div>
                                <h5>BIODATA</h5>
                            </div>
                        </div>
                        </div> 
                        <div class="col-md-4 col-sm-4">
                        <div class="portfolio-item">
                            <div class="item-main">
                                <div class="portfolio-image">
                                    <img src="assets/img/3.jpg" alt="">
                                    <div class="overlay">
                                        <button class="preview btn btn-primary" data-toggle="modal" data-target=".ajukan_barang"><i class="glyphicon glyphicon-pencil"></i></button>
                                    </div>
                                </div>
                                <h5>AJUKAN BARANG ATAU ANGGARAN</h5>
                            </div>
                        </div>
                        </div> 
                        <div class="col-md-4 col-sm-4">
                        <div class="portfolio-item">
                            <div class="item-main">
                                <div class="portfolio-image">
                                    <img src="assets/img/datacuti.png" alt="">
                                    <div class="overlay">
                                        <button class="preview btn btn-success" data-toggle="modal" data-target=".data_cuti"><i class="glyphicon glyphicon-eye-open"></i></button>
                                    </div>
                                </div>
                                <h5>DATA CUTI</h5>
                            </div>
                        </div>
                        </div> 
                        <div class="col-md-4 col-sm-4">
                        <div class="portfolio-item">
                            <div class="item-main">
                                <div class="portfolio-image">
                                    <img src="assets/img/4.jpg" alt="" >
                                    <div class="overlay">
                                        <button class="preview btn btn-warning" data-toggle="modal" data-target=".edit_biodata"><i class="glyphicon glyphicon-pencil"></i></button>
                                    </div>
                                </div>
                                <h5>EDIT BIODATA</h5>
                            </div>
                        </div>
                        </div> 
                        <div class="col-md-4 col-sm-4">
                        <div class="portfolio-item">
                            <div class="item-main">
                                <div class="portfolio-image">
                                    <img src="assets/img/OIUH600.png" alt="">
                                    <div class="overlay">
                                        <button class="preview btn btn-success" data-toggle="modal" data-target=".data_barang"><i class="glyphicon glyphicon-eye-open"></i></button>
                                    </div>
                                </div>
                                <h5>DATA BARANG DAN ANGGARAN</h5>
                            </div>
                        </div>
                        </div>
                </div>
           </div>
       </div>
   </section>
     <!-- END PORTFOLIO SECTION-->

<!-- Large modal -->
<div class="modal fade ajukan_cuti" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Form Pengajuan Cuti</h4>
            </div>
            <!--Body-->
            <?php  
              $id_pegawai=$_SESSION['id_pegawai'];
              $q = "SELECT * FROM pegawai WHERE id_pegawai='$id_pegawai'";
              $a = mysqli_query($conn, $q) or die (mysqli_error($conn));
              while ($t = mysqli_fetch_assoc($a)) {
            ?>
            <div class="modal-body">
            <form action="proses/tambah_cuti.php" method="POST" enctype="multipart/form-data">
                <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <tr>
                        <th>Jenis Cuti</th>
                        <th><select name="id_jcuti" class="form-control">
                          <?php  
                             $sql = "SELECT * FROM jenis_cuti";
                             $s = mysqli_query($conn, $sql) or die (mysqli_error($conn));
                             while ($tmp = mysqli_fetch_assoc($s)) {
                          ?>
                            <option value="<?php echo $tmp['id_jcuti']; ?>"><?php echo $tmp['nama_cuti']; ?></option>
                            <?php } ?>
                          </select></th>
                    </tr>
                    <tr>
                        <th>Tgl Mulai Cuti</th>
                        <th><input class="date-picker form-control col-md-7 col-xs-12" required="required" type="date" name="tgl_mulai_cuti"></th>
                    </tr>
                    <tr>
                        <th>Tgl Akhir Cuti</th>
                        <th><input class="date-picker form-control col-md-7 col-xs-12" required="required" type="date" name="tgl_akhir_cuti"></th>
                    </tr>
                    <tr>
                        <th>Keperluan</th>
                        <th><textarea class="form-control col-md-7 col-xs-12" name="alasan"></textarea></th>
                    </tr>
                </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
            </form>
            <?php } ?>
        </div>
        <!--/.Content-->
    </div>
</div>
<div class="modal fade edit_biodata" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Form Edit Biodata</h4>
            </div>
            <?php 
            $id_pegawai = $_SESSION['id_pegawai'];
            $sql = "SELECT * FROM pegawai WHERE pegawai.id_pegawai = '$id_pegawai'";
            $s = mysqli_query($conn, $sql) or die (mysqli_error($conn));
            while ($temp = mysqli_fetch_assoc($s)) {  
            ?>
            <div class="modal-body">
            <form action="proses/edit_profil.php" method="POST" enctype="multipart/form-data" onsubmit="return validasi_input(this)">
                <div class="table-responsive">                    
                <table class="table table-bordered table-hover table-striped">
                    <tr>
                        <th>Nama Pegawai</th>
                        <th>
                          <input type="hidden" name="id_pegawai" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $temp['id_pegawai']; ?>">
                          <input type="text" name="nama_pegawai" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $temp['nama_pegawai']; ?>">
                        </th>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <th>
                        <input type="text" name="username" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $temp['username']; ?>">
                        </th>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <th>
                          <div id="gender" class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="jenis_kelamin" value="Laki-Laki" <?php if ($temp['jenis_kelamin']=='Laki-Laki') {echo 'checked';} ?> /> &nbsp; Laki-laki &nbsp;
                            </label>
                            <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="jenis_kelamin" value="Perempuan" <?php if ($temp['jenis_kelamin']=='Perempuan') {echo 'checked';} ?>/> Perempuan
                            </label>
                          </div>
                        </th>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <th><input class="form-control col-md-7 col-xs-12" type="email" name="email" value="<?php echo $temp['email']; ?>"></th>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <th><input class="form-control col-md-7 col-xs-12" type="text" name="alamat_pegawai" value="<?php echo $temp['alamat_pegawai']; ?>"></th>
                    </tr>
                    <tr>
                        <th>Telpon</th>
                        <th><input class="form-control col-md-7 col-xs-12" type="tel" name="telpon_pegawai" value="<?php echo $temp['telpon_pegawai']; ?>"></th>
                    </tr>
                    <tr>
                        <th>Foto (Max:1mb)</th>
                        <th><input class="form-control col-md-7 col-xs-12" type="file" name="foto" id="image-source" onchange="previewImage();">
                          <img id="image-preview" class="form-control" style="width: 200px; height: 200px;" src="<?php echo'admin/img/'.$temp['foto']; ?>"></th>
                    </tr>
                </table>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success">Edit</button>
            </div>
            </form>
            <?php } ?>
            <!--Body-->
        </div>
        <!--/.Content-->
    </div>
</div>
<div class="modal fade ajukan_barang" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Form Pengajuan Barang Dan Anggaran</h4>
            </div>
            <!--Body-->
            <?php  
              $id_pegawai=$_SESSION['id_pegawai'];
              $q = "SELECT * FROM pegawai WHERE id_pegawai='$id_pegawai'";
              $a = mysqli_query($conn, $q) or die (mysqli_error($conn));
              while ($t = mysqli_fetch_assoc($a)) {
            ?>
            <div class="modal-body">
            <form action="proses/tambah_barang.php" method="POST" enctype="multipart/form-data">
                <table class="table table-bordered table-hover table-striped">
                    <tr>
                        <th>Barang</th>
                        <th><input type="text" name="nama_barang" value="" class="form-control col-md-7 col-xs-12"></th>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <th>
                            <select name="id_kategori" class="form-control">
                            <?php  
                            $sql = "SELECT * FROM kategori_barang";
                            $s = mysqli_query($conn, $sql) or die (mysqli_error($conn));
                            while ($tmp = mysqli_fetch_assoc($s)) {
                            ?>
                            <option value="<?php echo $tmp['id_kategori']; ?>"><?php echo $tmp['kategori']; ?></option>
                            <?php } ?>
                            </select>
                        </th>
                    </tr>
                    <tr>
                        <th>File</th>
                        <th><input class="form-control col-md-7 col-xs-12" type="file" name="berkas"></th>
                    </tr>
                    <tr>
                        <th>Keperluan</th>
                        <th><textarea class="form-control col-md-7 col-xs-12" name="alasan"></textarea></th>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success" name="btnUpload">Submit</button>
            </div>
            </form>
            <?php } ?>
        </div>
        <!--/.Content-->
    </div>
</div>

<div class="modal fade biodata" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Biodata Anda</h4>
            </div>
            <!--Body-->
            <div class="modal-body">
            <?php
            $id_pegawai=$_SESSION['id_pegawai'];
            $modal=mysqli_query($conn,"SELECT * FROM pegawai INNER JOIN jabatan ON jabatan.id_jabatan = pegawai.id_jabatan WHERE id_pegawai='$id_pegawai'");
            while($r=mysqli_fetch_array($modal)){
            ?>
            <?php include'modal/m_biodata.php'; ?>             
            </div>
            <?php } ?>
            <!--Footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<div class="modal fade data_cuti" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Data Cuti Anda</h4>
            </div>
            <!--Body-->
            <div class="modal-body">
            
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><strong>TGL PENGAJUAN</strong></th>
                            <!-- <th><strong>LAMA CUTI</strong></th> -->
                            <th><strong>MULAI CUTI</strong></th>
                            <th><strong>AKHIR CUTI</strong></th>
                            <th><strong>ALASAN CUTI</strong></th>
                            <th><strong>STATUS</strong></th>
                            <th colspan="2"><center>ACTION</center></th>
                        </tr>
                    </thead>
                    <?php 
                    $id_pegawai=$_SESSION['id_pegawai'];
                    $no=0; 
                    $sql = "SELECT id_pcuti,status, tgl_pengajuan, tgl_mulai_cuti,tgl_akhir_cuti, alasan 
                            FROM permohonan_cuti
                            INNER JOIN pegawai ON pegawai.id_pegawai = permohonan_cuti.id_pegawai WHERE permohonan_cuti.id_pegawai ='$id_pegawai'";
                    $s = mysqli_query($conn, $sql) or die (mysqli_error($conn));
                    $num_rows = mysqli_num_rows($s);
                    if (!empty($num_rows)) {
                    while ($tmp = mysqli_fetch_assoc($s)) {  
                    $no++
                    ?>
                    <tbody>
                        <tr>
                            <td><?php echo $tmp['tgl_pengajuan']; ?></td>
                            <!-- <td><?php echo $tmp['lama_cuti']; ?></td> -->
                            <td><?php echo $tmp['tgl_mulai_cuti']; ?></td>
                            <td><?php echo $tmp['tgl_akhir_cuti']; ?></td>
                            <td><?php echo $tmp['alasan']; ?></td>
                            <td><?php echo $tmp['status']; ?></td>
                            <td align='center'><a href='index.php?&id_pcuti=<?php echo $tmp['id_pcuti']; ?>'><button class='btn btn-success btn-sm'>Detail</button></a></td>
                        </tr>
                     <?php }}else{ ?>
                      <tr>
                      <td align="center" colspan="9">Data Belum Tersedia</td>
                      </tr>
                      <?php } ?>
                    </tbody>
                </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
            <!--Footer-->
        </div>
        <!--/.Content-->
    </div>
</div>

<div class="modal fade data_barang" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Data Barang Dan Anggaran Anda</h4>
            </div>
            <!--Body-->
            <div class="modal-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><strong>NO</strong></th>
                            <!-- <th><strong>JENIS CUTI</strong></th> -->
                            <th><strong>TGL PENGAJUAN</strong></th>
                            <!-- <th><strong>LAMA CUTI</strong></th> -->
                            <th><strong>KATEGORI BARANG</strong></th>
                            <th><strong>NAMA BARANG</strong></th>
                            <th><strong>BERKAS</strong></th>
                            <th><strong>ALASAN</strong></th>
                            <th><strong>STATUS</strong></th>
                        </tr>
                    </thead>
                    <?php 
                    $id_pegawai=$_SESSION['id_pegawai'];
                    $no=0; 
                    $sql = "SELECT id_pbarang,status,kategori,nama_barang ,tgl_pengajuan,berkas ,alasan 
                            FROM pengadaan_barang
                            INNER JOIN pegawai ON pegawai.id_pegawai = pengadaan_barang.id_pegawai
                            INNER JOIN kategori_barang ON kategori_barang.id_kategori=pengadaan_barang.id_kategori WHERE pengadaan_barang.id_pegawai='$id_pegawai'";
                    $s = mysqli_query($conn, $sql) or die (mysqli_error($conn));
                    $num_rows = mysqli_num_rows($s);
                    if (!empty($num_rows)) {
                    while ($tmp = mysqli_fetch_assoc($s)) {  
                    $no++
                    ?>
                    <tbody>
                        <tr>
                            <td align="center"><?php echo $no; ?></td>
                            <td><?php echo $tmp['tgl_pengajuan']; ?></td>
                            <td><?php echo $tmp['kategori']; ?></td>
                            <td><?php echo $tmp['nama_barang'] ?></td>
                            <td><?php echo $tmp['berkas']; ?></td>
                            <td><?php echo $tmp['alasan']; ?></td>
                            <td><?php echo $tmp['status']; ?></td>
                        </tr>
                     <?php }}else{ ?>
                      <tr>
                      <td align="center" colspan="9">Data Belum Tersedia</td>
                      </tr>
                      <?php } ?>
                    </tbody>
                </table>
                </div>
            </div>
            <!--Footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!--/.Content-->
    </div>
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
    <script>
    function previewImage() {
        document.getElementById("image-preview").style.display = "block";
        var oFReader = new FileReader();
         oFReader.readAsDataURL(document.getElementById("image-source").files[0]);

        oFReader.onload = function(oFREvent) {
          document.getElementById("image-preview").src = oFREvent.target.result;
        };
      };
    </script>
    <script type="text/javascript">
    function validasi_input(form){
       pola_username=/^[a-zA-Z0-9\_\-]{4,100}$/;
       if (!pola_username.test(form.username.value)){
          alert ('Username minimal 4 karakter dan hanya boleh Huruf atau Angka!');
          form.username.focus();
          return false;
       }
       return (true);
    }
    </script>
</body>
</html>
