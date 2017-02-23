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
   
    <link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
 </head>
 <body>
   <?php include 'header.php'; ?>
   <?php include 'koneksi.php'; ?>

   <div class="container body">
      <div class=" main_container">
        <div class="right_col" role="main">
           <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><strong>Daftar pegawai </strong></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <a href="tambah_pegawai.php" class="btn btn-lg btn-primary" >Tambah Pegawai</a>
                    <form action="" method="post" accept-charset="utf-8">
                      <div class="input-group">
                        <input type="text" name="cari_peg" class="form-control" placeholder="Cari Nama Pegawai">
                        <span class="input-group-btn">
                          <input type="submit" name="cari" class="btn btn-primary" value="Cari">
                        </span>
                      </div>
                    </form>
                  <div class="table-responsive">
                    <table class="table table-bordered" >
                      <tr>
                        <!-- <th>NO</th> -->
                        <th>ID PEGAWAI</th>
                        <th>NAMA PEGAWAI</th>
                        <th>JABATAN</th>
                        <th>JENIS KELAMIN</th>
                        <th>EMAIL</th>
                        <th>TELPON PEGAWAI</th>
                        <th>USERNAME</th>
                        <th colspan="2"><center>ACTION</center></th>
                      </tr>  
                      <?php 
                          if (isset($_POST['cari'])) {
                          	$cari_peg = $_POST['cari_peg'];
                          $sql = "SELECT id_pegawai,nama_pegawai,jabatan,jenis_kelamin,email,alamat_pegawai,telpon_pegawai,foto,jatah_cuti, username FROM pegawai INNER JOIN jabatan ON jabatan.id_jabatan = pegawai.id_jabatan WHERE nama_pegawai LIKE '%$cari_peg%' ";
                          $s = mysqli_query($conn, $sql) or die (mysqli_error($conn));
                          while ($tmp = mysqli_fetch_assoc($s)) {  
                            $no++
                      ?>
                      <tr>
                          <!-- <td><?php echo $no; ?></td> -->
                          <td><?php echo $tmp['id_pegawai']; ?></td>
                          <td><?php echo $tmp['nama_pegawai']; ?></td>
                          <td><?php echo $tmp['jabatan']; ?></td>
                          <td><?php echo $tmp['jenis_kelamin']; ?></td>
                          <td><?php echo $tmp['email']; ?></td>
                          <td><?php echo $tmp['telpon_pegawai']; ?></td>
                          <td><?php echo $tmp['username']; ?></td>
                          <td>
                            <a href="edit_pegawai.php?&id_pegawai=<?php echo $tmp['id_pegawai']; ?>" class="btn btn-xs btn-warning" ><i class="glyphicon glyphicon-pencil"></i> edit</a>
                          </td>
                          <td>
                            <a href="#" class="btn btn-xs btn-danger" onclick="confirmdel('proses/hapus_pegawai.php?&id_pegawai=<?php echo $tmp['id_pegawai']; ?>');"><i class="glyphicon glyphicon-trash"></i> hapus</a>
                          </td>
                      </tr>
                      <?php  }}
                        
                      ?>
                    </table>
                  
                  </div>
                    <br />
                    
                  </div>
                </div>
              </div>
            </div>

          <!-- confirm modal hapus -->
            <div class="modal fade" id="modal_delete" style="margin-top: 150px">
                <div class="modal-dialog">
                    <div class="modal-content" style="margin-top:100px;">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" style="text-align:center;">Are you sure to delete this information ?</h4>
                      </div>
                                
                      <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                        <a href="#" class="btn btn-danger" id="delete_link">Delete</a>
                        <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                      </div>
                    </div>
                </div>
            </div>
            <!-- end of confirm modal hapus -->

          <div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

          </div>  
        </div>
      </div>
   </div>
   <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
  
    <script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>

    <script type="text/javascript">
    function confirmdel(delete_url) {
      $('#modal_delete').modal('show', {backdrop:'static'});
      document.getElementById('delete_link').setAttribute('href', delete_url);
    }
  </script>
 
  
  </body>
</html>

