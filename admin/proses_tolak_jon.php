<?php 
include 'koneksi.php';
$id_pcuti = $_POST['id_pcuti'];
$tgl_sah = date('Y/m/d');
$sql = "UPDATE permohonan_cuti SET status = 'ditolak', tgl_sah = '$tgl_sah' WHERE id_pcuti = '$id_pcuti'";
$s = mysqli_query($conn, $sql) or die (mysqli_error($conn));
?>
<meta http-equiv="refresh" content="0;URL='../approvel.php'" />