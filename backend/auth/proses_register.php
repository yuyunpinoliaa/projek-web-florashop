<?php
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
}
?>
