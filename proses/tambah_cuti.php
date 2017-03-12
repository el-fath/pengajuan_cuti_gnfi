<?php  
session_start();
include '../koneksi.php';
$id_pegawai = $_SESSION['id_pegawai'];
$id_jcuti = $_POST['id_jcuti'];
$tgl_pengajuan = date('Y/m/d');
// $lama_cuti = $_POST['lama_cuti'];
$tgl_mulai_cuti = $_POST['tgl_mulai_cuti'];
$tgl_akhir_cuti = $_POST['tgl_akhir_cuti'];
$alasan = $_POST['alasan'];
$status = 'Belum dikonfirmasi';
$grup = $_SESSION['grup'];
$selisih = (strtotime($tgl_akhir_cuti) - strtotime($tgl_mulai_cuti))/(60*60*24);

$sql1 = mysqli_query($conn, "SELECT * FROM pegawai WHERE id_pegawai = '$id_pegawai'") or die(mysqli_error($conn));
$row = mysqli_fetch_assoc($sql1);

if ($selisih <= $row['jatah_cuti']) {
	$sql = "INSERT INTO permohonan_cuti VALUES('','$id_pegawai','$id_jcuti', '$tgl_pengajuan','$selisih', '$tgl_mulai_cuti','$tgl_akhir_cuti','$alasan','$status','','','','')";
	$s = mysqli_query($conn, $sql) or die (mysqli_error($conn));
	if ($s) {
		$last_insert = mysqli_insert_id($conn);
		if($_SESSION['is_coordinator'] == 0){
			$query = mysqli_query($conn,"SELECT * FROM pegawai_group WHERE is_coordinator = 1 AND grup='$grup' ") or die(mysqli_error($conn));
			$userdata = mysqli_fetch_assoc($query);
			$id_coordinator = $userdata['id_pegawai'];
			$a = "INSERT INTO pegawai_approval_list VALUES ('','$id_coordinator','$last_insert','cuti', now(),0)";
		
			$insert = mysqli_query($conn,$a) or die (mysqli_error($conn));

		} 
		// mulai mengirim ke pegawai di atas koordinator
	$approvq = mysqli_query($conn,"SELECT id_pegawai FROM pegawai_approval") or die(mysqli_error($conn));
	$approv_data = mysqli_fetch_array($approvq);
			$r = "INSERT INTO pegawai_approval_list (id,approval_id,object_id,type,created,is_approval) 
							VALUES ('','".$approv_data['id_pegawai']."','$last_insert','cuti',now(),0)";
		
			$insq = mysqli_query($conn,$r) or die(mysqli_error($conn));
		
	echo "<script>alert('Pengajuan Cuti Terkirim...!, Mohon Tunngu Konfirmasi')</script>";
	}
} else {
	echo "<script>alert('Maaf, Jatah cuti anda kurang...')</script>";
}
?>
<meta http-equiv="refresh" content="0;URL='../index.php'" />
<!-- 
// mengambil id data terakhir yang dimasukkan
$last_insert = mysqli_insert_id(($link);

// melakukan pengecekan apakah pegawai yang login koordinator atau bukan
if($_SESSION['is_coordinator'] == 0) {
	// jika bukan koordinator
	// dapetin session group
	$group = $_SESSION['group'];
	// query
	$koorq = mysql_query("SELECT p.id_pegawai,p.email,p.nama_pegawai FROM pegawai_group pg JOIN pegawai p ON p.id_pegawai = pg.id_pegawai WHERE pg.is_coordinator = 1 AND pg.group = '$group')
	$koor_data = mysql_fetch_assoc($koorq);
	// dapet satu id_pegawai yang merupakan koordinator divisi/grup tsb
	$id_koordinator = $koor_data['id_pegawai'];
	// dimasukkan ke tabel pegawai_approval_list
	$insq = mysql_query("INSERT INTO pegawai_approval_list (approval_id,object_id,type,created,is_approve) 
						VALUES ('$id_koordinator','$last_insert','barang/cuti',now(),0)"); 
	

	// kirim email notifikasi
	$to = $koor_data['nama_pegawai'] . '<'.$koor_data['email'].'>';
    // data
    $subject = "Pengajuan untuk diulas: pengajuan dari " . $_SESSION['username'];
    // https://www.goodnewsfromindonesia.id/email/articlereview.html
    $mailtemplate = file_get_contents("https://www.goodnewsfromindonesia.id/email/articlereview.html");
    $content = str_replace('{{user_name}}', $data['nama_pegawai'], $mailtemplate);
    $content = str_replace('{{user_link}}', $data['user_link'], $content);
    $content = str_replace('{{title}}', $data['title'], $content);
    $content = str_replace('{{link}}', $data['link'], $content);
    $fin = str_replace('{{date}}', date("d-m-Y H:i:s"), $content);

    $msg = "";
    $msg .= "--".$mime_boundary.$eol;
    $msg .= "Content-Type: text/html; charset=iso-8859-1".$eol;
    $msg .= "Content-Transfer-Encoding: 8bit".$eol;

    // content
    $message = $msg.$fin.$eol.$eol;
    $message .= "--".$mime_boundary."--".$eol.$eol;

	ini_set(sendmail_from,$from);  // the INI lines are to force the From Address to be used !
	mail($to, $subject, $message, $headers, "-f" . $from);
	ini_restore(sendmail_from); // restore setting
}

// mulai mengirim ke pegawai di atas koordinator
$approvq = mysql_query("SELECT id_pegawai FROM pegawai_approval");
$approv_data = mysql_fetch_array($approvq);

foreach($approv_data as $user) {
	$insq = mysql_query("INSERT INTO pegawai_approval_list (approval_id,object_id,type,created,is_approve) 
						VALUES ('".$user['id_pegawai']."','$last_insert','barang/cuti',now(),0)");
	mail("email","subject","content"); 


	// kirim email notifikasi
	$to = $koor_data['nama_pegawai'] . '<'.$koor_data['email'].'>';
    // data
    $subject = "Pengajuan untuk diulas: pengajuan dari " . $_SESSION['username'];
    // https://www.goodnewsfromindonesia.id/email/articlereview.html
    $mailtemplate = file_get_contents("https://www.goodnewsfromindonesia.id/email/articlereview.html");
    $content = str_replace('{{user_name}}', $data['nama_pegawai'], $mailtemplate);
    $content = str_replace('{{user_link}}', $data['user_link'], $content);
    $content = str_replace('{{title}}', $data['title'], $content);
    $content = str_replace('{{link}}', $data['link'], $content);
    $fin = str_replace('{{date}}', date("d-m-Y H:i:s"), $content);

    $msg = "";
    $msg .= "--".$mime_boundary.$eol;
    $msg .= "Content-Type: text/html; charset=iso-8859-1".$eol;
    $msg .= "Content-Transfer-Encoding: 8bit".$eol;

    // content
    $message = $msg.$fin.$eol.$eol;
    $message .= "--".$mime_boundary."--".$eol.$eol;

	ini_set(sendmail_from,$from);  // the INI lines are to force the From Address to be used !
	mail($to, $subject, $message, $headers, "-f" . $from);
	ini_restore(sendmail_from); // restore setting
} -->