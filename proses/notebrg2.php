<?php 
	include '../koneksi.php';
	$id_pbarang = $_POST['id_pbarang'];
	$note2 = $_POST['note2'];
	$a = "UPDATE Pengadaan_barang SET note2 = '$note2' WHERE id_pbarang = '$id_pbarang'";
	$b = mysqli_query($conn,$a) or die (mysqli_error());
	if ($b == true){
		echo "<script>alert('Note $id_pbarang Terkirim')</script>";
	}else{
		echo "<script>alert('Mohon Maaf Note Gagal Terkirim')</script>";
	}
?>
<meta http-equiv="refresh" content="0;URL=../approvel.php" />