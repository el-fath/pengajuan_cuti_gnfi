<?php  
	include '../koneksi.php';
	$id_pcuti = $_POST['id_pcuti'];

	$tgl_mulai_cuti = $_POST['tgl_mulai_cuti'];
	$tgl_akhir_cuti = $_POST['tgl_akhir_cuti'];
	$selisih = ((abs(strtotime ($tgl_akhir_cuti) - strtotime ($tgl_mulai_cuti)))/(60*60*24));

	$sql = mysqli_query($conn,"UPDATE permohonan_cuti SET  lama_cuti='$selisih', tgl_mulai_cuti = '$tgl_mulai_cuti', tgl_akhir_cuti='$tgl_akhir_cuti' WHERE id_pcuti = '$id_pcuti'") or die(mysqli_error($conn));

	header("location:../data_cuti.php");
?>