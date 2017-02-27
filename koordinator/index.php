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
          <div class="row tile_count">
            <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count" align="center">
              <span class="count_top"><i class="fa fa-users"></i> Total Pegawai</span>
              <?php 
                $sql = "SELECT * FROM pegawai";
                $s = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                $data = array();
                while ($row = mysqli_fetch_array($s)) {
                    $data[] = $row;
                }
                  $count = count($data);
              ?>
              <div class="count"><?php echo $count; ?></div>
              
            </div>
            
            <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count" align="center">
              <span class="count_top"><i class="fa fa-male"></i> Total Pegawai Pria</span>
              <?php 
                $sql = "SELECT * FROM pegawai WHERE jenis_kelamin ='laki-laki'";
                $s = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                $data = array();
                while ($row = mysqli_fetch_array($s)) {
                    $data[] = $row;
                }
                  $count = count($data);
              ?>
              <div class="count"><?php echo $count; ?></div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count" align="center">
              <span class="count_top"><i class="fa fa-female"></i> Total Pegawai Perempuan</span>
              <?php 
                $sql = "SELECT * FROM pegawai where jenis_kelamin = 'perempuan'";
                $s = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                $data = array();
                while ($row = mysqli_fetch_array($s)) {
                    $data[] = $row;
                }
                  $count = count($data);
              ?>
              <div class="count"><?php echo $count; ?></div>
            </div>
            
          </div>
          <!-- /top tiles -->

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><strong>Data Pengajuan Cuti Pegawai Yang Belum Dikonfirmasi</strong></h2>
                   <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered table-hover" >
                      <tr>
                        <th><strong>NO</strong></th>
                        <th><strong>NAMA PEGAWAI</strong></th>
                        <!-- <th><strong>JENIS CUTI</strong></th> -->
                        <th><strong>TGL PENGAJUAN</strong></th>
                        <th><strong>LAMA CUTI</strong></th>
                        <th><strong>MULAI CUTI</strong></th>
                        <th><strong>AKHIR CUTI</strong></th>
                        <th><strong>ALASAN CUTI</strong></th>
                        <th><strong>JENIS CUTI</strong></th>
                        <th><strong>JATAH CUTI</strong></th>
                        <th><strong>STATUS</strong></th>
                        <th colspan="2"><center>ACTION</center></th>
                      </tr>  
                      <?php $no=0; 
                          $id_pegawai = $_SESSION['id_pegawai'];
                          $sql = "SELECT id_pcuti,nama_pegawai, nama_cuti, tgl_pengajuan, lama_cuti,status, tgl_mulai_cuti,tgl_akhir_cuti, alasan , jatah_cuti
                                  FROM permohonan_cuti
                                  INNER JOIN pegawai ON pegawai.id_pegawai = permohonan_cuti.id_pegawai
                                  INNER JOIN jenis_cuti ON jenis_cuti.id_jcuti = permohonan_cuti.id_jcuti
                                  WHERE status = 'Belum dikonfirmasi' ORDER BY tgl_pengajuan DESC";
                          $s = mysqli_query($conn, $sql) or die (mysqli_error($conn));
                          $num_rows = mysqli_num_rows($s);
                          if (!empty($num_rows)) {
                          while ($tmp = mysqli_fetch_assoc($s)) {  
                          $no++
                      ?>
                      <tr>
                          <td align="center"><?php echo $no; ?></td>
                          <td><?php echo $tmp['nama_pegawai']; ?></td>
                          <!-- <td><?php echo $tmp['nama_cuti']; ?></td> -->
                          <td><?php echo $tmp['tgl_pengajuan']; ?></td>
                          <td align="center"><?php echo $tmp['lama_cuti']; ?></td> 
                          <td><?php echo $tmp['tgl_mulai_cuti']; ?></td>
                          <td><?php echo $tmp['tgl_akhir_cuti']; ?></td>
                          <td><?php echo $tmp['alasan']; ?></td>
                          <td><?php echo $tmp['nama_cuti']; ?></td>
                          <td align="center"><?php echo $tmp['jatah_cuti']; ?></td>
                          <td><?php echo $tmp['status']; ?></td>
                          <td align="center">
                            <a href="#" class="btn btn-xs btn-success open_modal <?=$tmp['status'] != 'disetujui' && $tmp['status'] != 'ditolak' ? '' : 'disabled'?>" id="<?php echo $tmp['id_pcuti'];?>"><i class="glyphicon glyphicon-check"></i> setujui</a>
                          </td>
                          <td align="center">
                            <a href="#" class="btn btn-xs btn-danger open_jon <?=$tmp['status'] != 'disetujui' && $tmp['status'] != 'ditolak' ? '' : 'disabled'?>" id="<?php echo $tmp['id_pcuti'];?>"><i class="glyphicon glyphicon-remove"></i> Tolak</a>
                          </td>
                      </tr>
                      <?php }}else{ ?>
                      <tr>
                      <td align="center" colspan="11">Data Belum Tersedia</td>
                      </tr>
                      <?php } ?>
                    </table>

                    </div>
                  </div>
                </div>
              </div>
            </div>

             <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><strong>Data Pengajuan Barang Pegawai Yang Belum Dikonfirmasi</strong></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered table-hover" >
                      <tr>
                        <th><strong>NO</strong></th>
                        <th><strong>NAMA PEGAWAI</strong></th>
                        
                        <th><strong>TGL PENGAJUAN</strong></th>
                        
                        <th><strong>KATEGORI BARANG</strong></th>
                        <th><strong>NAMA BARANG</strong></th>
                        <th><strong>BERKAS</strong></th>
                        <th><strong>ALASAN</strong></th>
                        <th><strong>STATUS</strong></th>
                        <th colspan="2"><center>ACTION</center></th>
                      </tr>  
                      <?php $no=0; 
                          $id_pegawai = $_SESSION['id_pegawai'];
                          $sql = "SELECT id_pbarang,status,kategori,nama_barang ,tgl_pengajuan,berkas ,alasan, nama_pegawai 
                                  FROM pengadaan_barang
                                  INNER JOIN pegawai ON pegawai.id_pegawai = pengadaan_barang.id_pegawai
                                  INNER JOIN kategori_barang ON kategori_barang.id_kategori=pengadaan_barang.id_kategori
                                  WHERE status = 'Belum dikonfirmasi' ORDER BY tgl_pengajuan DESC";
                          $s = mysqli_query($conn, $sql) or die (mysqli_error($conn));
                          $num_rows = mysqli_num_rows($s);
                          if (!empty($num_rows)) {
                          while ($tmp = mysqli_fetch_assoc($s)) {  
                          $no++
                      ?>
                      <tr>
                          <td align="center"><?php echo $no; ?></td>
                          <td><?php echo $tmp['nama_pegawai']; ?></td>
                          <td><?php echo $tmp['tgl_pengajuan']; ?></td>
                          <td><?php echo $tmp['kategori']; ?></td>
                          <td><?php echo $tmp['nama_barang'] ?></td>
                          <td><?php echo $tmp['berkas']; ?></td>
                          <td><?php echo $tmp['alasan']; ?></td>
                          <td><?php echo $tmp['status']; ?></td>
                         <td align="center">
                            <a href="#" class="btn btn-xs btn-success buka_modal <?=$tmp['status'] != 'disetujui' && $tmp['status'] != 'ditolak' ? '' : 'disabled'?>" id="<?php echo $tmp['id_pbarang'];?>"><i class="glyphicon glyphicon-check"></i> setujui</a>
                          </td>
                          <td align="center">
                            <a href="#" class="btn btn-xs btn-danger open <?=$tmp['status'] != 'disetujui' && $tmp['status'] != 'ditolak' ? '' : 'disabled'?>" id="<?php echo $tmp['id_pbarang'];?>"><i class="glyphicon glyphicon-remove"></i> Tolak</a>
                          </td>
                      </tr>
                      <?php }}else{ ?>
                      <tr>
                      <td align="center" colspan="9">Data Belum Tersedia</td>
                      </tr>
                      <?php } ?>
                    </table>

                    </div>
                  </div>
                </div>
              </div>
            </div>
            
         <!-- modal setuju -->
        <div id="modalsetuju" class="modal fade" role="dialog" style="margin-top:100px;">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <div class="fetched-data"></div>
              </div>
            </div>
          </div>
        </div>
        <!-- end of modal setuju -->
        <!-- modal tolak -->
        <div id="modaltolak" class="modal fade" role="dialog" style="margin-top:100px;">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <div class="fetched-data"></div>
              </div>
            </div>
          </div>
        </div>
        <!-- end of modal tolak -->
        </div>

                     <!-- modal setuju -->
        <div id="setuju" class="modal fade" role="dialog" style="margin-top:100px;">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <div class="fetched-data"></div>
              </div>
            </div>
          </div>
        </div>
        <!-- end of modal setuju -->
        <!-- modal tolak -->
        <div id="tolak" class="modal fade" role="dialog" style="margin-top:100px;">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <div class="fetched-data"></div>
              </div>
            </div>
          </div>
        </div>
        <!-- end of modal tolak -->

      </div>
    </div>
  </div>
      

        <!-- /page content -->
      
 
  <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
  

    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>

    <script type="text/javascript">
    function confirmdel(delete_url) {
      $('#modal_delete').modal('show', {backdrop:'static'});
      document.getElementById('delete_link').setAttribute('href', delete_url);
    }
  </script>
   <script type="text/javascript">
    $(document).ready(function () {
       $(".open_modal").click(function(e) {
          var m = $(this).attr("id");
          $.ajax({
            url: "setuju.php",
            type: "get",
            data : {id_pcuti: m,},
            success: function (ajaxData){
              $("#modalsetuju").html(ajaxData);
              $("#modalsetuju").modal('show',{backdrop: 'true'});
               }
             });
          });
        });
    </script>
    <script type="text/javascript">
    $(document).ready(function () {
       $(".open_jon").click(function(e) {
          var m = $(this).attr("id");
          $.ajax({
            url: "tolak.php",
            type: "get",
            data : {id_pcuti: m,},
            success: function (ajaxData){
              $("#modaltolak").html(ajaxData);
              $("#modaltolak").modal('show',{backdrop: 'true'});
               }
             });
          });
        });
    </script>

     <script type="text/javascript">
    $(document).ready(function () {
       $(".buka_modal").click(function(e) {
          var m = $(this).attr("id");
          $.ajax({
            url: "setuju_brg.php",
            type: "get",
            data : {id_pbarang: m,},
            success: function (ajaxData){
              $("#setuju").html(ajaxData);
              $("#setuju").modal('show',{backdrop: 'true'});
               }
             });
          });
        });
    </script>
    <script type="text/javascript">
    $(document).ready(function () {
       $(".open").click(function(e) {
          var m = $(this).attr("id");
          $.ajax({
            url: "tolak_brg.php",
            type: "get",
            data : {id_pbarang: m,},
            success: function (ajaxData){
              $("#tolak").html(ajaxData);
              $("#tolak").modal('show',{backdrop: 'true'});
               }
             });
          });
        });
    </script>
  </body>
</html>
