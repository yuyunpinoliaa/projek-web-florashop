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
<html>
<head>
    <title>Register</title>
</head>
<body>

<h2>Register</h2>

<p><?php echo $message; ?></p>

<form method="POST">

    <label>Nama</label><br>
    <input type="text" name="nama" required><br><br>

    <label>Email</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit" name="register">
        Daftar
    </button>

</form>

<p>
    Sudah punya akun?
    <a href="login.php">Login</a>
</p>

</body>
</html>