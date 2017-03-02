<?php 
session_start();
include 'koneksi.php';
$id_pbarang = $_POST['id_pbarang'];
$tgl_sah = date('Y/m/d');
$grup = $_SESSION['grup'];
if ($_POST['id_jcuti'] != '2' ) {
	if ($_SESSION['is_coordinator'] == 1 ) {
		// $query= mysqli_query($conn,"SELECT * FROM pegawai_group WHERE is_coordinator = 1 AND grup = '$grup'")or die(mysqli_error($conn));
		$sql = "UPDATE pegawai_approval_list SET is_approval = '1' WHERE approval_id = '$id_pegawai' AND object_id ='$id_pcuti'"; 
	}
	$approve = mysqli_query($conn,"SELECT id_pegawai FROM pegawai_approval") or die (mysqli_error($conn));

	$approve_user = mysqli_fetch_array($approve);

	$sql = "UPDATE pegawai_approval_list SET is_approval = '1' WHERE approval_id = '$approve_user' AND object_id ='$id_pcuti'";
} else {

}

// $sql = "UPDATE pengadaan_barang SET status = 'disetujui', tgl_sah = '$tgl_sah' WHERE id_pbarang = '$id_pbarang'";
// $s = mysqli_query($conn, $sql) or die (mysqli_error($conn));
$s = mysqli_query($conn, $sql) or die (mysqli_error($conn));
?>
<meta http-equiv="refresh" content="0;URL='data_barang.php'" />