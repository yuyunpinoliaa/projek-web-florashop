<?php
include "../../backend/config/koneksi.php";

$message = "";

if(isset($_POST['register'])){

    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $cek = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($cek) > 0){
        $message = "Email sudah terdaftar!";
    }else{

        $query = mysqli_query($conn,
        "INSERT INTO users(nama,email,password)
        VALUES('$nama','$email','$password')");

        if($query){
            $message = "Registrasi berhasil!";
        }else{
            $message = "Registrasi gagal!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Florashop</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Poppins,sans-serif;
        }

        body{
            background:#EAF4FF;
            display:flex;
            justify-content:center;
            align-items:center;
            min-height:100vh;
        }

        .register-card{
            background:white;
            width:420px;
            padding:35px;
            border-radius:20px;
            box-shadow:0 4px 15px rgba(0,0,0,0.1);
        }

        .register-card h2{
            text-align:center;
            color:#4A6FA5;
            margin-bottom:25px;
        }

        label{
            display:block;
            margin-top:15px;
            margin-bottom:8px;
            color:#4A6FA5;
            font-weight:600;
        }

        input{
            width:100%;
            padding:12px;
            border:2px solid #CFE8FF;
            border-radius:10px;
            outline:none;
        }

        input:focus{
            border-color:#6FA8DC;
        }

        button{
            width:100%;
            margin-top:25px;
            padding:14px;
            border:none;
            border-radius:12px;
            background:#6FA8DC;
            color:white;
            font-size:16px;
            cursor:pointer;
        }

        button:hover{
            opacity:0.9;
        }

        .message{
            background:#EAF4FF;
            color:#4A6FA5;
            padding:10px;
            border-radius:10px;
            text-align:center;
            margin-bottom:15px;
        }

        .login-link{
            text-align:center;
            margin-top:20px;
        }

        .login-link a{
            color:#4A6FA5;
            text-decoration:none;
            font-weight:bold;
        }

    </style>

</head>
<body>

<div class="register-card">

    <h2>🌸 Daftar Akun Florashop</h2>

    <?php if($message != ""){ ?>
        <div class="message">
            <?php echo $message; ?>
        </div>
    <?php } ?>

    <form method="POST">

        <label>Nama Lengkap</label>
        <input type="text" name="nama" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit" name="register">
            Daftar Sekarang
        </button>

    </form>

    <div class="login-link">
        Sudah punya akun?
        <a href="login.php">Login di sini</a>
    </div>

</div>

</body>
</html>