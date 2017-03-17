<?php 
	include '../koneksi.php';
	$option 		= ['cost' => 10,];
	$id_pegawai 	= $_POST['id_pegawai'];
	$nama_pegawai 	= $_POST['nama_pegawai'];
	$tgl_lahir      = $_POST['tgl_lahir'];
	$tgl_bergabung  = $_POST['tgl_bergabung'];
	$id_jabatan 	= $_POST['id_jabatan'];
	$jenis_kelamin 	= $_POST['jenis_kelamin'];
	$email 			= $_POST['email'];
	$alamat_pegawai = $_POST['alamat_pegawai'];
	$telpon_pegawai = $_POST['telpon_pegawai'];
	$username 		= $_POST['username'];
	$password 		= $_POST['password'];
	// $status_pegawai = $_POST['status_pegawai'];	
	$hash 			= password_hash("$password", PASSWORD_DEFAULT, $option);
	$file 			= $_FILES["foto"]["name"];
	$pic_loc 		= $_FILES['foto']['tmp_name'];
	$target_dir 	= "../img/";
  	$target_file 	= $target_dir . basename($_FILES["foto"]["name"]);
  	$uploadOk 		= 1;
  	$imageFileType 	= pathinfo($target_file,PATHINFO_EXTENSION);
  	move_uploaded_file($pic_loc,$target_dir.$file);

	// Periksa ukuran file================================================
	if($_FILES["foto"]["name"] != ""){
		if ($_FILES["foto"]["size"] > 1000000) {
		    echo "<script>alert('Maaf, Size foto terlalu besar...! Upload foto gagal')</script>";
		    $uploadOk = 0;
		}
	}

	// Format yang diperbolehkan
	if($_FILES["foto"]["name"] != ""){
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		  	&& $imageFileType != "gif" && $imageFileType != "JPG" ) {
			    echo "<script>alert('Maaf, hanya Format JPG, JPEG, PNG & GIF yang diperbolehkan....<br>')</script>";
			    $uploadOk = 0;
		}
	}

	// if (!preg_match("/[a-zA-Z0-9]/", $username)) {
	// 	echo "<script>alert('karakter username hanya boleh a-z A-Z 0-9 tanpa spasi')</script>";
	// } else {
		
		$sql = "INSERT INTO pegawai VALUES('$id_pegawai','$nama_pegawai','$id_jabatan','$jenis_kelamin','$email','$tgl_lahir','$tgl_bergabung','$alamat_pegawai','$telpon_pegawai','$file','$username','$hash','14','pegawai')";
	 	$s = mysqli_query($conn, $sql) or die (mysqli_error($conn));
		if ($s == true && $uploadOk =='1') {
			$z = mysqli_query($conn,"INSERT INTO pegawai_group VALUES('','$id_pegawai','','')") or die(mysqli_error($conn));
			echo "<script>alert('DATA BERHASIL DI TAMBAH )</script>";
		}else {
			echo "<script>alert('DATA GAGAL MASUK )</script>";
		}
	//}

	
?>
<meta http-equiv="refresh" content="0;URL=../../login.php" />
