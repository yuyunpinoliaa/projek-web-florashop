<?php
session_start();
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);
    
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['full_name'];
            $_SESSION['user_role'] = $row['role'];
            
            if ($row['role'] == 'admin') {
                header("Location: ../../frontend/pages/admin_dashboard.php");
            } else {
                header("Location: ../../frontend/pages/home.php");
            }
            exit();
        } else {
            $_SESSION['error'] = "Password salah!";
            header("Location: ../../frontend/pages/login.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Email tidak ditemukan!";
        header("Location: ../../frontend/pages/login.php");
        exit();
    }
} else {
    header("Location: ../../frontend/pages/login.php");
    exit();
}
?>
