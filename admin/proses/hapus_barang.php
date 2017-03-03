<?php  
	session_start();
	include '../koneksi.php';

	$id_pbarang = $_GET['id_pbarang'];

	$sql = mysqli_query($conn, "DELETE FROM pengadaan_barang WHERE id_pbarang = '$id_pbarang'") or die(mysqli_error($conn));

	$c = mysqli_num_rows($sql);

	if ($c > 0) {
		echo '<script>alert("hapus gagal")</script>';
	} else {
		echo '<script>alert("hapus berhasil")</script>';
	}

?>
<meta http-equiv="refresh" content="0;URL='../../approvel.php'" />