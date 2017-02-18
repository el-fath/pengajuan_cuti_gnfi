<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/animate.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/styles.css">
</head>
<body>
	<?php 
		include 'koneksi.php';
		$id_pegawai = $_GET['id_pegawai'];
		$sql="SELECT * FROM pegawai WHERE id_pegawai='$id_pegawai'";
        $query=mysqli_query($conn,$sql) or die (mysqli_error($conn));
        $temp=mysqli_fetch_array($query);
	?>
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">GANTI PASSWORD</div>
				<div class="panel-body">
					<form role="form" action="proses/changepassword.php" method="POST">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="EMAIL ANDA" name="email" type="email" value="<?php echo $temp['email']; ?>">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="PASSWORD LAMA" name="passwordlama" type="hidden" value="<?php echo $temp['password'] ?>">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Masukkan Password Baru" name="passwordbaru" type="password" value="">
							</div>
							
						<input type="submit"  class="btn btn-primary btn-block" value="UBAH PASSWORD" />
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	

 <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
	
</body>
</html>