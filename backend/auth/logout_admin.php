<?php
// backend/auth/logout_admin.php
session_start();

// Hapus semua data session
$_SESSION = array();

// Hancurkan session di server
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy();

// Hapus cookie 'remember me' jika ada
if (isset($_COOKIE['admin_email'])) {
    setcookie('admin_email', '', time() - 3600, "/");
}

// Redirect kembali ke halaman login
header('Location: ../../frontend/pages/login_admin.php');
exit();
