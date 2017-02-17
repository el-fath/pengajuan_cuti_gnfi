<?php 
session_start();
include 'koneksi.php';
$username = $_SESSION['username'];
$id_pcuti = $_POST['id_pcuti'];
$tgl_sah = date('Y/m/d');
$id_jcuti = $_POST['id_jcuti'];
	
if ($_POST['id_jcuti'] != '2' ) {
	$sql = "UPDATE permohonan_cuti SET status = 'disetujui', tgl_sah = '$tgl_sah', disahkan = '$username' WHERE id_pcuti = '$id_pcuti'";
}else{
	$sql = "UPDATE pegawai
		INNER JOIN permohonan_cuti ON permohonan_cuti.id_pegawai = pegawai.id_pegawai
		SET jatah_cuti = jatah_cuti - lama_cuti, STATUS = 'disetujui', tgl_sah = '$tgl_sah', disahkan = '$username'  WHERE id_pcuti = '$id_pcuti'";
}

$s = mysqli_query($conn, $sql) or die (mysqli_error($conn));
?>
<meta http-equiv="refresh" content="0;URL='data_cuti.php'" />