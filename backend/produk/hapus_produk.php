<?php
session_start();
require_once '../config/db.php';

// Cek admin login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: ../../frontend/pages/login_admin.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    try {
        $stmt = $conn->prepare("DELETE FROM products WHERE id=?");
        $stmt->execute([$id]);
        header('Location: ../../frontend/pages/manajemen_katalog.php?success=Produk berhasil dihapus');
    } catch(PDOException $e) {
        header('Location: ../../frontend/pages/manajemen_katalog.php?error=Gagal menghapus produk: ' . $e->getMessage());
    }
} else {
    header('Location: ../../frontend/pages/manajemen_katalog.php');
}
?>
