<?php 
include "../koneksi.php";
$id_pegawai = $_POST['id_pegawai'];
$password = $_POST['password'];
$option = ['cost' => 10,];
$hash = password_hash("$password", PASSWORD_DEFAULT, $option);

$a = "UPDATE pegawai SET password = '$hash' WHERE id_pegawai = '$id_pegawai'";
$b = mysqli_query($conn, $a) or die(mysqli_error($conn));
if ($b) {
	echo "<script>alert('Password berhasil diubah')</script>";
}

?>
<meta http-equiv="refresh" content="0;URL=../edit_pegawai.php" />