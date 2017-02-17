<?php 

session_start();
include '../koneksi.php';
 
if(!empty($_POST)){
     
    $username = $_POST['username'];
    $password = $_POST['password'];
 
    $sql = "select * from pegawai where username='".$username."' and password='".$password."'";
    #echo $sql."<br />";
    $query = mysqli_query($conn, $sql) or die (mysqli_error($conn));
    // pengecekan query valid atau tidak
    while ($a=mysqli_fetch_assoc($query)) {
        if($query){
            $row = mysqli_num_rows($query);
             
            // jika $row > 0 atau username dan password ditemukan
            if($row > 0){
                $_SESSION['isLoggedIn']=1;
                $_SESSION['username']=$username;
                $_SESSION['id_pegawai']=$a['id_pegawai'];
                header('Location: ../index.php');
            }else{
                echo "username atau password salah";
            }
        }
    }
}

?>