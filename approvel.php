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
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
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
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
</head>
<body>
    <?php include 'header.php'; ?>
    <?php include 'koneksi.php'; ?>
    <!--HOME SECTION-->
<!-- <div id="home-sec">
    <div class="container" >
        <div class="row text-center">
            <div  class="col-md-12 col-sm-12" >
                <div class="col-md-12">
                <img src="assets/img/gnfi.png" style="width: 350px; height: 110px;" alt="">                   
                </div>
            </div>
                <div class="col-md-4 col-md-offset-4  col-sm-6 col-sm-offset-3">
                <h1><span class="label label-danger">Approval Page</span></h1>
                </div>
        </div>
    </div>
</div> -->
<!-- <div class="container" style="min-height: 550px;"> -->
  <div class="container-fluid" style="min-height: 630px;">
      <h2 style="padding-top: 70px;"><center></center></h2>
      <!-- Nav tabs -->
      <?php
      if(isset($_GET['id_pbarang'])){
      include "cetakbrg_men.php";
      }?>
      <?php
      if(isset($_GET['id_pcuti'])){
      include "cetak_men.php";
      }?>
  <div class="panel panel-default">
      <div class="panel-heading">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs nav-justified" role="tablist">
              <li class="active"><a href="#home" role="tab" data-toggle="tab">Pengajuan Cuti Team</a></li>
              <li><a href="#profile" role="tab" data-toggle="tab">Pengajuan Barang Team</a></li>
          </ul>
      </div>
      <!-- Tab panes + Panel body -->
      <div class="panel-body tab-content">
          <div class="tab-pane active" id="home">
            <div class="table-responsive">
          <table border="2" align="center" class="table table-bordered" style="font-size: 15px;">
              <tr>
                <th>NO</th>
                <th>NAMA</th>
                <th>TGL PENGAJUAN</th>
                <th>MULAI CUTI</th>
                <th>AKHIR CUTI</th>
                <th>ALASAN CUTI</th>
                <th>JENIS CUTI</th>
                <th>STATUS</th>
                <th colspan="4"><center>ACTION</center></th>
              </tr>
              <?php 
                  $limit = 10;  

                  if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
                  $start_from = ($page-1) * $limit; 
                  $sql = "SELECT id_pcuti,nama_pegawai, nama_cuti, tgl_pengajuan, lama_cuti,status, tgl_mulai_cuti,tgl_akhir_cuti,     alasan , jatah_cuti, lama_cuti ,grup
                          FROM permohonan_cuti 
                          INNER JOIN pegawai ON pegawai.id_pegawai = permohonan_cuti.id_pegawai
                          INNER JOIN pegawai_group ON pegawai.id_pegawai = pegawai_group.id_pegawai
                          -- INNER JOIN pegawai_approval_list ON pegawai.id_pegawai = pegawai_approval_list.approval_id
                          INNER JOIN jenis_cuti ON jenis_cuti.id_jcuti = permohonan_cuti.id_jcuti
                          ORDER BY tgl_pengajuan DESC";
                  
                  $s = mysqli_query($conn, $sql) or die (mysqli_error($conn));
                  $num_rows = mysqli_num_rows($s);
                  if (!empty($num_rows)) {
                  while ($tmp = mysqli_fetch_assoc($s)) {  
                    $l = mysqli_query($conn,"SELECT * FROM pegawai_approval_list WHERE object_id = '".$tmp['id_pcuti']."'AND type = 'cuti'") or die(mysqli_error($conn));
                    $data = mysqli_fetch_array($l);
                  $no++
              ?>
              <tr>
                <td align="center"><?php echo $no; ?></td>
                <td><?php echo $tmp['nama_pegawai']; ?></td>
                <td><?php echo $tmp['tgl_pengajuan']; ?></td>
                <td><?php echo $tmp['tgl_mulai_cuti']; ?></td>
                <td><?php echo $tmp['tgl_akhir_cuti']; ?></td>
                <td><?php echo $tmp['alasan']; ?></td>
                <td><?php echo $tmp['nama_cuti']; ?></td>
                <td>
                      <?php if ($tmp['status']=='disetujui'){ ?>
                          <span class="label label-success" style="font-size: 12px;">disetujui</span>
                      <?php } elseif ($tmp['status'] == 'ditolak') { ?>
                          <span class="label label-danger" style="font-size: 12px;">ditolak</span>
                      <?php } elseif ($tmp['status'] == 'Belum dikonfirmasi') { ?>
                          <span class="label label-warning label-lg" style="font-size: 12px;">Belum dikonfirmasi</span>
                      <?php } elseif ($tmp['status'] == 'disetujui 1 approvel') { ?>
                          <span class="label label-warning" style="font-size: 12px;">Disetujui 1 Approvel</span>
                      <?php } ?>
                </td>
                <td align='center'><a href='?&id_pcuti=<?php echo $tmp['id_pcuti']; ?>'><button class='btn btn-primary btn-sm'><i class="glyphicon glyphicon-eye-open"></i></button></a></td>
                  <?php 
                  $id_pegawai=$_SESSION['id_pegawai'];
                  $q = "SELECT * FROM pegawai_group WHERE id_pegawai='$id_pegawai'";
                  $a = mysqli_query($conn, $q) or die (mysqli_error($conn));
                  while ($t = mysqli_fetch_assoc($a)) {
                  if ($t['is_coordinator'] == '1') {
                  ?>
              <td align="center">
                      <a href="#" class="btn btn-sm btn-success open_modal <?=$tmp['status'] != 'disetujui' && $tmp['status'] != 'ditolak' && $tmp['grup'] == $_SESSION['grup'] && $data['is_approval'] != 1 ? '' : 'disabled'?>" id="<?php echo $tmp['id_pcuti'];?>" ><i class="glyphicon glyphicon-check"></i></a>
                  </td>
                  <td align="center">
                      <a href="#" class="btn btn-sm btn-danger open_jon <?=$tmp['status'] != 'disetujui' && $tmp['status'] != 'ditolak' && $tmp['grup'] == $_SESSION['grup'] && $data['is_approval'] != 1 ? '' : 'disabled'?>" id="<?php echo $tmp['id_pcuti'];?>"><i class="glyphicon glyphicon-remove"></i></a>
                  </td>
                  <td align="center"> 
                       <a href="#" class="btn btn-sm btn-danger <?=$tmp['status'] != 'Belum dikonfirmasi' ? '' : 'disabled'?>" onclick="confirmdel('admin/proses/hapus_cuti.php?&id_pcuti=<?php echo $tmp['id_pcuti']; ?>');"><i class="glyphicon glyphicon-trash"></i></a>
                  </td>
                  <?php 
                  }else{
                  ?>
                  <td align="center">
                      <a href="#" class="btn btn-sm btn-success open_modal <?=$tmp['status'] != 'disetujui' && $tmp['status'] != 'ditolak' ? '' : 'disabled'?>" id="<?php echo $tmp['id_pcuti'];?>" ><i class="glyphicon glyphicon-check"></i></a>
                  </td>
                  <td align="center">
                      <a href="#" class="btn btn-sm btn-danger open_jon <?=$tmp['status'] != 'disetujui' && $tmp['status'] != 'ditolak' ? '' : 'disabled'?>" id="<?php echo $tmp['id_pcuti'];?>"><i class="glyphicon glyphicon-remove"></i></a>
                  </td>
                  <td align="center"> 
                       <a href="#" class="btn btn-sm btn-danger <?=$tmp['status'] != 'Belum dikonfirmasi' ? '' : 'disabled'?>" onclick="confirmdel('admin/proses/hapus_cuti.php?&id_pcuti=<?php echo $tmp['id_pcuti']; ?>');"><i class="glyphicon glyphicon-trash"></i></a>
                  </td>
                <?php 
                }}
                ?>
              </tr>
              <?php }}else{ ?>
              <tr>
                  <td align="center" colspan="9">Data Belum Tersedia</td>
              </tr>
              <?php } ?>
          </table>
          
          </div>

          </div>
          <div class="tab-pane" id="profile">
            <div class="table-responsive">
          <table border="2" align="center" class="table table-bordered" style="font-size: 15px;">
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
                <th colspan="4"><center>ACTION</center></th>
              </tr>
              <?php 
                 $no=0; 
                  $limit = 10;  
                  if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
                  $start_from = ($page-1) * $limit; 
                  $sql = "SELECT id_pbarang,status,nama_pegawai,kategori,nama_barang ,tgl_pengajuan,berkas ,alasan, grup 
                          FROM pengadaan_barang
                          INNER JOIN pegawai ON pegawai.id_pegawai = pengadaan_barang.id_pegawai
                          INNER JOIN pegawai_group ON pegawai.id_pegawai = pegawai_group.id_pegawai
                          INNER JOIN kategori_barang ON kategori_barang.id_kategori=pengadaan_barang.id_kategori
                          ORDER BY tgl_pengajuan DESC
                          LIMIT $start_from, $limit
                          ";
                  $s = mysqli_query($conn, $sql) or die (mysqli_error($conn));
                  $num_rows = mysqli_num_rows($s);
                  if (!empty($num_rows)) {
                  while ($tmp = mysqli_fetch_assoc($s)) {  
                    $l = mysqli_query($conn,"SELECT * FROM pegawai_approval_list WHERE object_id = '".$tmp['id_pbarang']."'AND type = 'barang'") or die(mysqli_error($conn));
                    $data = mysqli_fetch_array($l);
                  $no++
              ?>
              <tr>
                <td align="center"><?php echo $no; ?></td>
                <td><?php echo $tmp['nama_pegawai']; ?></td>
                <td><?php echo $tmp['tgl_pengajuan']; ?></td>
                <td><?php echo $tmp['kategori']; ?></td>
                <td><?php echo $tmp['nama_barang'] ?></td>
                <td><a href="<?php echo'berkas/'.$tmp['berkas']; ?>" ><?php echo $tmp['berkas'];  ?></a></td>
                <td><?php echo $tmp['alasan']; ?></td>
                <td>
                      <?php if ($tmp['status']=='disetujui'){ ?>
                          <span class="label label-success" style="font-size: 12px;">disetujui</span>
                      <?php } elseif ($tmp['status'] == 'ditolak') { ?>
                          <span class="label label-danger" style="font-size: 12px;">ditolak</span>
                      <?php } elseif ($tmp['status'] == 'Belum dikonfirmasi') { ?>
                          <span class="label label-warning" style="font-size: 12px;">Belum dikonfirmasi</span>
                      <?php } elseif ($tmp['status'] == 'disetujui 1 approvel') { ?>
                          <span class="label label-warning" style="font-size: 12px;">Disetujui 1 Approvel</span>
                      <?php } ?>
                </td>
                <td align='center'><a href='?&id_pbarang=<?php echo $tmp['id_pbarang']; ?>'><button class='btn btn-primary btn-sm'><i class="glyphicon glyphicon-eye-open"></i></button></a></td>
                  <?php 
                  $id_pegawai=$_SESSION['id_pegawai'];
                  $q = "SELECT * FROM pegawai_group WHERE id_pegawai='$id_pegawai'";
                  $a = mysqli_query($conn, $q) or die (mysqli_error($conn));
                  while ($t = mysqli_fetch_assoc($a)) {
                      if ($t['is_coordinator'] == '1') {
                  ?>
                <td align="center">
                    <a href="#" class="btn btn-success btn-sm open_modalbrg <?=$tmp['status'] != 'disetujui' && $tmp['status'] != 'ditolak' && $tmp['grup'] == $_SESSION['grup'] && $data['is_approval'] != 1 ? '' : 'disabled'?>" id="<?php echo $tmp['id_pbarang'];?>" ><i class="glyphicon glyphicon-check"></i></a>
                </td>
                <td align="center">
                    <a href="#" class="btn btn-danger btn-sm open_jonbrg <?=$tmp['status'] != 'disetujui' && $tmp['status'] != 'ditolak' && $tmp['grup'] == $_SESSION['grup'] && $data['is_approval'] != 1 ? '' : 'disabled'?>" id="<?php echo $tmp['id_pbarang'];?>"><i class="glyphicon glyphicon-remove"></i></a>
                </td>
                <td align="center"> 
                     <a href="#" class="btn btn-danger btn-sm <?=$tmp['status'] != 'Belum dikonfirmasi' ? '' : 'disabled'?>" onclick="confirmdel('admin/proses/hapus_barang.php?&id_pbarang=<?php echo $tmp['id_pbarang']; ?>');"><i class="glyphicon glyphicon-trash"></i></a>
                </td>
                <?php 
                }else{
                 ?>

                <td align="center">
                    <a href="#" class="btn btn-success btn-sm open_modalbrg <?=$tmp['status'] != 'disetujui' && $tmp['status'] != 'ditolak' ? '' : 'disabled'?>" id="<?php echo $tmp['id_pbarang'];?>" ><i class="glyphicon glyphicon-check"></i></a>
                </td>
                <td align="center">
                    <a href="#" class="btn btn-danger btn-sm open_jonbrg <?=$tmp['status'] != 'disetujui' && $tmp['status'] != 'ditolak' ? '' : 'disabled'?>" id="<?php echo $tmp['id_pbarang'];?>"><i class="glyphicon glyphicon-remove"></i></a>
                </td>
                <td align="center"> 
                     <a href="#" class="btn btn-danger btn-sm <?=$tmp['status'] != 'Belum dikonfirmasi' ? '' : 'disabled'?>" onclick="confirmdel('admin/proses/hapus_barang.php?&id_pbarang=<?php echo $tmp['id_pbarang']; ?>');"><i class="glyphicon glyphicon-trash"></i></a>
                </td>
                <?php 
                }}
                ?>
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
<!-- </div> -->

            <!-- modal setuju brg-->
        <div id="modalsetujubrg" class="modal fade" role="dialog" style="margin-top:100px;">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <div class="fetched-data"></div>
              </div>
            </div>
          </div>
        </div>
        <!-- end of modal setuju brg-->
        <!-- modal tolak brg-->
        <div id="modaltolakbrg" class="modal fade" role="dialog" style="margin-top:100px;">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <div class="fetched-data"></div>
              </div>
            </div>
          </div>
        </div>
        <!-- end of modal tolak brg-->
    <!--END CONTACT SECTION-->
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
            <!-- confirm modal hapus brg -->
            <div class="modal fade" id="modal_deletebrg" style="margin-top: 150px">
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
            <!-- end of confirm modal hapus brg-->
        <div id="modalnote" class="modal fade" role="dialog" style="margin-top:100px;">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <div class="fetched-data"></div>
              </div>
            </div>
          </div>
        </div>
        <div id="modalnote2" class="modal fade" role="dialog" style="margin-top:100px;">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <div class="fetched-data"></div>
              </div>
            </div>
          </div>
        </div>
        <div id="modalnotebrg" class="modal fade" role="dialog" style="margin-top:100px;">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <div class="fetched-data"></div>
              </div>
            </div>
          </div>
        </div>
        <div id="modalnotebrg2" class="modal fade" role="dialog" style="margin-top:100px;">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <div class="fetched-data"></div>
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
    <!--FOOTER SECTION -->
    <?php include 'footer.php'; ?>
    <!-- END FOOTER SECTION -->

    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
<!--     <script src="jquery-2.2.2.js"></script> -->
    <!-- BOOTSTRAP CORE SCRIPT   -->
    <script src="assets/plugins/bootstrap.min.js"></script>  
     <!-- ISOTOPE SCRIPT   -->
  <!--   <script src="assets/plugins/jquery.isotope.min.js"></script> -->
    <!-- PRETTY PHOTO SCRIPT   -->
    <script src="assets/plugins/jquery.prettyPhoto.js"></script>    
    <!-- CUSTOM SCRIPTS -->
    <!-- 	<script src="assets/js/custom.js"></script> -->
  <!--   <script src="http://cdn.jsdelivr.net/webshim/1.12.4/extras/modernizr-custom.js"></script> -->
    <!-- polyfiller file to detect and load polyfills -->
    <!-- <script src="http://cdn.jsdelivr.net/webshim/1.12.4/polyfiller.js"></script>
    <script>
      webshims.setOptions('waitReady', false);
      webshims.setOptions('forms-ext', {types: 'date'});
      webshims.polyfill('forms forms-ext');
    </script> -->
    <script type="text/javascript">
        function confirmdel(delete_url) {
          $('#modal_deletebrg').modal('show', {backdrop:'static'});
          document.getElementById('delete_link').setAttribute('href', delete_url);
        }
    </script>
    <script src="build/js/custom.min.js"></script>
     <script type="text/javascript">
        function confirmdel(delete_url) {
          $('#modal_delete').modal('show', {backdrop:'static'});
          document.getElementById('delete_link').setAttribute('href', delete_url);
        }
    </script>
    <script type="text/javascript">
    $(document).ready(function () {
       $(".notebrg").click(function(e) {
          var m = $(this).attr("id");
          $.ajax({
            url: "modal/notebrg.php",
            type: "get",
            data : {id_pbarang: m,},
            success: function (ajaxData){
              $("#modalnotebrg").html(ajaxData);
              $("#modalnotebrg").modal('show',{backdrop: 'true'});
               }
             });
          });
        });
    </script>
    <script type="text/javascript">
    $(document).ready(function () {
       $(".notebrg2").click(function(e) {
          var m = $(this).attr("id");
          $.ajax({
            url: "modal/notebrg2.php",
            type: "get",
            data : {id_pbarang: m,},
            success: function (ajaxData){
              $("#modalnotebrg2").html(ajaxData);
              $("#modalnotebrg2").modal('show',{backdrop: 'true'});
               }
             });
          });
        });
    </script>
    <script type="text/javascript">
    $(document).ready(function () {
       $(".note").click(function(e) {
          var m = $(this).attr("id");
          $.ajax({
            url: "modal/note.php",
            type: "get",
            data : {id_pcuti: m,},
            success: function (ajaxData){
              $("#modalnote").html(ajaxData);
              $("#modalnote").modal('show',{backdrop: 'true'});
               }
             });
          });
        });
    </script>
    <script type="text/javascript">
    $(document).ready(function () {
       $(".note2").click(function(e) {
          var m = $(this).attr("id");
          $.ajax({
            url: "modal/note2.php",
            type: "get",
            data : {id_pcuti: m,},
            success: function (ajaxData){
              $("#modalnote2").html(ajaxData);
              $("#modalnote2").modal('show',{backdrop: 'true'});
               }
             });
          });
        });
    </script>
    <script type="text/javascript">
    $(document).ready(function () {
       $(".open_modal").click(function(e) {
          var m = $(this).attr("id");
          $.ajax({
            url: "admin/setuju.php",
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
            url: "admin/tolak.php",
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
       $(".open_modalbrg").click(function(e) {
          var m = $(this).attr("id");
          $.ajax({
            url: "admin/setuju_brg.php",
            type: "get",
            data : {id_pbarang: m,},
            success: function (ajaxData){
              $("#modalsetujubrg").html(ajaxData);
              $("#modalsetujubrg").modal('show',{backdrop: 'true'});
               }
             });
          });
        });
    </script>
    <script type="text/javascript">
    $(document).ready(function () {
       $(".open_jonbrg").click(function(e) {
          var m = $(this).attr("id");
          $.ajax({
            url: "admin/tolak_brg.php",
            type: "get",
            data : {id_pbarang: m,},
            success: function (ajaxData){
              $("#modaltolakbrg").html(ajaxData);
              $("#modaltolakbrg").modal('show',{backdrop: 'true'});
               }
             });
          });
        });
    </script>
</body>
</html>
