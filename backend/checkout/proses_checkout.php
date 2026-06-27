<?php
header('Content-Type: application/json');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

try {
    // Validasi request method
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo json_encode(['status' => 'error', 'message' => 'Method tidak diizinkan.']);
        exit;
    }

    // Koneksi database
    require_once '../config/db.php';

    // Ambil data dari POST
    $selected_address = isset($_POST['selected_address']) ? trim($_POST['selected_address']) : '';
    $shipping_option  = isset($_POST['shipping_option']) ? trim($_POST['shipping_option']) : 'express';
    $payment_method   = isset($_POST['payment_method']) ? trim($_POST['payment_method']) : 'credit_card';

    // Validasi minimal
    if (empty($selected_address)) {
        echo json_encode(['status' => 'error', 'message' => 'Alamat pengiriman harus dipilih.']);
        exit;
    }

    // Tentukan alamat berdasarkan pilihan
    $address_map = [
        'HOME' => 'Jl. Melati Raya No. 45, Kebayoran Baru, Jakarta Selatan, DKI Jakarta 12110',
        'WORK' => 'Gedung Astra, Lantai 24, Jl. Jend. Sudirman, Jakarta Pusat, DKI Jakarta 10220'
    ];
    $address = isset($address_map[$selected_address]) ? $address_map[$selected_address] : $selected_address;

    // Tentukan ongkos kirim
    $shipping_cost = ($shipping_option === 'express') ? 30000 : 0;

    // Ambil data keranjang dari session
    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

    if (empty($cart)) {
        echo json_encode(['status' => 'error', 'message' => 'Keranjang belanja kosong.']);
        exit;
    }

    // Hitung subtotal dari cart session
    $subtotal = 0;
    $order_items = [];

    foreach ($cart as $index => $item) {
        $qty = isset($item['quantity']) ? intval($item['quantity']) : 1;
        if ($qty < 1) $qty = 1;
        $price = floatval($item['price']);
        $subtotal += $price * $qty;

        // Cari product_id berdasarkan nama produk (opsional, bisa null)
        $product_id = null;
        try {
            $find_stmt = $conn->prepare("SELECT id FROM products WHERE name = :name LIMIT 1");
            $find_stmt->execute([':name' => $item['name']]);
            $found = $find_stmt->fetch(PDO::FETCH_ASSOC);
            if ($found) {
                $product_id = intval($found['id']);
            }
        } catch (Exception $e) {
            // Biarkan product_id null jika gagal
        }

        $order_items[] = [
            'product_id'   => $product_id,
            'product_name' => $item['name'],
            'product_img'  => isset($item['img']) ? $item['img'] : '',
            'quantity'     => $qty,
            'price'        => $price
        ];
    }

    $tax = round($subtotal * 0.10);
    $total = $subtotal + $shipping_cost + $tax;

    // Ambil data user dari session (jika login)
    $user_id = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : null;
    $customer_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Pelanggan';
    $customer_email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : null;

    // Mulai transaksi database
    $conn->beginTransaction();

    // Insert order
    $stmt = $conn->prepare("
        INSERT INTO orders (user_id, customer_name, customer_email, address, shipping_option, payment_method, subtotal, shipping_cost, tax, total, status)
        VALUES (:user_id, :customer_name, :customer_email, :address, :shipping_option, :payment_method, :subtotal, :shipping_cost, :tax, :total, 'Menunggu')
    ");

    $stmt->execute([
        ':user_id'        => $user_id,
        ':customer_name'  => $customer_name,
        ':customer_email' => $customer_email,
        ':address'        => $address,
        ':shipping_option'=> $shipping_option,
        ':payment_method' => $payment_method,
        ':subtotal'       => $subtotal,
        ':shipping_cost'  => $shipping_cost,
        ':tax'            => $tax,
        ':total'          => $total
    ]);

    $order_id = $conn->lastInsertId();

    // Insert order items
    $item_stmt = $conn->prepare("
        INSERT INTO order_items (order_id, product_id, product_name, product_img, quantity, price)
        VALUES (:order_id, :product_id, :product_name, :product_img, :quantity, :price)
    ");

    foreach ($order_items as $oi) {
        $item_stmt->execute([
            ':order_id'     => $order_id,
            ':product_id'   => $oi['product_id'],
            ':product_name' => $oi['product_name'],
            ':product_img'  => $oi['product_img'],
            ':quantity'     => $oi['quantity'],
            ':price'        => $oi['price']
        ]);
    }

    // Commit transaksi
    $conn->commit();

    // Kosongkan keranjang setelah checkout berhasil
    unset($_SESSION['cart']);

    echo json_encode([
        'status'   => 'success',
        'message'  => 'Pesanan berhasil dibuat!',
        'order_id' => $order_id
    ]);

} catch (PDOException $e) {
    // Rollback jika ada error database
    if (isset($conn) && $conn->inTransaction()) {
        $conn->rollBack();
    }
    echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan pesanan: ' . $e->getMessage()]);
} catch (Exception $e) {
    if (isset($conn) && $conn->inTransaction()) {
        $conn->rollBack();
    }
    echo json_encode(['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
}
?>
