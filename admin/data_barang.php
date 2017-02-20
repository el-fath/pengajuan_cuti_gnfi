 <!DOCTYPE html>
 <html>
 <head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title></title>
   <link rel="stylesheet" href="">
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

   <div class="container body">
      <div class=" main_container">
        <div class="right_col" role="main">
           <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><strong>List Data Pengajuan Barang Dan Anggaran Pegawai</strong></h2>
                    
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered table-hover" >
                      <tr>
                        <th><strong>NO</strong></th>
                        <th><strong>NAMA PEGAWAI</strong></th>
                        <th><strong>TGL PENGAJUAN</strong></th>
                        <!-- <th><strong>LAMA CUTI</strong></th> -->
                        <th><strong>KATEGORI BARANG</strong></th>
                        <th><strong>NAMA BARANG</strong></th>
                        <th><strong>BERKAS</strong></th>
                        
                        <th><strong>ALASAN</strong></th>
                        <th><strong>STATUS</strong></th>
                        <th colspan="3"><center>ACTION</center></th>
                      </tr>  
                      <?php 
                        $no=0; 
                          $limit = 10;  
                          if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
                          $start_from = ($page-1) * $limit; 
                          $sql = "SELECT id_pbarang,status,nama_pegawai,kategori,nama_barang ,tgl_pengajuan,berkas ,alasan 
                                  FROM pengadaan_barang
                                  INNER JOIN pegawai ON pegawai.id_pegawai = pengadaan_barang.id_pegawai
                                  INNER JOIN kategori_barang ON kategori_barang.id_kategori=pengadaan_barang.id_kategori
                                  LIMIT $start_from, $limit
                                  ";
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
                          <td><a href="<?php echo'../berkas/'.$tmp['berkas']; ?>" ><?php echo $tmp['berkas'];  ?></a></td>
                          
                          <td><?php echo $tmp['alasan']; ?></td>
                          <td><?php echo $tmp['status']; ?></td>
                          <td align="center">
                            <a href="#" class="btn btn-xs btn-success open_modal <?=$tmp['status'] != 'disetujui' && $tmp['status'] != 'ditolak' ? '' : 'disabled'?>" id="<?php echo $tmp['id_pbarang'];?>"><i class="glyphicon glyphicon-check"></i> setujui</a>
                          </td>
                          <td align="center">
                            <a href="#" class="btn btn-xs btn-danger open_jon <?=$tmp['status'] != 'disetujui' && $tmp['status'] != 'ditolak' ? '' : 'disabled'?>" id="<?php echo $tmp['id_pbarang'];?>"><i class="glyphicon glyphicon-remove"></i> Tolak</a>
                          </td>
                           <td align="center"> 
                             <a href="#" class="btn btn-xs btn-danger <?=$tmp['status'] != 'Belum dikonfirmasi' ? '' : 'disabled'?>" onclick="confirmdel('proses/hapus_barang.php?&id_pbarang=<?php echo $tmp['id_pbarang']; ?>');"><i class="glyphicon glyphicon-trash"></i> hapus</a>
                          </td>
                      </tr>
                     <?php }}else{ ?>
                      <tr>
                      <td align="center" colspan="9">Data Belum Tersedia</td>
                      </tr>
                      <?php } ?>
                    </table>

                    </div>
                    <?php  
                      $sql = "SELECT COUNT(id_pbarang) FROM pengadaan_barang";  
                      $rs_result = mysqli_query($conn,$sql) or die(mysqli_error($conn));  
                      $row = mysqli_fetch_row($rs_result);  
                      $total_records = $row[0];  
                      $total_pages = ceil($total_records / $limit);  
                      $pagLink = "<ul class='pagination'>";  
                      for ($i=1; $i<=$total_pages; $i++) {  
                                   $pagLink .= "<li><a href='data_barang.php?page=".$i."'>".$i."</a></li>";  
                      };  
                      echo $pagLink . "</ul";  
                      ?>
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
    <script type="text/javascript">
    $(document).ready(function () {
       $(".open_modal").click(function(e) {
          var m = $(this).attr("id");
          $.ajax({
            url: "setuju_brg.php",
            type: "get",
            data : {id_pbarang: m,},
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
            url: "tolak_brg.php",
            type: "get",
            data : {id_pbarang: m,},
            success: function (ajaxData){
              $("#modaltolak").html(ajaxData);
              $("#modaltolak").modal('show',{backdrop: 'true'});
               }
             });
          });
        });
    </script>
  </body>
</html>
