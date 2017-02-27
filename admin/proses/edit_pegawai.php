<?php 
	include "../koneksi.php";
	$id_pegawai 	= $_POST['id_pegawai'];
	$nama_pegawai 	= $_POST['nama_pegawai'];
	$username		= $_POST['username'];
	$id_jabatan 	= $_POST['id_jabatan'];
	$jenis_kelamin 	= $_POST['jenis_kelamin'];
	$email 			= $_POST['email'];
	$alamat_pegawai = $_POST['alamat_pegawai'];
	$telpon_pegawai = $_POST['telpon_pegawai'];
	$status_pegawai	= $_POST['status_pegawai'];
	$group          = $_POST['group'];
	$is_coordinator = $_POST['is_coordinator'];
	$file 			= $_FILES["foto"]["name"];
	$pic_loc 		= $_FILES["foto"]["tmp_name"];
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

	if ($_FILES["foto"]["name"] == "" || $uploadOk == '0'){
	$a = "UPDATE pegawai SET id_pegawai = '$id_pegawai', nama_pegawai = '$nama_pegawai', username='$username', id_jabatan = '$id_jabatan', email = '$email', jenis_kelamin = '$jenis_kelamin', alamat_pegawai = '$alamat_pegawai', telpon_pegawai = '$telpon_pegawai', status_pegawai = '$status_pegawai' WHERE id_pegawai = '$id_pegawai'";
	}else{
	$a = "UPDATE pegawai SET id_pegawai = '$id_pegawai', nama_pegawai = '$nama_pegawai',username='$username', id_jabatan = '$id_jabatan', email = '$email', jenis_kelamin = '$jenis_kelamin', alamat_pegawai = '$alamat_pegawai', telpon_pegawai = '$telpon_pegawai', status_pegawai = '$status_pegawai',foto = '$file' WHERE id_pegawai = '$id_pegawai'";
  	}
	$b = mysqli_query($conn,$a) or die (mysqli_error());
	if ($b == true && $uploadOk =='1'){
		$z = mysqli_query($conn,"UPDATE pegawai_group SET grup='$group', is_coordinator='$is_coordinator' WHERE id_pegawai='$id_pegawai'") or die(mysqli_error($conn));
	echo "<script>alert('Proses edit $nama_pegawai berhasil')</script>";

	}else{
	echo "<script>alert('Mohon Maaf proses edit tidak berhasil')</script>";
	}
?>
<meta http-equiv="refresh" content="0;URL=../list_pegawai.php" />