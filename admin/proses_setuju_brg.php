<?php 
session_start();
include 'koneksi.php';
$id_pbarang = $_POST['id_pbarang'];
$tgl_sah = date('Y/m/d');
$grup = $_SESSION['grup'];
$username = $_SESSION['username'];
$id_pegawai = $_SESSION['id_pegawai'];
	if ($_SESSION['is_coordinator'] == 1 ) {
		$l =mysqli_query($conn,"UPDATE pegawai_approval_list SET is_approval = '1' WHERE approval_id = '$id_pegawai' AND object_id ='$id_pbarang'") or die(mysqli_error($conn));
		$m = mysqli_query($conn,"SELECT * FROM pegawai_approval_list") or die(mysqli_error($conn));
		$data = mysqli_fetch_array($m);
		if ($data['object_id'] == '$id_pbarang' && $data['is_approval'] == 1) {
			$sql = "UPDATE pengadaan_barang SET status = 'disetujui', tgl_sah = '$tgl_sah' WHERE id_pbarang = '$id_pbarang'";
		}
		// $sql = "UPDATE pengadaan_barang SET disahkan = '$id_pegawai'" 
	} else {
		$approve = mysqli_query($conn,"SELECT id_pegawai FROM pegawai_approval") or die (mysqli_error($conn));
		$approve_user = mysqli_fetch_array($approve);
		$sql = "UPDATE pegawai_approval_list SET is_approval = '1' WHERE approval_id = '".$approve_user['id_pegawai']."'AND object_id ='$id_pbarang'";
		// $m = mysqli_query($conn,"SELECT * FROM pegawai_approval_list") or die(mysqli_error($conn));
		// $data = mysqli_fetch_array($m);
		// if ($data['object_id'] == '$id_pbarang' && $data['is_approval'] == 1) {
		// 	$sql = "UPDATE pengadaan_barang SET status = 'disetujui', tgl_sah = '$tgl_sah' WHERE id_pbarang = '$id_pbarang'";
		// }
	}

// $ql = mysqli_query($conn,"SELECT * FROM pegawai_approval_list WHERE is_approval = 1 AND object_id = '$id_pbarang'") or die(mysqli_error($conn));
// $q = mysqli_fetch_array($ql)



// $sql = "UPDATE pengadaan_barang SET status = 'disetujui', tgl_sah = '$tgl_sah' disakhan = '$username' WHERE id_pbarang = '$id_pbarang'";
// $s = mysqli_query($conn, $sql) or die (mysqli_error($conn));
$s = mysqli_query($conn, $sql) or die (mysqli_error($conn));
?>
<meta http-equiv="refresh" content="0;URL='../approvel.php'" />