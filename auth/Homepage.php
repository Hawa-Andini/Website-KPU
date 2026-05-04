<?php
// index.php
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Homepage</title>
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

        .container {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            background: #ffffff;
            width: 360px;

            padding: 25px 20px;
            border-radius: 14px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.35);

            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;


            text-align: center;
            color: #7a0000;
        }

        .card h2 {
            margin-bottom: 10px;
            font-weight: bold;
            margin-top: 10px; 
            font-size: 28px;
        }

        .logo {
            width: 250px;
            margin-top: 40px;
            margin-bottom: 50px;
        }

        .btn {
            display: inline-block;
            width: 120px;
            padding: 12px;
            background: #7a0000;
            border-radius: 6px;
            color: #ffffff;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            cursor: pointer;
        }

        .btn:hover {
            background: #5e0000;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <h2>SELAMAT DATANG!</h2>

        <img src="LogoSiproga.png" alt="Logo KPU" class="logo">

        <a href="Login.php" class="btn">MASUK</a>
    </div>
</div>

</body>
</html>