<?php  
	session_start();
	include '../koneksi.php';

	$id_pcuti = $_GET['id_pcuti'];

	$sql = mysqli_query($conn, "DELETE FROM permohonan_cuti WHERE id_pcuti = '$id_pcuti'") or die(mysqli_error($conn));

	$c = mysqli_num_rows($sql);

	if ($c > 0) {
		echo '<script>alert("hapus gagal")</script>';
	} else {
		echo '<script>alert("hapus berhasil")</script>';
	}

?>
<meta http-equiv="refresh" content="0;URL='../data_cuti.php'" />