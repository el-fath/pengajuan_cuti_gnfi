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
		$sql = "UPDATE pegawai_approval_list SET is_approval = '1' WHERE approval_id = '$id_pegawai' AND object_id ='$id_pcuti' AND type = 'cuti'"; 
	}else{
		$approve = mysqli_query($conn,"SELECT id_pegawai FROM pegawai_approval") or die (mysqli_error($conn));
		$approve_user = mysqli_fetch_array($approve);
		$sql = "UPDATE pegawai_approval_list SET is_approval = '1' WHERE approval_id = '".$approve_user['id_pegawai']."' AND object_id ='$id_pcuti'";
	}

	$a = mysqli_query($conn,"SELECT COUNT(*) AS sisa_approval FROM pegawai_approval_list WHERE object_id = '$id_pcuti' AND type = 'cuti' AND is_approval = '0' ") or die (mysqli_error($conn));
	$b = mysqli_fetch_assoc($a);

	if ($b['sisa_approval'] == 1 ) {
		$l = mysqli_query($conn,"UPDATE permohonan_cuti SET status = 'disetujui', tgl_sah = '$tgl_sah', disahkan = '$username' WHERE id_pcuti = '$id_pcuti'") or die(mysqli_error($conn));
		
		echo "<script>alert('Penyetujuan Berhasil disetujui')</script>";

	}else{
		echo "<script>alert('Penyetujuan Berhasil Tapi Mohon Tunggu Approvel lain untuk menyetujui')</script>";
	}
	
}else{

	if ($_SESSION['is_coordinator'] == '1'){
		$sql = "UPDATE pegawai_approval_list SET is_approval = '1' WHERE approval_id = '$id_pegawai' AND object_id ='$id_pcuti' AND type = 'cuti'"; 
	}else{
		$approve = mysqli_query($conn,"SELECT id_pegawai FROM pegawai_approval") or die (mysqli_error($conn));
		$approve_user = mysqli_fetch_array($approve);
		$sql = "UPDATE pegawai_approval_list SET is_approval = '1' WHERE approval_id = '".$approve_user['id_pegawai']."' AND object_id ='$id_pcuti'";
	}

	$a = mysqli_query($conn,"SELECT COUNT(*) AS sisa_approval FROM pegawai_approval_list WHERE object_id = '$id_pcuti' AND type = 'cuti' AND is_approval = '0' ") or die (mysqli_error($conn));
	$b = mysqli_fetch_assoc($a);

	if ($b['sisa_approval'] == 1 ) {
		$l = mysqli_query($conn,"UPDATE pegawai
		INNER JOIN permohonan_cuti ON permohonan_cuti.id_pegawai = pegawai.id_pegawai
		SET jatah_cuti = jatah_cuti - lama_cuti, STATUS = 'disetujui', tgl_sah = '$tgl_sah', disahkan = '$username'  WHERE id_pcuti = '$id_pcuti'") or die(mysqli_error($conn));
		
		echo "<script>alert('Penyetujuan Berhasil disetujui')</script>";

	}else{
		echo "<script>alert('Penyetujuan Berhasil Tapi Mohon Tunggu Approvel lain untuk menyetujui')</script>";
	}

	// $c = mysqli_query($conn, "INSERT into pegawai_approval VALUES ('','$id_pegawai','$tgl_sah')") or die(mysqli_error($conn));
}


$s = mysqli_query($conn, $sql) or die (mysqli_error($conn));
?>
<meta http-equiv="refresh" content="0;URL='../approvel.php'" />