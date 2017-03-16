<?php 
session_start();
include 'koneksi.php';
$id_pcuti = $_POST['id_pcuti'];
$tgl_sah = date('Y/m/d');
$sql = "UPDATE permohonan_cuti SET status = 'ditolak', tgl_sah = '$tgl_sah' WHERE id_pcuti = '$id_pcuti'";
	$query_approv = mysqli_query($conn, "SELECT * from permohonan_cuti INNER JOIN pegawai ON pegawai.id_pegawai = permohonan_cuti.id_pegawai WHERE permohonan_cuti.id_pcuti = '$id_pcuti' ") or die(mysqli_error($conn));
	$email_approv = mysqli_fetch_assoc($query_approv);
		
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
	$to = $email_approv['nama_pegawai'] . '<'.$email_approv['email'].'>';
    // data
    $subject = "Pengajuan sudah dikonfirmasi: oleh " . $_SESSION['username'];
    // https://www.goodnewsfromindonesia.id/email/articlereview.html
    $mailtemplate = file_get_contents("http://gnfi.hol.es/email/templateapprove.html");
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
$s = mysqli_query($conn, $sql) or die (mysqli_error($conn));
echo '<script>alert("pengajuan berhasil ditolak")</script>';
?>
<meta http-equiv="refresh" content="0;URL='../approvel.php'" />