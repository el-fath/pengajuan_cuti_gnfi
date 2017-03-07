<?php  
	session_start();
	include '../koneksi.php';

	$id_pbarang = $_POST['id_pbarang'];
	$id_pegawai = $_SESSION['id_pegawai'];
	$id_kategori = $_POST['id_kategori'];
	$nama_barang = $_POST['nama_barang'];
	$tgl_pengajuan = date('Y/m/d');
	$alasan = $_POST['alasan'];
	$grup = $_SESSION['grup'];
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
			$catat = mysqli_query($conn,'insert into pengadaan_barang values ("'.$id_pbarang.'", "'.$id_pegawai.'", "'.$id_kategori.'" ,"'.$nama_barang.'", "'.$tgl_pengajuan.'", "'.$file_name.'" ,"'.$alasan.'","Belum dikonfirmasi","")') or die(mysqli_error($conn));
			$last_insert = mysqli_insert_id($conn);
			if($_SESSION['is_coordinator'] == 0){
				$query = mysqli_query($conn,"SELECT * FROM pegawai_group WHERE is_coordinator = 1 AND grup='$grup' ") or die(mysqli_error($conn));
				$userdata = mysqli_fetch_assoc($query);
				$id_coordinator = $userdata['id_pegawai'];
				$a = "INSERT INTO pegawai_approval_list VALUES ('','$id_coordinator','$last_insert','barang', now(),0)";
			
				$insert = mysqli_query($conn,$a) or die (mysqli_error($conn));

			} 
			$approvq = mysqli_query($conn,"SELECT id_pegawai FROM pegawai_approval") or die(mysqli_error($conn));
			$approv_data = mysqli_fetch_array($approvq);
				
					$r = "INSERT INTO pegawai_approval_list (id,approval_id,object_id,type,created,is_approval) 
									VALUES ('','".$approv_data['id_pegawai']."','$last_insert','barang',now(),0)";
				
					$insq = mysqli_query($conn,$r) or die(mysqli_error($conn));
			
			echo "<script> alert('Pengajuan anda Terkirim...!, Mohon Tunngu Konfirmasi')</script>";
		} else{
			echo '<script>alert("pengajuan anda gagal dikirim")</script>';
	}
}
}
?>
<meta http-equiv="refresh" content="0;URL='../index.php'" />