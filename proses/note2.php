<?php 
	include '../koneksi.php';
	$id_pcuti = $_POST['id_pcuti'];
	$note2 = $_POST['note2'];
	$a = "UPDATE permohonan_cuti SET note2 = '$note2' WHERE id_pcuti = '$id_pcuti'";
	$b = mysqli_query($conn,$a) or die (mysqli_error());
	if ($b == true){
		echo "<script>alert('Note $id_pcuti Terkirim')</script>";
	}else{
		echo "<script>alert('Mohon Maaf Note Gagal Terkirim')</script>";
	}
?>
<meta http-equiv="refresh" content="0;URL=../approvel.php" />