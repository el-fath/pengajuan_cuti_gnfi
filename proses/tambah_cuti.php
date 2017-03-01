<?php  
session_start();
include '../koneksi.php';
$id_pegawai = $_SESSION['id_pegawai'];
$id_jcuti = $_POST['id_jcuti'];
$tgl_pengajuan = date('Y/m/d');
// $lama_cuti = $_POST['lama_cuti'];
$tgl_mulai_cuti = $_POST['tgl_mulai_cuti'];
$tgl_akhir_cuti = $_POST['tgl_akhir_cuti'];
$alasan = $_POST['alasan'];
$status = 'Belum dikonfirmasi';
$grup = $_SESSION['grup']
$selisih = (strtotime($tgl_akhir_cuti) - strtotime($tgl_mulai_cuti))/(60*60*24);

$sql1 = mysqli_query($conn, "SELECT * FROM pegawai WHERE id_pegawai = '$id_pegawai'") or die(mysqli_error($conn));
$row = mysqli_fetch_assoc($sql1);

if ($selisih <= $row['jatah_cuti']) {
	$sql = "INSERT INTO permohonan_cuti VALUES('','$id_pegawai','$id_jcuti', '$tgl_pengajuan','$selisih', '$tgl_mulai_cuti','$tgl_akhir_cuti','$alasan','$status','','')";
	$s = mysqli_query($conn, $sql) or die (mysqli_error($conn));
	if ($s) {
		$last_insert = mysqli_insert_id($conn);
		if($_SESSION['is_coordinator'] == 0){
			$query = mysqli_query($conn,"SELECT * FROM pegawai_group WHERE is_coordinator = 1 && grup='grup' ") or die(mysqli_error($conn));
			$userdata = mysqli_fetch_assoc($query);
			$id_coordinator = $userdata['id_pegawai'];

			$insert = mysqli_query($conn,"INSERT INTO pegawai_approval_list VALUES ('','$id_coordinator','$last_insert','cuti', now(),0)") or die (mysqli_error($conn));
		}
	echo "<script>alert('Pengajuan Cuti Terkirim...!, Mohon Tunngu Konfirmasi')</script>";
	}
} else {
	echo "<script>alert('Maaf, Jatah cuti anda kurang...')</script>";
}
?>
<meta http-equiv="refresh" content="0;URL='../index.php'" />

