<?php

	include '../koneksi.php';
	$id_pegawai = $_GET['id_pegawai'];
	$option = ['cost' => 10,];
	$passwordlama = $_POST['passwordlama'];
	$passwordbaru = $_POST['passwordbaru'];
	$hash = password_hash("$passwordbaru", PASSWORD_DEFAULT, $option);
	$email = $_POST['email'];
	$cekuser = "select * from pegawai where email ='$email' and password ='$passwordlama'";
	$querycekuser = mysqli_query($conn,$cekuser);
	$count = mysqli_num_rows($querycekuser);
	if ($count > 0){
		$updatepassword = "update pegawai set password = '$hash' where email = '$email'";
		$updatequery = mysqli_query($conn,$updatepassword) or die(mysqli_error($conn));

		if($updatequery)
		{
			echo "<script>alert('PASSWORD ANDA BERHASIL DI UBAH')</script>";
			
		} else {
			echo "<script>alert('GAGAL UBAH PASSWORD')</script>";
		}
	}
	
?>
<meta http-equiv="refresh" content="0;URL='../index.php'" />