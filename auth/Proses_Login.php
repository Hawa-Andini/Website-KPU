<?php
session_start();
include '../config/koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$error_user = 0;
$error_pass = 0;

// CEK USERNAME
$q_user = mysqli_query($conn, "
    SELECT * FROM user 
    WHERE BINARY username='$username'
");

$data_user = mysqli_fetch_assoc($q_user);

// USERNAME SALAH
if(!$data_user){
    $error_user = 1;
}

// PASSWORD SALAH (hanya kalau user ada)
if($data_user && $password !== $data_user['password']){
    $error_pass = 1;
}

// ADA ERROR
if($error_user || $error_pass){
    header("location:Login.php?error_user=$error_user&error_pass=$error_pass");
    exit;
}

// LOGIN BERHASIL
$_SESSION['username'] = $data_user['username'];
$_SESSION['role']     = $data_user['role'];
$_SESSION['nip']      = $data_user['nip'];

if($data_user['role']=="admin"){
    header("location:../admin/Admin_Profil_Data_Pegawai.php");
}else{
    header("location:../pegawai/Identitas_User.php");
}
exit;
?>