<?php
session_start();
require_once '../config/db.php';

// Cek admin login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: ../../frontend/pages/login_admin.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $price = $_POST['price'] ?? 0;
    $stock = $_POST['stock'] ?? 0;
    $status = $_POST['status'] ?? 'Aktif';
    $tag = $_POST['tag'] ?? '';
    $description = $_POST['description'] ?? '';
    $img = $_POST['img'] ?? '';

    if (empty($name) || empty($price)) {
        header('Location: ../../frontend/pages/manajemen_katalog.php?error=Nama dan Harga wajib diisi');
        exit();
    }

    try {
        $stmt = $conn->prepare("INSERT INTO products (name, price, stock, status, tag, description, img) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $price, $stock, $status, $tag, $description, $img]);
        header('Location: ../../frontend/pages/manajemen_katalog.php?success=Produk berhasil ditambahkan');
    } catch(PDOException $e) {
        header('Location: ../../frontend/pages/manajemen_katalog.php?error=Gagal menambah produk: ' . $e->getMessage());
    }
}
?>
