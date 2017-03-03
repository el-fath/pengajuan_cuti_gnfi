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
	// $sql = "UPDATE pengadaan_barang SET disahkan = '$id_pegawai'" 
} else {
	$approve = mysqli_query($conn,"SELECT id_pegawai FROM pegawai_approval") or die (mysqli_error($conn));
	$approve_user = mysqli_fetch_array($approve);
	$sql = "UPDATE pegawai_approval_list SET is_approval = '1' WHERE approval_id = '".$approve_user['id_pegawai']."'AND object_id ='$id_pbarang'";
}

$a = mysqli_query($conn,"SELECT COUNT(*) AS sisa_approval FROM pegawai_approval_list WHERE object_id = '$id_pbarang' AND type = 'barang' AND is_approval = '1' ") or die (mysqli_error($conn));
$b = mysqli_fetch_assoc($a);

if ($b['sisa_approval'] == 0 ) {
	$l = mysqli_query($conn,"UPDATE pengadaan_barang SET status = 'disetujui', tgl_sah = '$tgl_sah', disahkan = '$username' WHERE id_pbarang = '$id_pbarang'") or die(mysqli_error($conn));
	
	echo "<script>alert('Penyetujuan Berhasil disetujui')</script>";

}else{
	echo "<script>alert('Penyetujuan Berhasil Tapi Mohon Tunggu Approvel lain untuk menyetujui')</script>";
}

$s = mysqli_query($conn, $sql) or die (mysqli_error($conn));
?>
<meta http-equiv="refresh" content="0;URL='../approvel.php'" />