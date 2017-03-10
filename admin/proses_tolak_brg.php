<?php 
include 'koneksi.php';
$id_pbarang = $_POST['id_pbarang'];
$tgl_sah = date('Y/m/d');
$note = $_POST['note'];
$sql = "UPDATE pengadaan_barang SET note='$note', status = 'ditolak', tgl_sah = '$tgl_sah' WHERE id_pbarang = '$id_pbarang'";
$s = mysqli_query($conn, $sql) or die (mysqli_error($conn));


?>

<meta http-equiv="refresh" content="0;URL='../approvel.php'" />