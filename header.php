<?php 
    session_start();
    include 'admin/koneksi.php';
    if (empty($_SESSION['username']))    {
      header('location:login.php');
    } else {
  ?>
<!-- NAV SECTION -->
<div class="navbar navbar-inverse navbar-fixed-top">        
    <div class="container">
        <div class="navbar-header" >
        <a class="navbar-brand" href="index.php" style="padding-top: 0px;">
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
                <li><a href="#port-sec">Daftar Menu</a></li>
                <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $_SESSION['username']; ?><span class="caret"></span></a>
            <ul class="dropdown-menu dropdown-cart" role="menu">
                <li><a href=""><a href="ubah_password.php?&id_pegawai=<?php echo $_SESSION['id_pegawai']; ?>">Ganti Password</a></li>
                <li><a href="#" data-toggle="modal" data-target=".biodata">Biodata</a></li>
                <li><a href="#" data-toggle="modal" data-target=".edit_biodata">Edit Biodata</a></li>
                <li><a href="proses/logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
           </ul>
           </li>
           </ul>
        </div>  
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
<div class="modal fade biodata" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
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
  <?php }?>
 <!--END NAV SECTION -->
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