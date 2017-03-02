<?php 
session_start();
include 'koneksi.php';
$username = $_SESSION['username'];
$id_pegawai = $_SESSION['id_pegawai'];
$id_pcuti = $_POST['id_pcuti'];
$tgl_sah = date('Y/m/d');
$id_jcuti = $_POST['id_jcuti'];
	
if ($_POST['id_jcuti'] != '2' ) {
	if ($_SESSION['is_coordinator'] == '1'){
		$sql = "UPDATE pegawai_approval_list SET is_approval = '1' WHERE approval_id = '$id_pegawai' AND object_id ='$id_pcuti'"; 
	}else{echo "<script>alert('salah jon')</script>";}
	// $sql = "UPDATE permohonan_cuti SET status = 'disetujui', tgl_sah = '$tgl_sah', disahkan = '$username' WHERE id_pcuti = '$id_pcuti'";
	// $b = mysqli_query($conn, "INSERT into pegawai_approval VALUES ('','$id_pegawai','$tgl_sah')") or die(mysqli_error($conn));
}else{
	$sql = "UPDATE pegawai
		INNER JOIN permohonan_cuti ON permohonan_cuti.id_pegawai = pegawai.id_pegawai
		SET jatah_cuti = jatah_cuti - lama_cuti, STATUS = 'disetujui', tgl_sah = '$tgl_sah', disahkan = '$username'  WHERE id_pcuti = '$id_pcuti'";
	// $c = mysqli_query($conn, "INSERT into pegawai_approval VALUES ('','$id_pegawai','$tgl_sah')") or die(mysqli_error($conn));
}

$s = mysqli_query($conn, $sql) or die (mysqli_error($conn));
?>
<meta http-equiv="refresh" content="0;URL='../approvel.php'" />