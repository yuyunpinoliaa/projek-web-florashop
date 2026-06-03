<?php
session_start();
include "../../backend/config/koneksi.php";

$message = "";

if(isset($_POST['login'])){

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $query = mysqli_query($conn,
    "SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($query) > 0){

        $user = mysqli_fetch_assoc($query);

        if(password_verify($password, $user['password'])){

            $_SESSION['id_user'] = $user['id'];
            $_SESSION['nama'] = $user['nama'];

            header("Location: home.php");
            exit();

        }else{
            $message = "Password salah!";
        }

    }else{
        $message = "Email tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Florashop</title>

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

        .login-card{
            background:white;
            width:420px;
            padding:35px;
            border-radius:20px;
            box-shadow:0 4px 15px rgba(0,0,0,0.1);
        }

        .login-card h2{
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

        .register-link{
            text-align:center;
            margin-top:20px;
        }

        .register-link a{
            color:#4A6FA5;
            text-decoration:none;
            font-weight:bold;
        }

    </style>

</head>
<body>

<div class="login-card">

    <h2>💙 Login Florashop</h2>

    <?php if($message != ""){ ?>
        <div class="message">
            <?php echo $message; ?>
        </div>
    <?php } ?>

    <form method="POST">

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit" name="login">
            Login
        </button>

    </form>

    <div class="register-link">
        Belum punya akun?
        <a href="register.php">Daftar di sini</a>
    </div>

</div>

</body>
</html>