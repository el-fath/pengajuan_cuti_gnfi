<?php  
	include '../koneksi.php';

	$id_jcuti = $_GET['id_jcuti'];

	$sql = "DELETE FROM jenis_cuti WHERE id_jcuti='$id_jcuti'";
	$s = mysqli_query($conn, $sql) or die(mysqli_error($conn));
	header("location:../list_jenis_cuti.php");
?>