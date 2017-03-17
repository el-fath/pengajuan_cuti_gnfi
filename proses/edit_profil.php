<?php 
	include '../koneksi.php';
	$id_pegawai 	= $_POST['id_pegawai'];
	$nama_pegawai 	= $_POST['nama_pegawai'];
	$username	 	= $_POST['username'];
	$jenis_kelamin 	= $_POST['jenis_kelamin'];
	$email 			= $_POST['email'];
	$tgl_lahir      = $_POST['tgl_lahir'];
	$alamat_pegawai = $_POST['alamat_pegawai'];
	$telpon_pegawai = $_POST['telpon_pegawai'];
	$file 			= $_FILES["foto"]["name"];
	$pic_loc 		= $_FILES['foto']['tmp_name'];
	$target_dir 	= "../admin/img/";
  	$target_file 	= $target_dir . basename($_FILES["foto"]["name"]);
  	$uploadOk 		= 1;
  	$imageFileType 	= pathinfo($target_file,PATHINFO_EXTENSION);

	// Periksa ukuran file================================================
	if($_FILES["foto"]["name"] != ""){
		if ($_FILES["foto"]["size"] > 1000000) {
		    echo "<script>alert('Maaf, File Anda terlalu besar...!')</script>";
		    $uploadOk = 0;
		}
	}

	// Format yang diperbolehkan
	if($_FILES["foto"]["name"] != ""){
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		  	&& $imageFileType != "gif" && $imageFileType != "JPG" ) {
			    echo "<script>alert('Maaf, hanya Format JPG, JPEG, PNG & GIF yang diperbolehkan.')</script>";
			    $uploadOk = 0;
		}
	}

	if($_FILES["foto"]["name"] != ""){
		if (move_uploaded_file($pic_loc,$target_dir.$file)) {
		    echo "<script>alert('Upload Foto Berhasil')</script>";
		}
	}
	
	if ($_FILES["foto"]["name"] == "" || $uploadOk == '0'){
	$a = "UPDATE pegawai SET nama_pegawai = '$nama_pegawai',username='$username', email = '$email',  tgl_lahir = '$tgl_lahir', jenis_kelamin = '$jenis_kelamin', alamat_pegawai = '$alamat_pegawai', telpon_pegawai = '$telpon_pegawai' WHERE id_pegawai = '$id_pegawai'";
	}else{
	$a = "UPDATE pegawai SET nama_pegawai = '$nama_pegawai',username='$username', email = '$email', tgl_lahir = '$tgl_lahir',jenis_kelamin = '$jenis_kelamin', alamat_pegawai = '$alamat_pegawai', telpon_pegawai = '$telpon_pegawai', foto = '$file' WHERE id_pegawai = '$id_pegawai'";
  	}
	$b = mysqli_query($conn,$a) or die (mysqli_error());
	if ($b == true && $uploadOk =='1'){
		echo "<script>alert('Proses edit $nama_pegawai berhasil')</script>";
	}else{
		echo "<script>alert('Mohon Maaf proses edit tidak berhasil')</script>";
	}
	
?>
<meta http-equiv="refresh" content="0;URL=../index.php" />