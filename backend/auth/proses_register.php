<?php
// proses_register.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email    = $_POST['email'];
    $password = $_POST['password'];

    // TODO: Tambahkan validasi dan query INSERT ke database kamu di sini
    // Contoh fiktif:
    // $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    // $query = "INSERT INTO users (nama, email, password) VALUES ('$fullname', '$email', '$hashed_password')";
    
    // Jika proses berhasil, arahkan kembali ke login.php dengan pesan sukses
    echo "<script>
            alert('Akun berhasil dibuat! Silahkan login.');
            window.location.href = 'login.php';
          </script>";
} else {
    // Jika diakses langsung tanpa POST, tendang balik ke register.php
    header("Location: register.php");
    exit();
}
?>