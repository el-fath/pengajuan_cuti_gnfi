<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" type="text/css" href="vendors/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="vendors/bootstrap/dist/css/styles.css">
</head>
<body>
	<?php 
      include 'koneksi.php'; 
      $carikode = mysqli_query($conn, "SELECT max(id_pegawai) FROM pegawai") or die (mysqli_error($conn));
      // menjadikannya array
      $datakode = mysqli_fetch_array($carikode);
      // jika $datakode
      if ($datakode) {
       $nilaikode = substr($datakode[0], 1);
       // menjadikan $nilaikode ( int )
       $kode = (int) $nilaikode;
       // setiap $kode di tambah 1
       $kode = $kode + 1;
       $kode_otomatis = "P".str_pad($kode, 4, "0", STR_PAD_LEFT);
      } else {
       $kode_otomatis = "P0001";
      }

  ?>
	<div class="container body" >
     <div class="main_container">
     	<div class="row">
     		<div class="x_panel">
              <div class="x_title">
                <h2><center>Register Pegawai</center></h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#">Settings 1</a>
                      </li>
                      <li><a href="#">Settings 2</a>
                      </li>
                    </ul>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
                </ul>
                
              </div>
              <form action="proses/tambah_pegawai.php" method="POST" enctype="multipart/form-data" data-parsley-validate class="form-vertical form-label-left" onsubmit="return validasi_input(this)">
              <div class="x_content">
              <div class="row">
                
                  <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                  	<label>NAMA PEGAWAI</label>
                    <input type="text" name="id_pegawai" value="<?php echo "$kode_otomatis"; ?>" placeholder="" >
                    <input type="text" placeholder="" class="form-control" name="nama_pegawai">
                    <br>
                    <label>TGL LAHIR</label>
                    <input type="date" placeholder="" class="form-control" name="tgl_lahir">
                    <br>
                     <label>JABATAN</label>
                    <select name="id_jabatan" class="form-control">
                          <?php  
                             $sql = "SELECT * FROM jabatan ORDER BY jabatan ASC";
                             $s = mysqli_query($conn, $sql) or die (mysqli_error($conn));
                             while ($tmp = mysqli_fetch_assoc($s)) {
                          ?>
                            <option value="<?php echo $tmp['id_jabatan']; ?>"><?php echo $tmp['jabatan']; ?></option>
                            <?php } ?>
                          </select>
                    <br>
                    <label>ALAMAT PEGAWAI</label>
                    <input type="text" placeholder="" class="form-control" name="alamat_pegawai">
                    <br>
                    <label>Email address</label>
                      <input type="email" placeholder="" class="form-control" name="email">
                  </div>

                  <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                  	<label>TELPON PEGAWAI</label>
                    <input type="number" placeholder="" class="form-control" name="telpon_pegawai">
                    <br>
                    <label>PASSWORD</label>
                      <input type="password" placeholder="" class="form-control" name="password">
                      <br>
                      <label>USERNAME</label>
                      <input type="text" placeholder="" class="form-control" name="username" placeholder="min 4 karakter tidak boleh ada spasi" required oninvalid="this.setCustomValidity('input hanya boleh a-z A-Z 1-9 tanpa spasi')" oninput="setCustomValidity('')">
                      <br>
                      <label>JENIS KELAMIN</label><br>
                     <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                          <input type="radio" name="jenis_kelamin" value="Laki-Laki" <?php if ($temp['jenis_kelamin']=='Laki-Laki') {echo 'checked';} ?> /> &nbsp; Laki-laki &nbsp;
                        </label>
                        <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                          <input type="radio" name="jenis_kelamin" value="Perempuan" <?php if ($temp['jenis_kelamin']=='Perempuan') {echo 'checked';} ?>/> Perempuan
                        </label>
                        <br>
                        <br>
                      <label>TGL BERGABUNG</label>
                      <input type="date" placeholder="" class="form-control" name="tgl_bergabung">
                      <br>
                      <br><br>
                  </div>  
                  <div class="col-md-4 col-sm-12 col-xs-12 form-group" style="margin-top:-60px ">
                      <label class="control-label">FOTO (Max:1mb)</label>
                      <input class="form-control " type="file" name="foto" id="image-source" onchange="previewImage();">
                      <br>
                      <br>
                      <img src="https://d3e54v103j8qbb.cloudfront.net/img/image-placeholder.svg" width="100%" id="image-preview" class="img-rounded img-responsive" style=" width: 100%; height: 300px">

                   </div>
                     <!-- <img id="image-preview" class="img-rounded img-responsive col-xs-6 col-md-5" > -->
                       
                </div> <!-- row in form -->
                <div align="center">
                  <button type="reset" class="btn btn-lg btn-danger">Cancel</button>
                  <button type="submit" class="btn btn-lg btn-success">Submit</button> 
                </div>
              </div>
              </form>
            </div>
     </div>
    </div><!-- /.row -->	

 <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
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