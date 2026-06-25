<?php
// register.php
// Kamu bisa sertakan file koneksi database di sini jika sudah ada
// include '../../config/koneksi.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Florashop - Create Account</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fcf6f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .register-container {
            background: #ffffff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .logo-icon {
            color: #d15b8f;
            font-size: 24px;
            margin-bottom: 10px;
        }
        h2 {
            color: #70264b;
            margin: 5px 0;
        }
        p.subtitle {
            color: #8c8c8c;
            font-size: 14px;
            margin-bottom: 30px;
        }
        .auth-tabs {
            display: flex;
            background: #f5ecef;
            border-radius: 30px;
            padding: 5px;
            margin-bottom: 25px;
        }
        .auth-tabs a {
            flex: 1;
            text-decoration: none;
            padding: 10px;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 500;
            color: #8c8c8c;
            transition: all 0.3s;
        }
        .auth-tabs a.active {
            background: #ffffff;
            color: #d15b8f;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        .input-group {
            margin-bottom: 20px;
            text-align: left;
        }
        .input-group label {
            display: block;
            font-size: 14px;
            color: #555;
            margin-bottom: 8px;
        }
        .input-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #e1d5da;
            border-radius: 8px;
            box-sizing: border-box;
            background-color: #f9f6f7;
            font-size: 14px;
        }
        .input-group input:focus {
            outline: none;
            border-color: #d15b8f;
            background-color: #fff;
        }
        .btn-register {
            background-color: #9c2c62;
            color: white;
            border: none;
            width: 100%;
            padding: 14px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
            transition: background 0.3s;
        }
        .btn-register:hover {
            background-color: #7a1f49;
        }
    </style>
</head>
<body>

<div class="register-container">
    <div class="logo-icon">🌸</div>
    <h2>Florashop</h2>
    <p class="subtitle">Curating moments of beauty</p>

    <div class="auth-tabs">
        <a href="login.php">Sign In</a>
        <a href="register.php" class="active">Create Account</a>
    </div>

    <form action="proses_register.php" method="POST">
        <div class="input-group">
            <label for="fullname">Full Name</label>
            <input type="text" id="fullname" name="fullname" placeholder="John Doe" required>
        </div>

        <div class="input-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="yourname@florashop.com" required>
        </div>

        <div class="input-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="••••••••" required>
        </div>

        <button type="submit" class="btn-register">Register</button>
    </form>
</div>

</body>
</html>