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
        // Ambil data user_id untuk notifikasi
        try {
            $user_stmt = $conn->prepare("SELECT user_id FROM orders WHERE id = :id");
            $user_stmt->execute([':id' => $order_id]);
            $order_user = $user_stmt->fetch(PDO::FETCH_ASSOC);

            if ($order_user && !empty($order_user['user_id'])) {
                $user_id = intval($order_user['user_id']);
                $order_display = sprintf('FLR-%05d', $order_id);
                $title = "Status Pesanan Diperbarui";
                $message = "";

                switch ($new_status) {
                    case 'Diproses':
                        $message = "Pesanan {$order_display} Anda sedang diproses. Bunga pilihan Anda sedang disiapkan.";
                        break;
                    case 'Dikirim':
                        $message = "Pesanan {$order_display} Anda sedang dikirim oleh kurir kami. Semoga bunga Anda tiba dalam kondisi segar!";
                        break;
                    case 'Selesai':
                        $message = "Pesanan {$order_display} Anda telah selesai. Terima kasih telah memercayai Florashop!";
                        break;
                    case 'Dibatalkan':
                        $message = "Pesanan {$order_display} Anda dibatalkan.";
                        break;
                    case 'Menunggu':
                        $message = "Pesanan {$order_display} Anda sedang menunggu konfirmasi.";
                        break;
                }

                if (!empty($message)) {
                    $notif_stmt = $conn->prepare("
                        INSERT INTO notifications (user_id, order_id, title, message)
                        VALUES (:user_id, :order_id, :title, :message)
                    ");
                    $notif_stmt->execute([
                        ':user_id'  => $user_id,
                        ':order_id' => $order_id,
                        ':title'    => $title,
                        ':message'  => $message
                    ]);
                }
            }
        } catch (Exception $e) {
            // Silently ignore notification failure
        }

        header('Location: ../../frontend/pages/pesanan_admin.php?success=Status pesanan #' . str_pad($order_id, 4, '0', STR_PAD_LEFT) . ' berhasil diubah menjadi ' . $new_status);
    } else {
        header('Location: ../../frontend/pages/pesanan_admin.php?error=Pesanan tidak ditemukan');
    }
} catch (PDOException $e) {
    header('Location: ../../frontend/pages/pesanan_admin.php?error=Gagal memperbarui status: ' . urlencode($e->getMessage()));
}
exit();
?>
