<?php 
	$host = "localhost";
	$user = "root";
	$pass = "";
	$db_name = "coba_dbrohman";
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	$conn=mysqli_connect($host, $user, $pass, $db_name);
	if (mysqli_connect_errno()) {
		# code...
		echo "gagal konek ke database :".mysqli_connect_errno();
	}else{
		// echo "koneksi berhasil";
	}
?>