  <!DOCTYPE html>
 <html>
 <head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title></title>
   <link rel="stylesheet" href="">
   <link rel="shortcut icon" type="image/x-icon" href="../1487735199.ico">
   <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  
    <!-- bootstrap-daterangepicker -->
    <link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
 </head>
 <body>
 <?php include 'header.php'; ?>
 <?php include 'koneksi.php'; ?>
 <!-- page content -->
 <div class="container body">
   <div class="main_container">
      <div class="right_col" role="main">
          <!-- top tiles -->

          <!-- /top tiles -->

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><strong>Form Edit Profil Pegawai</strong></h2>
                   <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <?php  
                        $id_pegawai=$_GET['id_pegawai'];
                        $sql="SELECT  pegawai.id_pegawai,pegawai.nama_pegawai, pegawai.username,pegawai.status_pegawai,jabatan.id_jabatan,jabatan.jabatan,pegawai.jenis_kelamin,pegawai.email,pegawai.tgl_lahir, pegawai.tgl_bergabung, pegawai.alamat_pegawai, pegawai_group.grup ,pegawai.telpon_pegawai, pegawai.foto, pegawai_group.is_coordinator 
                              FROM pegawai, jabatan, pegawai_group  WHERE pegawai.id_pegawai='$id_pegawai'";
                        $query=mysqli_query($conn,$sql) or die (mysqli_error($conn));
                        $temp=mysqli_fetch_assoc($query);
                    ?>
                    <form action="proses/edit_pegawai.php" method="POST" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left" onsubmit="return validasi_input(this)">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">ID PEGAWAI <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="id_pegawai" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $temp['id_pegawai']; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name" >NAMA PEGAWAI <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="nama_pegawai" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $temp['nama_pegawai']; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name" >USERNAME <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="username" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $temp['username']; ?>" oninvalid="this.setCustomValidity('input hanya boleh a-z A-Z 1-9 tanpa spasi')">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">TGL LAHIR<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="date" name="tgl_lahir" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $temp['tgl_lahir']; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">TGL BERGABUNG<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="date" name="tgl_bergabung" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $temp['tgl_bergabung']; ?>">
                        </div>
                      </div>
                      <!-- <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">STATUS</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div id="gender" class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="status_pegawai" value="admin" <?php if ($temp['status_pegawai']=='admin') {echo 'checked';} ?> /> &nbsp; Admin &nbsp;
                            </label>
                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="status_pegawai" value="pegawai" <?php if ($temp['status_pegawai']=='pegawai') {echo 'checked';} ?>/> Pegawai
                            </label>
                          </div>
                        </div>
                      </div> -->
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">IS A KOORDINATOR ?</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="is_coordinator" class="form-control">
                            <option <?= $temp['is_coordinator'] == '1' ?'selected':'' ?> value="1">YES</option>
                            <option <?= $temp['is_coordinator'] == '0' ?'selected':'' ?> value="0">NO</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">GROUP</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="group" class="form-control">
                            <option <?= $temp['grup']=='ADMIN' ?'selected':'' ?>       value="ADMIN">ADMIN</option>
                            <option <?= $temp['grup']=='TECHINNO' ?'selected':'' ?>    value="TECHINNO">TECHINNO</option>
                            <option <?= $temp['grup']=='REDAKSI' ?'selected':'' ?>     value="REDAKSI">REDAKSI</option>
                            <option <?= $temp['grup']=='CREATIVE' ?'selected':'' ?>    value="CREATIVE">CREATIVE</option>
                            <option <?= $temp['grup']=='OPERASIONAL' ?'selected':'' ?> value="OPERASIONAL">OPERASIONAL</option>
                            <option <?= $temp['grup']=='MEDSOS' ?'selected':'' ?>      value="MEDSOS">MEDSOS</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">JABATAN</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="id_jabatan" class="form-control">
                          <?php  
                            $sql = "SELECT * FROM jabatan ORDER BY jabatan ASC";
                            $s = mysqli_query($conn, $sql) or die (mysqli_error($conn));
                            while ($tmp = mysqli_fetch_assoc($s)) {
                          ?>
                            <option value="<?php echo $tmp['id_jabatan']; ?>" <?=$temp['id_jabatan'] == $tmp['id_jabatan'] ?'selected' : ''?>><?php echo $tmp['jabatan']; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">JENIS KELAMIN</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div id="gender" class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="jenis_kelamin" value="Laki-Laki" <?php if ($temp['jenis_kelamin']=='Laki-Laki') {echo 'checked';} ?> /> &nbsp; Laki-laki &nbsp;
                            </label>
                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="jenis_kelamin" value="Perempuan" <?php if ($temp['jenis_kelamin']=='Perempuan') {echo 'checked';} ?>/> Perempuan
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">EMAIL</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input class="form-control col-md-7 col-xs-12" type="email" name="email" value="<?php echo $temp['email']; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">ALAMAT PEGAWAI</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input class="form-control col-md-7 col-xs-12" type="text" name="alamat_pegawai" value="<?php echo $temp['alamat_pegawai']; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">TELPON PEGAWAI</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input class="form-control col-md-7 col-xs-12" type="tel" name="telpon_pegawai" value="<?php echo $temp['telpon_pegawai']; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">FOTO (Max:1mb)</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input class="form-control col-md-7 col-xs-12" type="file" name="foto" id="image-source" onchange="previewImage();">
                          <br>
                          <br>
                          <br>
                          <img id="image-preview" class="form-control" style="width: 200px; height: 200px;" src="<?php echo'img/'.$temp['foto']; ?>">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a href="list_pegawai.php">
                          <button type="button" class="btn btn-primary">Cancel</button>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>

             <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><strong>Form Edit Password Pegawai</strong></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
          <form action="proses/edit_pass.php" method="POST" class="form-horizontal form-label-left" accept-charset="utf-8">
            <div class="form-group">
              <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">MASUKKAN PASSWORD BARU</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input class="form-control col-md-7 col-xs-12" type="hidden" name="id_pegawai" value="<?php echo $temp['id_pegawai']; ?>">
                <input class="form-control col-md-7 col-xs-12" type="password" name="password" value="" required="">
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <a href="list_pegawai.php">
                <button type="button" class="btn btn-primary">Cancel</button>
                <button type="submit" class="btn btn-success">Submit</button>
              </div>
            </div>
          </form>           
        </div>
                </div>
              </div>
            </div>
            
        
      
 
  <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
  

    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>

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
          alert ('Username minimal 6 karakter dan hanya boleh Huruf atau Angka!');
          form.username.focus();
          return false;
       }
       return (true);
    }
    </script>
  </body>
</html>
