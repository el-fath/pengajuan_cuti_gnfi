<?php  
session_start();
include '../koneksi.php';
$id_pegawai = $_SESSION['id_pegawai'];
$tgl_pengajuan = date('Y/m/d');
// $lama_cuti = $_POST['lama_cuti'];
$tgl_mulai_cuti = $_POST['tgl_mulai_cuti'];
$tgl_akhir_cuti = $_POST['tgl_akhir_cuti'];
$alasan = $_POST['alasan'];
$status = 'Belum dikonfirmasi';
$id_jcuti = $_POST['id_jcuti'];
$grup = $_SESSION['grup'];
$nama_pegawai = $_SESSION['nama_pegawai'];
$selisih = (strtotime($tgl_akhir_cuti) - strtotime($tgl_mulai_cuti))/(60*60*24);
$id_pcuti=null;
$sql1 = mysqli_query($conn, "SELECT * FROM pegawai WHERE id_pegawai = '$id_pegawai'") or die(mysqli_error($conn));
$row = mysqli_fetch_assoc($sql1);


if ($selisih <= $row['jatah_cuti']) {
	$sql = "INSERT INTO permohonan_cuti VALUES(NULL,'$id_pegawai','$id_jcuti', '$tgl_pengajuan','$selisih', '$tgl_mulai_cuti','$tgl_akhir_cuti','$alasan','$status',NULL,NULL,NULL,NULL)";
	$s = mysqli_query($conn, $sql) or die (mysqli_error($conn));
	if ($s) {
		$last_insert = mysqli_insert_id($conn);
		$from = $row['email'];
		if($_SESSION['is_coordinator'] == 0){
			$query = mysqli_query($conn,"SELECT p.id_pegawai,p.email,p.nama_pegawai FROM pegawai_group pg JOIN pegawai p ON p.id_pegawai = pg.id_pegawai  WHERE is_coordinator = 1 AND grup='$grup' ") or die(mysqli_error($conn));
			$koor_data = mysqli_fetch_assoc($query);
			$id_coordinator = $koor_data['id_pegawai'];
			$a = "INSERT INTO pegawai_approval_list VALUES (NULL,'$id_coordinator','$last_insert','cuti', now(),0)";
		
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
		// mulai mengirim ke pegawai di atas koordinator
	$approvq = mysqli_query($conn,"SELECT * FROM pegawai_approval INNER JOIN Pegawai on pegawai.id_pegawai = pegawai_approval.id_pegawai") or die(mysqli_error($conn));
	$approv_data = mysqli_fetch_array($approvq);
			$r = "INSERT INTO pegawai_approval_list (id,approval_id,object_id,type,created,is_approval) 
							VALUES (NULL,'".$approv_data['id_pegawai']."','$last_insert','cuti',now(),0)";
		
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
	// var_dump($approv_data['email']);
	// die();
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
	echo "<script>alert('Pengajuan Cuti Terkirim...!, Mohon Tunngu Konfirmasi')</script>";
	}
} else {
	echo "<script>alert('Maaf, Jatah cuti anda kurang...')</script>";
}
?>
<meta http-equiv="refresh" content="0;URL='../index.php'" />
