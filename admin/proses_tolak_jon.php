<?php 
include 'koneksi.php';
$id_pcuti = $_POST['id_pcuti'];
$note = $_POST['note'];
$tgl_sah = date('Y/m/d');
$sql = "UPDATE permohonan_cuti SET note='$note',status = 'ditolak', tgl_sah = '$tgl_sah' WHERE id_pcuti = '$id_pcuti'";
$s = mysqli_query($conn, $sql) or die (mysqli_error($conn));
?>
<meta http-equiv="refresh" content="0;URL='../approvel.php'" />