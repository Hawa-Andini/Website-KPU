<?php
session_start();
include "koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($conn,"SELECT * FROM user 
WHERE username='$username' AND password='$password'");

$data = mysqli_fetch_assoc($query);

if($data){

    $_SESSION['username'] = $data['username'];
    $_SESSION['nip'] = $data['nip'];  
    $_SESSION['role'] = $data['role'];

    if($data['role'] == "Admin"){
        header("location:dashboard_admin.php");
    }else{
        header("location:Identitas_User.php");
    }

}else{
    echo "Login gagal";
}
?>