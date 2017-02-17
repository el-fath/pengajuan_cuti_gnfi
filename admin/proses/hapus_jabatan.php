<?php  
	include '../koneksi.php';

	$id_jabatan = $_GET['id_jabatan'];

	$sql = "DELETE FROM jabatan WHERE id_jabatan='$id_jabatan'";
	$s = mysqli_query($conn, $sql) or die(mysqli_error($conn));
	header("location:../list_jabatan.php");
?>