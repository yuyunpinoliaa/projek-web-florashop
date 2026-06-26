<?php
session_start();
require_once '../config/db.php';

// Cek admin login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: ../../frontend/pages/login_admin.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? 0;
    $name = $_POST['name'] ?? '';
    $price = $_POST['price'] ?? 0;
    $stock = $_POST['stock'] ?? 0;
    $status = $_POST['status'] ?? 'Aktif';
    $tag = $_POST['tag'] ?? '';
    $description = $_POST['description'] ?? '';
    $img = $_POST['img'] ?? '';

    if (empty($id) || empty($name) || empty($price)) {
        header('Location: ../../frontend/pages/manajemen_katalog.php?error=ID, Nama dan Harga wajib diisi');
        exit();
    }

    try {
        $stmt = $conn->prepare("UPDATE products SET name=?, price=?, stock=?, status=?, tag=?, description=?, img=? WHERE id=?");
        $stmt->execute([$name, $price, $stock, $status, $tag, $description, $img, $id]);
        header('Location: ../../frontend/pages/manajemen_katalog.php?success=Produk berhasil diperbarui');
    } catch(PDOException $e) {
        header('Location: ../../frontend/pages/manajemen_katalog.php?error=Gagal memperbarui produk: ' . $e->getMessage());
    }
}
?>
