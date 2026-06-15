<?php
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['fullName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = 'user'; // default role

    // Check if email exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        echo "<script>
            alert('Email sudah terdaftar!');
            window.location.href = '../../frontend/pages/register.php';
        </script>";
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$name, $email, $hashed_password, $role])) {
        echo "<script>
            alert('Registrasi berhasil! Silahkan login.');
            window.location.href = '../../frontend/pages/login.php';
        </script>";
    } else {
        echo "<script>
            alert('Terjadi kesalahan saat registrasi.');
            window.location.href = '../../frontend/pages/register.php';
        </script>";
    }
}
?>
