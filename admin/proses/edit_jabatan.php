<?php 
	include "../koneksi.php";

	$id_jabatan = $_POST['id_jabatan'];
	$jabatan = $_POST['jabatan'];

	$sql = "UPDATE jabatan SET id_jabatan = '$id_jabatan', jabatan = '$jabatan' WHERE id_jabatan = '$id_jabatan'";

	$s = mysqli_query($conn, $sql) or die(mysqli_error($conn));
	header("location:../list_jabatan.php");
?>