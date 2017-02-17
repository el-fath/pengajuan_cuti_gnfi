<?php 

session_start();
include '../koneksi.php';
 
if(!empty($_POST)){
     
    $username_admin = $_POST['username_admin'];
    $password_admin = $_POST['password_admin'];
 
    $sql = "select * from tb_admin where username_admin='".$username_admin."' and password_admin='".$password_admin."'";
    #echo $sql."<br />";
    $query = mysqli_query($conn, $sql) or die (mysqli_error());
    // pengecekan query valid atau tidak
    if($query){
        $row = mysqli_num_rows($query);
         
        // jika $row > 0 atau username dan password ditemukan
        if($row > 0){
            $_SESSION['isLoggedIn']=1;
            $_SESSION['username_admin']=$username_admin;
            header('Location: ../index.php');
        }else{
            echo "username atau password salah";
        }
    }

}

?>