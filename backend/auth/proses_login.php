<?php
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'] ?? $user['full_name'];
        $_SESSION['user_role'] = $user['role'];
        
        $_SESSION['flash_message'] = 'Login berhasil!';
        echo "<script>
            window.location.href = '../../frontend/pages/profile.php';
        </script>";
        exit();
    } else {
        echo "<script>
            alert('Email atau password salah!');
            window.location.href = '../../frontend/pages/login.php';
        </script>";
    }
}
?>
