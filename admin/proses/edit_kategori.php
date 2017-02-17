<?php 
	include "../koneksi.php";

	$id_kategori = $_POST['id_kategori'];
	$kategori = $_POST['kategori'];

	$sql = "UPDATE kategori_barang SET id_kategori = '$id_kategori', kategori = '$kategori' WHERE id_kategori = '$id_kategori'";

	$s = mysqli_query($conn, $sql) or die(mysqli_error($conn));
	header("location:../list_kategori.php");
?>