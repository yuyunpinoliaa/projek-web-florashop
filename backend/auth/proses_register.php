<?php
<<<<<<< HEAD
session_start();
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullName = $conn->real_escape_string($_POST['fullName']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    
    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Check if email exists
    $check_email = $conn->query("SELECT id FROM users WHERE email = '$email'");
    if ($check_email && $check_email->num_rows > 0) {
        $_SESSION['error'] = "Email sudah terdaftar!";
        header("Location: ../../frontend/pages/register.php");
        exit();
    }
    
    $sql = "INSERT INTO users (full_name, email, password, role) VALUES ('$fullName', '$email', '$hashed_password', 'customer')";
    
    if ($conn->query($sql) === TRUE) {
        $_SESSION['success'] = "Registrasi berhasil! Silakan login.";
        header("Location: ../../frontend/pages/login.php");
        exit();
    } else {
        $_SESSION['error'] = "Terjadi kesalahan: " . $conn->error;
        header("Location: ../../frontend/pages/register.php");
        exit();
    }
} else {
    header("Location: ../../frontend/pages/register.php");
    exit();
=======
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
>>>>>>> 8885c56dd68b483b6724449d6273e7e3787a101e
}
?>
