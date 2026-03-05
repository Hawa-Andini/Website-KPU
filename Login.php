<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: "Times New Roman", serif;
        }

        body {
            margin: 0;
            height: 100vh;
            background: radial-gradient(circle at center, #8b0000, #3b0000);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background: #ffffff;
            width: 360px;
            padding: 30px 35px 35px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            color: #7a0000;
        }

        .login-card h2 {
            text-align: center;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            font-size: 14px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1.5px solid #b07a7a;
            font-size: 14px;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background: #7a0000;
            border: none;
            border-radius: 6px;
            color: #ffffff;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-login:hover {
            background: #5e0000;
        }
    </style>
</head>
<body>

<div class="login-card">
    <h2>Log In</h2>

    <form action="proses_login.php" method="POST">
            <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" required>
        </div>

        <div class="form-group">
        <label>Password</label>

        <div style="position: relative;">
            <input type="password" name="password" id="password" required style="width:100%; padding-right:40px;">

            <span onclick="togglePassword()" 
            style="position:absolute; right:10px; top:10px; cursor:pointer;">
                👁
            </span>
        </div>
        </div>

        <div class="form-group">
        <label>Role</label>
        <select name="role" required>
        <option value="" disabled selected>Pilih Role</option>
        <option value="admin">Admin</option>
        <option value="user">Pegawai</option>
        </select>
        </div>

        <button type="submit" name="login" class="btn-login">Log In</button>

    </form>
</div>

<script>
function togglePassword() {
    var password = document.getElementById("password");

    if (password.type === "password") {
        password.type = "text";
    } else {
        password.type = "password";
    }
}
</script>
</body>
</html>