<?php 
	include '../koneksi.php';

	$id_jcuti = $_POST['id_jcuti'];
	$nama_cuti = $_POST['nama_cuti'];

	$sql = "INSERT INTO jenis_cuti VALUES('$id_jcuti','$nama_cuti')";
	$s = mysqli_query($conn, $sql) or die (mysqli_error($conn));
	if ($s) {
		echo "<script>Alert('DATA BERHASIL DI TAMBAH :-)') location.replace('index.php')</script>";
		header('location:../list_jenis_cuti.php');
	}else {
		echo "<script>Alert('DATA GAGAL MASUK :-(') location.replace('../list_jenis_cuti.php')</script>";
	}
?>