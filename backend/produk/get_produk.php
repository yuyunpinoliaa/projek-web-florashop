<?php
require_once '../config/db.php';

header('Content-Type: application/json');

try {
    $stmt = $conn->prepare("SELECT * FROM produk ORDER BY id DESC");
    $stmt->execute();
    $produk = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode(['status' => 'success', 'data' => $produk]);
} catch(PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
