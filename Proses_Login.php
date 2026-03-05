<?php
session_start();
include "koneksi.php";

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $query = "SELECT * FROM user 
              WHERE username='$username' 
              AND password='$password'
              AND role='$role'";

    $result = mysqli_query($conn,$query);

    if(mysqli_num_rows($result) > 0){

        $data = mysqli_fetch_assoc($result);

        $_SESSION['username'] = $data['username'];
        $_SESSION['role'] = $data['role'];

        if($data['role'] == "admin"){
            header("Location: admin/dashboard.php");
        }else{
            header("Location: Edit_Identitas_User.php");
        }

    }else{
        echo "Login gagal";
    }

}
?>