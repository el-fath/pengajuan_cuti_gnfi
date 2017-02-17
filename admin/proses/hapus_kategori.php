<?php  
	include '../koneksi.php';

	$id_kategori = $_GET['id_kategori'];

	$sql = "DELETE FROM kategori_barang WHERE id_kategori='$id_kategori'";
	$s = mysqli_query($conn, $sql) or die(mysqli_error($conn));
	header("location:../list_kategori.php");
?>