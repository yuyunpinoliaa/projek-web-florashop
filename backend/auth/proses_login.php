<?php
<<<<<<< HEAD
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
=======
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_role'] = $user['role'];
        
        echo "<script>
            alert('Login berhasil!');
            window.location.href = '../../index.php'; // Adjust based on your home path
        </script>";
    } else {
        echo "<script>
            alert('Email atau password salah!');
            window.location.href = '../../frontend/pages/login.php';
        </script>";
    }
>>>>>>> 8885c56dd68b483b6724449d6273e7e3787a101e
}
?>
