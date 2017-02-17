<?php  
	include '../koneksi.php';

	$id_pegawai = $_GET['id_pegawai'];

	$sql = "DELETE FROM pegawai WHERE id_pegawai='$id_pegawai'";
	$s = mysqli_query($conn, $sql) or die(mysqli_error($conn));
	header("location:../list_pegawai.php");
?>