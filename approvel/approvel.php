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
    <link rel="shortcut icon" type="../image/x-icon" href="1487735199.ico">
    <!-- BOOTSTRAP CORE STYLE CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLE CSS -->
    <link href="../assets/css/font-awesome.min.css" rel="stylesheet" />
    <!--ANIMATED FONTAWESOME STYLE CSS -->
    <link href="../assets/css/font-awesome-animation.css" rel="stylesheet" />
     <!--PRETTYPHOTO MAIN STYLE -->
    <link href="../assets/css/prettyPhoto.css" rel="stylesheet" />
       <!-- CUSTOM STYLE CSS -->
    <link href="../assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <link href="../assets/css/ihover.css" rel="stylesheet" />
</head>
<body>
    <?php include '../header.php'; ?>
    <?php include '../koneksi.php'; ?>
    <!--HOME SECTION-->
    <div id="home-sec">
    <div class="container" >
        <div class="row text-center">
            <div  class="col-md-12 col-sm-12" >
                <div class="col-md-12">
                <!-- <img src="assets/img/gnfi.png" style="width: 350px; height: 110px;" alt="">                    -->
                </div>
                <a  href="#port-sec">
                
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
    <!--END HOME SECTION--> 
    <!-- PORTFOLIO SECTION-->
   <section id="port-sec">
       <div class="container">
           <div class="row g-pad-bottom" >
                <div class="table-responsive">
                      <table class="table table-striped table-bordered table-hover" >
                      <tr>
                        <th><strong>NAMA PEGAWAI</strong></th>
                        <!-- <th><strong>JENIS CUTI</strong></th> -->
                        <th><strong>TGL PENGAJUAN</strong></th>
                        <!-- <th><strong>LAMA CUTI</strong></th> -->
                        <th><strong>MULAI CUTI</strong></th>
                        <th><strong>AKHIR CUTI</strong></th>
                        <th><strong>LAMA CUTI</strong></th>
                        <th><strong>ALASAN CUTI</strong></th>
                        <th><strong>JENIS CUTI</strong></th>
                        <th><strong>JATAH CUTI</strong></th>
                        <th><strong>STATUS</strong></th>
                        <th colspan="3"><center>ACTION</center></th>
                      </tr>  
                      <?php
                          $sql = "SELECT id_pcuti,nama_pegawai, nama_cuti, tgl_pengajuan, lama_cuti,status, tgl_mulai_cuti,tgl_akhir_cuti, alasan , jatah_cuti, lama_cuti
                                  FROM permohonan_cuti
                                  INNER JOIN pegawai ON pegawai.id_pegawai = permohonan_cuti.id_pegawai
                                  INNER JOIN jenis_cuti ON jenis_cuti.id_jcuti = permohonan_cuti.id_jcuti
                                  ORDER BY tgl_pengajuan DESC";
                          $s = mysqli_query($conn, $sql) or die (mysqli_error($conn));
                          $num_rows = mysqli_num_rows($s);
                          if (!empty($num_rows)) {
                          while ($tmp = mysqli_fetch_assoc($s)) {  
                          $no++
                      ?>
                      <tr>
                          <td><?php echo $tmp['nama_pegawai']; ?></td>
                          <!-- <td><?php echo $tmp['nama_cuti']; ?></td> -->
                          <td><?php echo $tmp['tgl_pengajuan']; ?></td>
                          <!-- <td><?php echo $tmp['lama_cuti']; ?></td> -->
                          <td><?php echo $tmp['tgl_mulai_cuti']; ?></td>
                          <td><?php echo $tmp['tgl_akhir_cuti']; ?></td>
                          <td align="center"><?php echo $tmp['lama_cuti']; ?></td>
                          <td><?php echo $tmp['alasan']; ?></td>
                          <td><?php echo $tmp['nama_cuti']; ?></td>
                          <td align="center"><?php echo $tmp['jatah_cuti']; ?></td>
                          <!-- <td><?php echo $tmp['status']; ?></td> -->
                          <td>
                            <?php if ($tmp['status']=='disetujui'){ ?>
                                <span class="label label-success" style="font-size: 12px;">disetujui</span>
                            <?php } elseif ($tmp['status'] == 'ditolak') { ?>
                                <span class="label label-danger" style="font-size: 12px;">ditolak</span>
                            <?php } elseif ($tmp['status'] == 'Belum dikonfirmasi') { ?>
                                <span class="label label-warning" style="font-size: 12px;">Belum dikonfirmasi</span>
                            <?php } ?>
                          </td>
                          <td align="center">
                            <a href="#" class="btn btn-xs btn-success open_modal <?=$tmp['status'] != 'disetujui' && $tmp['status'] != 'ditolak' ? '' : 'disabled'?>" id="<?php echo $tmp['id_pcuti'];?>"><i class="glyphicon glyphicon-check"></i> setujui</a>
                          </td>
                          <td align="center">
                            <a href="#" class="btn btn-xs btn-danger open_jon <?=$tmp['status'] != 'disetujui' && $tmp['status'] != 'ditolak' ? '' : 'disabled'?>" id="<?php echo $tmp['id_pcuti'];?>"><i class="glyphicon glyphicon-remove"></i> Tolak</a>
                          </td>
                          <td align="center"> 
                             <a href="#" class="btn btn-xs btn-danger <?=$tmp['status'] != 'Belum dikonfirmasi' ? '' : 'disabled'?>" onclick="confirmdel('proses/hapus_cuti.php?&id_pcuti=<?php echo $tmp['id_pcuti']; ?>');"><i class="glyphicon glyphicon-trash"></i> hapus</a>
                          </td>
                      </tr>
                      <?php }}else{ ?>
                      <tr>
                      <td align="center" colspan="10">Data Belum Tersedia</td>
                      </tr>
                      <?php } ?>
                    </table>  
                </div>
           </div>
       </div>
   </section>
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
    <?php include '../footer.php'; ?>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <!-- BOOTSTRAP CORE SCRIPT   -->
    <script src="../assets/plugins/bootstrap.min.js"></script>  
     <!-- ISOTOPE SCRIPT   -->
  <!--   <script src="assets/plugins/jquery.isotope.min.js"></script> -->
    <!-- PRETTY PHOTO SCRIPT   -->
    <script src="../assets/plugins/jquery.prettyPhoto.js"></script>    
    <!-- CUSTOM SCRIPTS -->
    <script src="../assets/js/custom.js"></script>
  <!--   <script src="http://cdn.jsdelivr.net/webshim/1.12.4/extras/modernizr-custom.js"></script> -->
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
            url: "../admin/setuju.php",
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
            url: "../admin/tolak.php",
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
</body>
</html>
