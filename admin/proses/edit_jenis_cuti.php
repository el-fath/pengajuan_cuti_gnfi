<?php 
	include "../koneksi.php";

	$id_jcuti = $_POST['id_jcuti'];
	$nama_cuti = $_POST['nama_cuti'];

	$sql = "UPDATE jenis_cuti SET id_jcuti = '$id_jcuti', nama_cuti = '$nama_cuti' WHERE id_jcuti = '$id_jcuti'";

	$s = mysqli_query($conn, $sql) or die(mysqli_error($conn));
	header("location:../list_jenis_cuti.php");
?>