<?php 
session_start();
include 'koneksi.php';
$id_pbarang = $_POST['id_pbarang'];
$tgl_sah = date('Y/m/d');
$grup = $_SESSION['grup'];
// $username = $_SESSION['username'];
$id_pegawai = $_SESSION['id_pegawai'];
$nama_pegawai = $_SESSION['nama_pegawai'];

if ($_SESSION['is_coordinator'] == 1 ) {
	$l =mysqli_query($conn,"UPDATE pegawai_approval_list SET is_approval = '1' WHERE approval_id = '$id_pegawai' AND type = 'barang' AND object_id ='$id_pbarang'") or die(mysqli_error($conn));
	// $sql = "UPDATE pengadaan_barang SET disahkan = '$id_pegawai'" 
} else {
	$approve = mysqli_query($conn,"SELECT id_pegawai FROM pegawai_approval") or die (mysqli_error($conn));
	$approve_user = mysqli_fetch_array($approve);
	$sql = "UPDATE pegawai_approval_list SET is_approval = '1' WHERE approval_id = '".$approve_user['id_pegawai']."'AND type = 'barang' AND object_id ='$id_pbarang'";
	$s = mysqli_query($conn, $sql) or die (mysqli_error($conn));
}

$a = mysqli_query($conn,"SELECT COUNT(*) AS sisa_approval FROM pegawai_approval_list WHERE object_id = '$id_pbarang' AND type = 'barang' AND is_approval = '0' ") or die (mysqli_error($conn));
$b = mysqli_fetch_assoc($a);

if ($b['sisa_approval'] == 1) {
	$c = mysqli_query($conn,"UPDATE pengadaan_barang SET status = 'disetujui 1 approvel', tgl_sah = '$tgl_sah', disahkan = '$username' WHERE id_pbarang = '$id_pbarang'") or die(mysqli_error($conn));
	
} elseif ($b['sisa_approval'] == 0 ) {
	$l = mysqli_query($conn,"UPDATE pengadaan_barang SET status = 'disetujui', tgl_sah = '$tgl_sah', disahkan = '$username' WHERE id_pbarang = '$id_pbarang'") or die(mysqli_error($conn));

	$query_approv = mysqli_query($conn, "SELECT * from pengadaan_barang INNER JOIN pegawai ON pegawai.id_pegawai = pengadaan_barang.id_pegawai WHERE pengadaan_barang.id_pbarang = '$id_pbarang'") or die(mysqli_error($conn));
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
	echo "<script>alert('Penyetujuan Berhasil disetujui')</script>";
	
}else{
	echo "<script>alert('Penyetujuan Berhasil Tapi Mohon Tunggu Approvel lain untuk menyetujui')</script>";
}


?>
<meta http-equiv="refresh" content="0;URL='../approvel.php'" />