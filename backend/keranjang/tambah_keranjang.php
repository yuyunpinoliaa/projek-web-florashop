<?php
session_start();
header('Content-Type: application/json');

// Pastikan method-nya POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data JSON yang dikirim dari frontend
    $input = json_decode(file_get_contents('php://input'), true);
    
    $product_name  = $input['name'] ?? '';
    $product_price = $input['price'] ?? 0;
    $product_img   = $input['img'] ?? '';

    if (empty($product_name)) {
        echo json_encode(['status' => 'error', 'message' => 'Data produk tidak valid']);
        exit;
    }

    // Jika session cart belum ada, buat baru berbentuk array
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Cek apakah produk sudah ada di keranjang
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['name'] === $product_name) {
            $item['quantity'] += 1; // Jika sudah ada, tambah jumlahnya
            $found = true;
            break;
        }
    }

    // Jika produk belum ada di keranjang, tambahkan data baru
    if (!$found) {
        $_SESSION['cart'][] = [
            'name' => $product_name,
            'price' => $product_price,
            'img' => $product_img,
            'quantity' => 1
        ];
    }

    echo json_encode([
        'status' => 'success', 
        'message' => 'Produk berhasil ditambahkan ke keranjang!',
        'total_items' => count($_SESSION['cart'])
    ]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Method tidak diizinkan']);
}