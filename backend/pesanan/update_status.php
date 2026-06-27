<?php
session_start();

// Pastikan admin yang login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: ../../frontend/pages/login_admin.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../frontend/pages/pesanan_admin.php?error=Method tidak diizinkan');
    exit();
}

require_once '../config/db.php';

try {
    $order_id = isset($_POST['order_id']) ? intval($_POST['order_id']) : 0;
    $new_status = isset($_POST['status']) ? trim($_POST['status']) : '';

    // Validasi
    $allowed_statuses = ['Menunggu', 'Diproses', 'Dikirim', 'Selesai', 'Dibatalkan'];
    if ($order_id <= 0 || !in_array($new_status, $allowed_statuses)) {
        header('Location: ../../frontend/pages/pesanan_admin.php?error=Data tidak valid');
        exit();
    }

    // Update status
    $stmt = $conn->prepare("UPDATE orders SET status = :status WHERE id = :id");
    $stmt->execute([
        ':status' => $new_status,
        ':id'     => $order_id
    ]);

    if ($stmt->rowCount() > 0) {
        header('Location: ../../frontend/pages/pesanan_admin.php?success=Status pesanan #' . str_pad($order_id, 4, '0', STR_PAD_LEFT) . ' berhasil diubah menjadi ' . $new_status);
    } else {
        header('Location: ../../frontend/pages/pesanan_admin.php?error=Pesanan tidak ditemukan');
    }
} catch (PDOException $e) {
    header('Location: ../../frontend/pages/pesanan_admin.php?error=Gagal memperbarui status: ' . urlencode($e->getMessage()));
}
exit();
?>
