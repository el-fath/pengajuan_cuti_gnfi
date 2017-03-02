<?php 
session_start();
include 'koneksi.php';
$id_pbarang = $_POST['id_pbarang'];
$tgl_sah = date('Y/m/d');
$grup = $_SESSION['grup'];

if ($_SESSION['is_coordinator'] == 1 ) {
	// $query= mysqli_query($conn,"SELECT * FROM pegawai_group WHERE is_coordinator = 1 AND grup = '$grup'")or die(mysqli_error($conn));
	$query = mysqli_query($conn,"UPDATE pegawai_approval_list set is_approval = '1'") or die(mysqli_error($conn));
}

// $sql = "UPDATE pengadaan_barang SET status = 'disetujui', tgl_sah = '$tgl_sah' WHERE id_pbarang = '$id_pbarang'";
// $s = mysqli_query($conn, $sql) or die (mysqli_error($conn));
?>
<meta http-equiv="refresh" content="0;URL='data_barang.php'" />