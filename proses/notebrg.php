<?php 
	include '../koneksi.php';
	$id_pbarang = $_POST['id_pbarang'];
	$note = $_POST['note'];
	$a = "UPDATE Pengadaan_barang SET note = '$note' WHERE id_pbarang = '$id_pbarang'";
	$b = mysqli_query($conn,$a) or die (mysqli_error());
	if ($b == true){
		echo "<script>alert('Note $id_pbarang Terkirim')</script>";
	}else{
		echo "<script>alert('Mohon Maaf Note Gagal Terkirim')</script>";
	}
?>
<meta http-equiv="refresh" content="0;URL=../approvel.php" />