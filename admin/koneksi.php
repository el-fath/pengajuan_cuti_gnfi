<?php 
	$host = "localhost";
	$user = "root";
	$pass = "";
	$db_name = "cuti_gnfi";
	ini_set('display_errors',1);
	error_reporting(E_ALL);
 	$conn=mysqli_connect($host, $user, $pass, $db_name);
	if (mysqli_connect_errno()) {
		# code...
		echo "gagal konek ke database :".mysqli_connect_errno();
	}else{
		// echo "koneksi berhasil";
	}
?>