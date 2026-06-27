<?php
// proses_register.php
require_once '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $role     = 'user'; // default role

    // Validasi input tidak boleh kosong
    if (empty($fullname) || empty($email) || empty($password)) {
        echo "<script>
            alert('Semua data wajib diisi!');
            window.location.href = '../../frontend/pages/register.php';
        </script>";
        exit;
    }

    // Cek apakah email sudah terdaftar
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        echo "<script>
            alert('Email sudah terdaftar!');
            window.location.href = '../../frontend/pages/register.php';
        </script>";
        exit;
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Simpan ke database (nama kolom di database adalah 'name')
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$fullname, $email, $hashed_password, $role])) {
        // Auto-login user after successful registration
        $_SESSION['user_id'] = $conn->lastInsertId();
        $_SESSION['user_name'] = $fullname;
        $_SESSION['user_role'] = $role;

        $_SESSION['flash_message'] = 'Akun berhasil dibuat!';
        header('Location: ../../frontend/pages/profile.php');
        exit();
    } else {
        echo "<script>
            alert('Terjadi kesalahan saat registrasi.');
            window.location.href = '../../frontend/pages/register.php';
          </script>";
    }
} else {
    // Jika diakses langsung tanpa POST, tendang balik ke register.php
    header("Location: ../../frontend/pages/register.php");
    exit();
}
?>