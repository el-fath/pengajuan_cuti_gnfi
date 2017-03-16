<?php 
    session_start();
	include '../koneksi.php';
	$id_pbarang = $_POST['id_pbarang'];
	$sql = "SELECT pengadaan_barang.id_pbarang,pengadaan_barang.note,pengadaan_barang.note2,pengadaan_barang.disahkan,pengadaan_barang.status, pegawai.nama_pegawai, pegawai.foto ,jabatan.jabatan, pengadaan_barang.tgl_pengajuan, pengadaan_barang.alasan ,pengadaan_barang.status,pengadaan_barang.nama_barang,pengadaan_barang.berkas, pengadaan_barang.tgl_sah
        FROM pegawai, pengadaan_barang, jabatan
        WHERE pegawai.id_pegawai = pengadaan_barang.id_pegawai
        AND pegawai.id_jabatan= jabatan.id_jabatan
        AND pengadaan_barang.id_pbarang = '$id_pbarang'";
	$s = mysqli_query($conn, $sql) or die (mysqli_error($conn));
	$temp=mysqli_fetch_array($s);
	$tgl_sah = $temp['tgl_sah'];

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

	$to = $temp['nama_pegawai'] . '<'.'rochman003@gmail.com'.'>';
	// var_dump($koor_data['email']);
	// die();
    // data
    $subject = "Pengajuan untuk diulas: pengajuan dari " . $_SESSION['username'];
    // https://www.goodnewsfromindonesia.id/email/articlereview.html
    $mailtemplate = file_get_contents("http://gnfi.hol.es/email/emailkeuangan.html");
    $content = str_replace('{{user_name}}', $temp['nama_pegawai'], $mailtemplate);
    $content = str_replace('{{divisi}}', $temp['jabatan'], $content);
    $content = str_replace('{{tgl_peng}}',date("d F Y", strtotime($temp['tgl_pengajuan'])), $content);
    $content = str_replace('{{nm_barang}}', $temp['nama_barang'], $content);
    $content = str_replace('{{berkas}}', $temp['berkas'], $content);
    $content = str_replace('{{alasan}}', $temp['alasan'], $content);
    $content = str_replace('{{status}}', $temp['status'], $content);
    $content = str_replace('{{tgl_sah}}', date("d F Y", strtotime($tgl_sah)), $content);
    $content = str_replace('{{disahkan}}', $temp['disahkan'], $content);
    $content = str_replace('{{download_file}}', '../berkas/'.$temp['berkas'], $content );
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

?>
<meta http-equiv="refresh" content="0;URL=../approvel.php" />