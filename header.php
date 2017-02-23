<?php 
    session_start();
    include 'admin/koneksi.php';
    if ($_SESSION['status_pegawai'] != 'pegawai') {
      header('location:login.php');
    } else {
  ?>
<!-- NAV SECTION -->
<div class="navbar navbar-inverse navbar-fixed-top">        
    <div class="container">
        <div class="navbar-header" >
        <a class="navbar-brand" href="#" style="padding-top: 0px;">
            <img src="https://www.goodnewsfromindonesia.id/assets/front/main/logo-gnfi.png" alt="Good News from Indonesia" style="height: 65px;">
        </a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#port-sec">Data Master</a></li>
                <li><a href="ubah_password.php?&id_pegawai=<?php echo $_SESSION['id_pegawai']; ?>">Ganti Password</a></li>
                <li><a href="proses/logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
            </ul>
        </div>   
    </div>
</div>
  <?php }?>
 <!--END NAV SECTION -->
    