<?php  
	include '../koneksi.php';
	$id_pbarang = $_POST['id_pbarang'];
	$tgl_pengajuan = date('Y/m/d');
	$eror		= false;
	$folder		= '../berkas/';
	//type file yang bisa diupload
	$file_type	= array('jpg','jpeg','png','gif','bmp','doc','docx','xls','xlsx','sql','pdf');
	//tukuran maximum file yang dapat diupload
	$max_size	= 4000000; // 4MB
	if(isset($_POST['btnUpload'])){
		//Mulai memorises data
		$file_name	= $_FILES['berkas']['name'];
		$file_size	= $_FILES['berkas']['size'];
		//cari extensi file dengan menggunakan fungsi explode
		$explode	= explode('.',$file_name);
		$extensi	= $explode[count($explode)-1];

		//check apakah type file sudah sesuai
		if(!in_array($extensi,$file_type)){
			$eror   = true;
			$pesan .= '- Type file yang anda upload tidak sesuai<br />';
		}
		if($file_size > $max_size){
			$eror   = true;
			$pesan .= '- Ukuran file melebihi batas maximum<br />';
		}
		//check ukuran file apakah sudah sesuai

		if($eror == true){
			echo '<div id="eror">'.$pesan.'</div>';
		}
		else{
			//mulai memproses upload file
			if(move_uploaded_file($_FILES['berkas']['tmp_name'], $folder.$file_name)){
				//catat nama file ke database
				$catat = mysqli_query($conn,"UPDATE pengadaan_barang SET tgl_pengajuan = '$tgl_pengajuan', berkas = '$file_name' WHERE id_pbarang = '$id_pbarang'") or die(mysqli_error($conn));
				header("location:../barang.php");
			}
		}
	}
?>