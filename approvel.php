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
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
</head>
<body>
    <?php include 'header.php'; ?>
    <?php include 'koneksi.php'; ?>
    <!--HOME SECTION-->
<div class="container">
    <?php 
    $id_pegawai=$_SESSION['id_pegawai'];
    $q = "SELECT * FROM pegawai_group WHERE id_pegawai='$id_pegawai'";
    $a = mysqli_query($conn, $q) or die (mysqli_error($conn));
    while ($t = mysqli_fetch_assoc($a)) {
        if ($t['is_coordinator'] == '1') {
    ?>
        <h2 style="padding-top: 80px;"><center>Halaman Approvel</center></h2>
        <div class="table-responsive">
        <table border="2" align="center" class="table table-bordered" style="font-size: 15px;">
            <tr>
            	<th>NAMA</th>
            	<th>TGL PENGAJUAN</th>
            	<th>MULAI CUTI</th>
            	<th>AKHIR CUTI</th>
            	<th>ALASAN CUTI</th>
            	<th>JENIS CUTI</th>
            	<th>STATUS</th>
            	<th colspan="3"><center>ACTION</center></th>
            </tr>
            <?php 
	              $limit = 10;  
	              if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
	              $start_from = ($page-1) * $limit; 
	              $sql = "SELECT id_pcuti,nama_pegawai, nama_cuti, tgl_pengajuan, lama_cuti,status, tgl_mulai_cuti,tgl_akhir_cuti, 	   alasan , jatah_cuti, lama_cuti ,grup
	                      FROM permohonan_cuti
	                      INNER JOIN pegawai ON pegawai.id_pegawai = permohonan_cuti.id_pegawai
	                      INNER JOIN pegawai_group ON pegawai.id_pegawai = pegawai_group.id_pegawai
	                      INNER JOIN jenis_cuti ON jenis_cuti.id_jcuti = permohonan_cuti.id_jcuti
	                      ORDER BY tgl_pengajuan DESC
	                      LIMIT $start_from, $limit";
	              $s = mysqli_query($conn, $sql) or die (mysqli_error($conn));
	              $num_rows = mysqli_num_rows($s);
	              if (!empty($num_rows)) {
	              while ($tmp = mysqli_fetch_assoc($s)) {  
	              $no++
          	?>
          	<tr>
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
                        <span class="label label-warning" style="font-size: 12px;">Belum dikonfirmasi</span>
                    <?php } ?>
                </td>
        		<td align="center">
                    <a href="#" class="btn btn-xs btn-success open_modal <?=$tmp['status'] != 'disetujui' && $tmp['status'] != 'ditolak' && $tmp['grup'] == $_SESSION['grup'] ? '' : 'disabled'?>" id="<?php echo $tmp['id_pcuti'];?>" ><i class="glyphicon glyphicon-check"></i> setujui</a>
                </td>
                <td align="center">
                    <a href="#" class="btn btn-xs btn-danger open_jon <?=$tmp['status'] != 'disetujui' && $tmp['status'] != 'ditolak' && $tmp['grup'] == $_SESSION['grup']? '' : 'disabled'?>" id="<?php echo $tmp['id_pcuti'];?>"><i class="glyphicon glyphicon-remove"></i> Tolak</a>
                </td>
                <td align="center"> 
                     <a href="#" class="btn btn-xs btn-danger <?=$tmp['status'] != 'Belum dikonfirmasi' ? '' : 'disabled'?>" onclick="confirmdel('admin/proses/hapus_cuti.php?&id_pcuti=<?php echo $tmp['id_pcuti']; ?>');"><i class="glyphicon glyphicon-trash"></i> hapus</a>
                </td>
          	</tr>
          	<?php }}else{ ?>
            <tr>
                <td align="center" colspan="8">Data Belum Tersedia</td>
            </tr>
            <?php } ?>
        </table>
        </div>
          
            <?php  
              $sql = "SELECT COUNT(id_pcuti) FROM permohonan_cuti ";  
              $rs_result = mysqli_query($conn,$sql) or die(mysqli_error($conn));  
              $row = mysqli_fetch_row($rs_result);  
              $total_records = $row[0];  
              $total_pages = ceil($total_records / $limit);  
              $pagLink = "<ul class='pagination' style='padding-left: 179px;'>";  
              for ($i=1; $i<=$total_pages; $i++) {  
                           $pagLink .= "<li><a href='approvel.php?page=".$i."'>".$i."</a></li>";  
              };  
              echo $pagLink . "</ul";  
              ?>
          <?php 
          }else{
          ?>
        </div>

<div class="container">
          
        <h2 style="padding-top: 80px;"><center>Halaman Approvel</center></h2>
        <table border="2" align="center" class="table table-bordered">
            <tr>
              <th>NAMA</th>
              <th>TGL PENGAJUAN</th>
              <th>MULAI CUTI</th>
              <th>AKHIR CUTI</th>
              <th>ALASAN CUTI</th>
              <th>JENIS CUTI</th>
              <th>STATUS</th>
              <th colspan="3"><center>ACTION</center></th>
            </tr>
            <?php 
                $limit = 10;  
                if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
                $start_from = ($page-1) * $limit; 
                $sql = "SELECT id_pcuti,nama_pegawai, nama_cuti, tgl_pengajuan, lama_cuti,status, tgl_mulai_cuti,tgl_akhir_cuti,     alasan , jatah_cuti, lama_cuti ,grup
                        FROM permohonan_cuti
                        INNER JOIN pegawai ON pegawai.id_pegawai = permohonan_cuti.id_pegawai
                        INNER JOIN pegawai_group ON pegawai.id_pegawai = pegawai_group.id_pegawai
                        INNER JOIN jenis_cuti ON jenis_cuti.id_jcuti = permohonan_cuti.id_jcuti
                        ORDER BY tgl_pengajuan DESC
                        LIMIT $start_from, $limit";
                $s = mysqli_query($conn, $sql) or die (mysqli_error($conn));
                $num_rows = mysqli_num_rows($s);
                if (!empty($num_rows)) {
                while ($tmp = mysqli_fetch_assoc($s)) {  
                $no++
            ?>
            <tr>
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
                        <span class="label label-warning" style="font-size: 12px;">Belum dikonfirmasi</span>
                    <?php } ?>
                </td>
            <td align="center">
                    <a href="#" class="btn btn-xs btn-success open_modal <?=$tmp['status'] != 'disetujui' && $tmp['status'] != 'ditolak' ? '' : 'disabled'?>" id="<?php echo $tmp['id_pcuti'];?>" ><i class="glyphicon glyphicon-check"></i> setujui</a>
                </td>
                <td align="center">
                    <a href="#" class="btn btn-xs btn-danger open_jon <?=$tmp['status'] != 'disetujui' && $tmp['status'] != 'ditolak' ? '' : 'disabled'?>" id="<?php echo $tmp['id_pcuti'];?>"><i class="glyphicon glyphicon-remove"></i> Tolak</a>
                </td>
                <td align="center"> 
                     <a href="#" class="btn btn-xs btn-danger <?=$tmp['status'] != 'Belum dikonfirmasi' ? '' : 'disabled'?>" onclick="confirmdel('admin/proses/hapus_cuti.php?&id_pcuti=<?php echo $tmp['id_pcuti']; ?>');"><i class="glyphicon glyphicon-trash"></i> hapus</a>
                </td>
            </tr>
            <?php }}else{ ?>
            <tr>
                <td align="center" colspan="8">Data Belum Tersedia</td>
            </tr>
            <?php } ?>
        </table>
</div>
        <div class="container">
          
            <?php  
              $sql = "SELECT COUNT(id_pcuti) FROM permohonan_cuti ";  
              $rs_result = mysqli_query($conn,$sql) or die(mysqli_error($conn));  
              $row = mysqli_fetch_row($rs_result);  
              $total_records = $row[0];  
              $total_pages = ceil($total_records / $limit);  
              $pagLink = "<ul class='pagination' style='padding-left: 150px;'>";  
              for ($i=1; $i<=$total_pages; $i++) {  
                           $pagLink .= "<li><a href='approvel.php?page=".$i."'>".$i."</a></li>";  
              };  
              echo $pagLink . "</ul";  
              ?>
            <?php 
            }}
            ?>
        </div> <!-- end of approvel cuti -->

<div class="container"><!-- start of approval barang -->
    <?php 
    $id_pegawai=$_SESSION['id_pegawai'];
    $q = "SELECT * FROM pegawai_group WHERE id_pegawai='$id_pegawai'";
    $a = mysqli_query($conn, $q) or die (mysqli_error($conn));
    while ($t = mysqli_fetch_assoc($a)) {
        if ($t['is_coordinator'] == '1') {
    ?>
        <h2 style="padding-top: 80px;"><center>Approvel Barang</center></h2>
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
              <th colspan="3"><center>ACTION</center></th>
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
                    <?php } ?>
                </td>
            <td align="center">
                    <a href="#" class="btn btn-xs btn-success open_modalbrg <?=$tmp['status'] != 'disetujui' && $tmp['status'] != 'ditolak' && $tmp['grup'] == $_SESSION['grup'] ? '' : 'disabled'?>" id="<?php echo $tmp['id_pbarang'];?>" ><i class="glyphicon glyphicon-check"></i> setujui</a>
                </td>
                <td align="center">
                    <a href="#" class="btn btn-xs btn-danger open_jonbrg <?=$tmp['status'] != 'disetujui' && $tmp['status'] != 'ditolak' && $tmp['grup'] == $_SESSION['grup']? '' : 'disabled'?>" id="<?php echo $tmp['id_pbarang'];?>"><i class="glyphicon glyphicon-remove"></i> Tolak</a>
                </td>
                <td align="center"> 
                     <a href="#" class="btn btn-xs btn-danger <?=$tmp['status'] != 'Belum dikonfirmasi' ? '' : 'disabled'?>" onclick="confirmdel('admin/proses/hapus_barang.php?&id_pbarang=<?php echo $tmp['id_pbarang']; ?>');"><i class="glyphicon glyphicon-trash"></i> hapus</a>
                </td>
            </tr>
            <?php }}else{ ?>
            <tr>
                <td align="center" colspan="8">Data Belum Tersedia</td>
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
          <?php 
          }else{
           ?>
        </div>

<div class="container">
          
        <h2 style="padding-top: 80px;"><center>Halaman Approvel</center></h2>
        <table border="2" align="center" class="table table-bordered">
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
                    <?php } ?>
                </td>
            <td align="center">
                    <a href="#" class="btn btn-xs btn-success open_modalbrg <?=$tmp['status'] != 'disetujui' && $tmp['status'] != 'ditolak' ? '' : 'disabled'?>" id="<?php echo $tmp['id_pbarang'];?>" ><i class="glyphicon glyphicon-check"></i> setujui</a>
                </td>
                <td align="center">
                    <a href="#" class="btn btn-xs btn-danger open_jonbrg <?=$tmp['status'] != 'disetujui' && $tmp['status'] != 'ditolak' ? '' : 'disabled'?>" id="<?php echo $tmp['id_pbarang'];?>"><i class="glyphicon glyphicon-remove"></i> Tolak</a>
                </td>
                <td align="center"> 
                     <a href="#" class="btn btn-xs btn-danger <?=$tmp['status'] != 'Belum dikonfirmasi' ? '' : 'disabled'?>" onclick="confirmdel('admin/proses/hapus_barang.php?&id_pbarang=<?php echo $tmp['id_pbarang']; ?>');"><i class="glyphicon glyphicon-trash"></i> hapus</a>
                </td>
            </tr>
            <?php }}else{ ?>
            <tr>
                <td align="center" colspan="9">Data Belum Tersedia</td>
            </tr>
            <?php } ?>
        </table>
</div>
        <div class="container">
          
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
            <?php 
            }}
            ?>
        </div><!--end of approval barang-->
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
