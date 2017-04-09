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
     <div class="container">
      <div class="row" style="padding-top: 120px">
        <div class="col-md-4"></div>
            <!-- <div class="btn-group col-md-8" role="group" aria-label="...">
              <a href="approvel.php"><button type="button" class="btn btn-default btn-lg" style="padding-left: 60px; padding-right: 60px">cuti</button></a>
              <a href="barang.php"><button type="button" class="btn btn-default btn-lg" style="padding-left: 50px; padding-right: 50px; background-color: #0df5d2">barang</button></a>
            </div> -->
      </div>  
    </div>
  <div class="container"><!-- start of approval barang -->
    
        <h2 ><center>DATA BARANG <?php echo strtoupper($_SESSION['username']) ?></center></h2>
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
                  $l = mysqli_query($conn,"SELECT * FROM pegawai_approval_list WHERE object_id = '".$tmp['id_pbarang']."'") or die(mysqli_error($conn));
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
                    <?php } ?>
                </td>
                <?php 
                $id_pegawai=$_SESSION['id_pegawai'];
                $q = "SELECT * FROM pegawai_group WHERE id_pegawai='$id_pegawai'";
                $a = mysqli_query($conn, $q) or die (mysqli_error($conn));
                while ($t = mysqli_fetch_assoc($a)) {
                ?>
                <td align="center">
                    <a href="#" class="btn btn-xs btn-warning open_modalbrg <?=$tmp['status'] != 'disetujui' && $tmp['status'] != 'ditolak' ? '' : 'disabled'?>" id="<?php echo $tmp['id_pbarang'];?>" ><i class="glyphicon glyphicon-pencil"></i> EDIT</a>
                </td>
                <td align="center"> 
                     <a href="#" class="btn btn-xs btn-danger <?=$tmp['status'] != 'Belum dikonfirmasi' ? '' : 'disabled'?>" onclick="confirmdel('admin/proses/hapus_barang.php?&id_pbarang=<?php echo $tmp['id_pbarang']; ?>');"><i class="glyphicon glyphicon-trash"></i> hapus</a>
                </td>
                <?php 
                }
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
            <?php  
                $sql = "SELECT COUNT(id_pbarang) FROM pengadaan_barang";  
                $rs_result = mysqli_query($conn,$sql) or die(mysqli_error($conn));  
                $row = mysqli_fetch_row($rs_result);  
                $total_records = $row[0];  
                $total_pages = ceil($total_records / $limit);  
                $pagLink = "<ul class='pagination' style='margin-left:105px'>";  
                for ($i=1; $i<=$total_pages; $i++) {  
                             $pagLink .= "<li><a href='barang.php?page=".$i."'>".$i."</a></li>";  
                };  
                echo $pagLink . "</ul";  
                ?>
        <!-- end of modal tolak brg-->
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

        <div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div> 
    <?php include 'footer.php'; ?>
</body>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="assets/plugins/bootstrap.min.js"></script>  

    <script type="text/javascript">
      function confirmdel(delete_url) {
        $('#modal_deletebrg').modal('show', {backdrop:'static'});
        document.getElementById('delete_link').setAttribute('href', delete_url);
      }
    </script>
    <script type="text/javascript">
    $(document).ready(function () {
        $(".open_modalbrg").click(function(e) {
          var m = $(this).attr("id");
          $.ajax({
            url: "modaledit_barang.php",
            type: "get",
            data : {id_pbarang: m,},
            success: function (ajaxData){
              $("#ModalEdit").html(ajaxData);
              $("#ModalEdit").modal('show',{backdrop: 'true'});
            }
          });
        });
    });
    </script>
</html>