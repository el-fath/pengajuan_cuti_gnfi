<?php 
	include '../koneksi.php';

	$id_kategori = null;
	$kategori = $_POST['kategori'];

	$sql = "INSERT INTO kategori_barang VALUES('$id_kategori','$kategori')";
	$s = mysqli_query($conn, $sql) or die (mysqli_error($conn));
	if ($s) {
		echo "<script>Alert('DATA BERHASIL DI TAMBAH :-)') location.replace('index.php')</script>";
		header('location:../list_kategori.php');
	}else {
		echo "<script>Alert('DATA GAGAL MASUK :-(') location.replace('../list_kategori.php')</script>";
	}
?>