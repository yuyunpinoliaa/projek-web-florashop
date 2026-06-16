<?php
// backend/auth/proses_login_admin.php
session_start();

// Cek jika form dikirim menggunakan metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $remember = isset($_POST['remember']);

    // Validasi input sederhana
    if (empty($email) || empty($password)) {
        $_SESSION['login_error'] = 'Email dan password wajib diisi.';
        header('Location: ../../frontend/pages/login_admin.php');
        exit();
    }

    /* CONTOH IMPLEMENTASI DATABASE:
       $query = "SELECT * FROM admins WHERE email = ?";
       $stmt = $db->prepare($query);
       $stmt->bind_param('s', $email);
       $stmt->execute();
       $result = $stmt->get_result();
       $admin = $result->fetch_assoc();
    */

    // Hardcoded Kredensial Mocking untuk Demo Administrasi Florashop
    $mock_admin_email = 'admin@florashop.com';
    // Di database, password harus disimpan dalam bentuk hash (contoh: password_hash('admin123', PASSWORD_BCRYPT))
    $mock_admin_password_hash = password_hash('admin123', PASSWORD_BCRYPT); 

    if ($email === $mock_admin_email && password_verify($password, $mock_admin_password_hash)) {
        // Login berhasil, buat session admin
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_email'] = $email;

        // Jika 'Stay signed in' dicentang, buat cookie (berlaku 30 hari)
        if ($remember) {
            setcookie('admin_email', $email, time() + (86400 * 30), "/");
        }

        // Alihkan ke halaman dashboard admin utama
        header('Location: ../../frontend/pages/dashboard_admin.php');
        exit();
    } else {
        // Login gagal, set pesan kesalahan ke dalam session
        $_SESSION['login_error'] = 'Kredensial salah. Akses ditolak.';
        header('Location: ../../frontend/pages/login_admin.php');
        exit();
    }
} else {
    // Jika diakses langsung tanpa POST, kembalikan ke halaman login
    header('Location: ../../frontend/pages/login_admin.php');
    exit();
}
