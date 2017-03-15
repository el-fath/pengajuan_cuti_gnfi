<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>LOGIN WEB INTERNAL GNFI</title>
	<link rel="shortcut icon" type="image/x-icon" href="1487735199.ico">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/animate.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/styles.css">
</head>
<body style="padding-top: 200px">
	<div class="container">
	<div class="row animated zoomIn">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading" style="text-align: center;">LOG IN WEB INTERNAL GNFI</div>
				<div class="panel-body">
				<?php  
					session_start();
					include 'admin/koneksi.php';
					if ($_SESSION['status_pegawai'] == 'admin') {
						header("location: admin/index.php");
					} 

					
					if (isset($_POST['login'])) {
						$username = $_POST['username'];
						$userpass = $_POST['password'];
					
						
						$query = mysqli_query($conn, "SELECT id_pegawai, username, nama_pegawai, password, email FROM pegawai WHERE username='$username'");
						
						if (mysqli_num_rows($query) > 0) {
							$data = mysqli_fetch_assoc($query);
							if (password_verify($userpass, $data['password'])) {
									// if ($data['status_pegawai'] == admin && $status_pegawai == admin) {
         //                                $_SESSION['username'] =  $username;
         //                                $_SESSION['id_pegawai'] = $data['id_pegawai'];
         //                                $_SESSION['foto'] = $data['foto'];
         //                                $_SESSION['status_pegawai'] = 'admin';
         //                                header('location:admin/index.php');
         //                            } elseif ($data['status_pegawai'] == pegawai && $status_pegawai == pegawai) {
         //                                $_SESSION['username'] =  $username;
         //                                $_SESSION['id_pegawai'] = $data['id_pegawai'];
         //                                $_SESSION['foto'] = $data['foto'];
         //                                $_SESSION['status_pegawai'] = 'pegawai';
         //                                header('location:index.php');
         //                            } else {
         //                                echo '<div class="alert alert-danger">Upss...!!! sorry username dan password tidak cocok</div>';
         //                            }
         							$sq = mysqli_query($conn,"SELECT * FROM pegawai_group WHERE id_pegawai = '".$data['id_pegawai']."'") or die(mysqli_error($conn));
         							$tmp = mysqli_fetch_assoc($sq);
         							if ($tmp['grup'] == 'ADMIN') {
         								$_SESSION['username'] = $username;   
         								$_SESSION['id_pegawai'] = $data['id_pegawai'];
         								$_SESSION['grup'] = $tmp['grup'];
         								// $_SESSION['is_coordinator'] = $tmp['is_coordinator'];
         								// $_SESSION['grup'] = $tmp['grup'];
         								header("location:admin/index.php");
         								// echo "to admin";
         							} else {
         								$_SESSION['username'] = $username;   
         								$_SESSION['nama_pegawai'] = $data['nama_pegawai']; 
         								$_SESSION['email']  = $data['email'];
         								$_SESSION['id_pegawai'] = $data['id_pegawai'];
         								$_SESSION['is_coordinator'] = $tmp['is_coordinator'];
         								$_SESSION['grup'] = $tmp['grup'];
         								header("location:index.php");      	              
         								// echo "to pegawai";
         							}
							} else {
								echo "username atau password tidak dikenali";
							}
						
						}	
					}
				?>
					<form role="form" action="" method="POST">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Username" name="username" type="text" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password" value="" required>
							</div>
							<!-- <div class="form-group">
								<select name="status_pegawai" class="form-control">
									<option value="admin">Admin</option>
									<option value="pegawai">Pegawai</option>
								</select>
							</div> -->
							<div class="form-group">
								<a href="admin/tambah_pegawai.php">Register Pegawai</a>
							</div>
							<div class="form-group">
						<input type="submit" name="login" class="btn btn-primary btn-block" value="Log me in" />
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	</div><!-- container -->
 <script src="admin/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="admin/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
	
</body>
</html>