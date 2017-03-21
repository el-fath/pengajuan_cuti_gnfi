<?php 
	include '../koneksi.php';

	$id_jabatan = $_POST['id_jabatan'];
	$jabatan = $_POST['jabatan'];

	$sql = "INSERT INTO jabatan VALUES('$id_jabatan','$jabatan')";
	$s = mysqli_query($conn, $sql) or die (mysqli_error($conn));
	if ($s) {
		echo "<script>Alert('DATA BERHASIL DI TAMBAH :-)') location.replace('index.php')</script>";
		header('location:../list_jabatan.php');
	}else {
		echo "<script>Alert('DATA GAGAL MASUK :-(') location.replace('../list_jabatan.php')</script>";
	}
?>