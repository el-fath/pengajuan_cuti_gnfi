<?php  
	session_start();
	include '../koneksi.php';

	$id_pegawai = $_SESSION['id_pegawai'];
	$id_kategori = $_POST['id_kategori'];
	$nama_barang = $_POST['nama_barang'];
	$tgl_pengajuan = date('Y/m/d');
	$alasan = $_POST['alasan'];
	$nama_pegawai = $_SESSION['nama_pegawai'];
	$id_pbarang = null;
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
			$catat = mysqli_query($conn,'insert into pengadaan_barang values (NULL, "'.$id_pegawai.'", "'.$id_kategori.'" ,"'.$nama_barang.'", "'.$tgl_pengajuan.'", "'.$file_name.'" ,"'.$alasan.'","Belum dikonfirmasi",NULL,NULL,NULL,NULL)') or die(mysqli_error($conn));
			$last_insert = mysqli_insert_id($conn);
			if($_SESSION['is_coordinator'] == 0){
				$query = mysqli_query($conn,"SELECT p.id_pegawai,p.email,p.nama_pegawai FROM pegawai_group pg JOIN pegawai p ON p.id_pegawai = pg.id_pegawai   WHERE is_coordinator = 1 AND grup='$grup' ") or die(mysqli_error($conn));
				$koor_data = mysqli_fetch_assoc($query);
				$id_coordinator = $koor_data['id_pegawai'];
				$a = "INSERT INTO pegawai_approval_list VALUES (NULL,'$id_coordinator','$last_insert','barang', now(),0)";
			
				$insert = mysqli_query($conn,$a) or die (mysqli_error($conn));
				mail("email","subject","content");
				$from = "no-reply@goodnews.id"; 
				$reply_to = "dev@goodnews.id";
				$mime_boundary=md5(time());
				$eol = "\r\n";
				 
				$headers = "From: Good News from Indonesia <" . $from . ">" . $eol;
				$headers .= "Reply-To: ". $reply_to . $eol;
				$headers .= "X-Mailer: GNFIsystem v".phpversion() . $eol;
				$headers .= "MIME-Version: 1.0" . $eol;
				$headers .= "Content-Type: multipart/related; boundary=\"".$mime_boundary."\"".$eol;
	 
				$to = $koor_data['nama_pegawai'] . '<'.$koor_data['email'].'>';
				// var_dump($koor_data['email']);
				// die();
			    // data
			    $subject = "Pengajuan untuk diulas: pengajuan dari " . $_SESSION['username'];
			    // https://www.goodnewsfromindonesia.id/email/articlereview.html
			    $mailtemplate = file_get_contents("http://gnfi.hol.es/email/emailtemplate.html");
			    $content = str_replace('{{user_name}}',$nama_pegawai, $mailtemplate);
			    // $content = str_replace('{{user_link}}', $data['user_link'], $content);
			    
			    $fin = str_replace('{{date}}', date("d-m-Y H:i:s"), $content);
			    // $from = $row['email'];
			    $msg = "";
			    $msg .= "--".$mime_boundary.$eol;
			    $msg .= "Content-Type: text/html; charset=iso-8859-1".$eol;
			    $msg .= "Content-Transfer-Encoding: 8bit".$eol;

			    // content
			    $message = $msg.$fin.$eol.$eol;
			    $message .= "--".$mime_boundary."--".$eol.$eol;

				ini_set(sendmail_from,$from);  // the INI lines are to force the From Address to be used !
				@mail($to, $subject, $message, $headers, "-f" . $from);
				ini_restore(sendmail_from); // restore setting
			} 
			$approvq = mysqli_query($conn,"SELECT * FROM pegawai_approval INNER JOIN Pegawai on pegawai.id_pegawai = pegawai_approval.id_pegawai") or die(mysqli_error($conn));
			$approv_data = mysqli_fetch_array($approvq);
				
					$r = "INSERT INTO pegawai_approval_list (id,approval_id,object_id,type,created,is_approval) 
									VALUES (NULL,'".$approv_data['id_pegawai']."','$last_insert','barang',now(),0)";
				
					$insq = mysqli_query($conn,$r) or die(mysqli_error($conn));
			mail("email","subject","content"); 
			$from = "no-reply@goodnews.id"; 
			$reply_to = "dev@goodnews.id";
			$mime_boundary=md5(time());
			$eol = "\r\n";
			 
			$headers = "From: Good News from Indonesia <" . $from . ">" . $eol;
			$headers .= "Reply-To: ". $reply_to . $eol;
			$headers .= "X-Mailer: GNFIsystem v".phpversion() . $eol;
			$headers .= "MIME-Version: 1.0" . $eol;
			$headers .= "Content-Type: multipart/related; boundary=\"".$mime_boundary."\"".$eol;
			// kirim email notifikasi
			$to = $approv_data['nama_pegawai'] . '<'.$approv_data['email'].'>';
		    // data
		    $subject = "Pengajuan untuk diulas: pengajuan dari " . $_SESSION['username'];
		    // https://www.goodnewsfromindonesia.id/email/articlereview.html
		    $mailtemplate = file_get_contents("http://gnfi.hol.es/email/emailtemplate.html");
		    $content = str_replace('{{user_name}}', $nama_pegawai, $mailtemplate);
		    // $content = str_replace('{{user_link}}', $data['user_link'], $content);
		    // $content = str_replace('{{title}}', $data['title'], $content);
		    // $content = str_replace('{{link}}', $data['link'], $content);
		    $fin = str_replace('{{date}}', date("d-m-Y H:i:s"), $content);

		    $msg = "";
		    $msg .= "--".$mime_boundary.$eol;
		    $msg .= "Content-Type: text/html; charset=iso-8859-1".$eol;
		    $msg .= "Content-Transfer-Encoding: 8bit".$eol;

		    // content
		    $message = $msg.$fin.$eol.$eol;
		    $message .= "--".$mime_boundary."--".$eol.$eol;

			ini_set(sendmail_from,$from);  // the INI lines are to force the From Address to be used !
			@mail($to, $subject, $message, $headers, "-f" . $from);
			ini_restore(sendmail_from); // restore setting	
			echo "<script> alert('Pengajuan anda Terkirim...!, Mohon Tunngu Konfirmasi')</script>";

		} else{
			echo '<script>alert("pengajuan anda gagal dikirim")</script>';
	}
}
}
?>
<!-- <meta http-equiv="refresh" content="0;URL='../index.php'" /> -->

