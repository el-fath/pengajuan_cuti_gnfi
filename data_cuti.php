<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>INTERNAL WEBSITE GNFI</title>
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
</head>
<body>
	<?php 
	include 'header.php'; 
	include 'koneksi.php';
	?>
	<h1 style="margin-top: 100px">DATA CUTI <?php echo strtoupper($_SESSION['username']) ; ?></h1>
	<div class="container-fluid">
		<div class="table-responsive">
			<table class="table table-bordered">
				<tr> </center>
					<th><center><strong>NO</strong></center></th>
					<th><center><strong>TGL PENGAJUAN</strong></center></th>
					<th><center><strong>LAMA CUTI</strong></center></th>
					<th><center><strong>MULAI CUTI</strong></center></th>
					<th><center><strong>AKHIR CUTI</strong></center></th>
					<th><center><strong>ALASAN CUTI</strong></center></th>
					<th><center><strong>STATUS</strong></center></th>
					<th colspan="3"><center><strong>ACTION</strong></center></th>
				</tr>
				<?php  
					$id_pegawai=$_SESSION['id_pegawai'];
					$no=0;
					$sql=mysqli_query($conn,"SELECT * FROM permohonan_cuti
						INNER JOIN pegawai ON pegawai.id_pegawai = permohonan_cuti.id_pegawai
						WHERE permohonan_cuti.id_pegawai='$id_pegawai'") or die(mysqli_error($conn));
					$num_rows = mysqli_num_rows($sql);
					if(!empty($num_rows)) {
						while ($tmp = mysqli_fetch_assoc($sql)) {
							$no++
				?>
				<tr> 
					<td><center><?php echo $no; ?></center></td>	
					<td><center><?php echo $tmp['tgl_pengajuan']; ?></center></td>
					<td><center><?php echo $tmp['lama_cuti']; ?></center></td>
					<td><center><?php echo $tmp['tgl_mulai_cuti']; ?></center></td>
					<td><center><?php echo $tmp['tgl_akhir_cuti']; ?></center></td>
					<td><center><?php echo $tmp['alasan']; ?></td>
					<td><center><?php if ($tmp['status']=='disetujui'){ ?>
	                        <center><span class="label label-success" style="font-size: 14px;">disetujui</span></center>
	                    <?php } elseif ($tmp['status'] == 'ditolak') { ?>
	                        <center><span class="label label-danger" style="font-size: 14px;">ditolak</span></center>
	                    <?php } elseif ($tmp['status'] == 'Belum dikonfirmasi') { ?>
	                        <center><span class="label label-warning" style="font-size: 14px;">Belum dikonfirmasi</span></center>
	                    <?php } ?></td>
					<td align="center">
						<a href="#" class="btn btn-xs btn-warning open_modal <?=$tmp['status'] != 'disetujui' && $tmp['status'] != 'ditolak' ? '' : 'disabled'?>" id="<?php echo $tmp['id_pcuti'];?>" style="font-size: 14px"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
					</td>

					<td align="center"> 
						<a style="font-size: 14px" href="#" class="btn btn-xs btn-primary " ><i class="glyphicon glyphicon-list"></i> detail</a>
					</td>
					<td align="center"> 
						<a style="font-size: 14px" href="#" class="btn btn-xs btn-danger <?=$tmp['status'] != 'Belum dikonfirmasi' ? '' : 'disabled'?>" onclick="confirmdel('admin/proses/hapus_cuti.php?&id_pcuti=<?php echo $tmp['id_pcuti']; ?>');"><i class="glyphicon glyphicon-trash"></i> hapus</a>
					</td>
				</tr>
				<?php 
				}}
				?>
			</table>
			</div>	
			<div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div> 
	</div>
	<?php include 'footer.php'; ?>
</body>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="assets/plugins/bootstrap.min.js"></script>  
<script src="assets/plugins/jquery.prettyPhoto.js"></script>    
<script type="text/javascript">
	$(document).ready(function () {
		$(".open_modal").click(function(e) {
		var m = $(this).attr("id");
			$.ajax({
				url: "modaledit_datacuti.php",
				type: "GET",
				data : {id_pcuti: m,},
				success: function (ajaxData){
					$("#ModalEdit").html(ajaxData);
					$("#ModalEdit").modal('show',{backdrop: 'true'});
				}
			});
		});
	});
</script>
</html>