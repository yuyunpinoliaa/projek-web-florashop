<?php
/**
 * Script migrasi untuk membuat tabel orders dan order_items.
 * Jalankan sekali via browser: http://localhost/projek-web-florashop/backend/database/migrate_orders.php
 */
require_once __DIR__ . '/../config/db.php';

try {
    // Tabel orders
    $conn->exec("
        CREATE TABLE IF NOT EXISTS orders (
            id              INT AUTO_INCREMENT PRIMARY KEY,
            user_id         INT DEFAULT NULL,
            customer_name   VARCHAR(255) NOT NULL,
            customer_email  VARCHAR(255) DEFAULT NULL,
            address         TEXT NOT NULL,
            shipping_option VARCHAR(50)  NOT NULL DEFAULT 'express',
            payment_method  VARCHAR(50)  NOT NULL DEFAULT 'credit_card',
            subtotal        DECIMAL(12,2) NOT NULL DEFAULT 0,
            shipping_cost   DECIMAL(12,2) NOT NULL DEFAULT 0,
            tax             DECIMAL(12,2) NOT NULL DEFAULT 0,
            total           DECIMAL(12,2) NOT NULL DEFAULT 0,
            status          ENUM('Menunggu', 'Diproses', 'Dikirim', 'Selesai', 'Dibatalkan') DEFAULT 'Menunggu',
            created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");
    echo "✅ Tabel 'orders' berhasil dibuat.<br>";

    // Tabel order_items
    $conn->exec("
        CREATE TABLE IF NOT EXISTS order_items (
            id          INT AUTO_INCREMENT PRIMARY KEY,
            order_id    INT NOT NULL,
            product_id  INT DEFAULT NULL,
            product_name VARCHAR(255) NOT NULL,
            product_img  VARCHAR(500) DEFAULT NULL,
            quantity    INT NOT NULL DEFAULT 1,
            price       DECIMAL(12,2) NOT NULL DEFAULT 0,
            FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
            FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");
    echo "✅ Tabel 'order_items' berhasil dibuat.<br>";

    echo "<br><strong>Migrasi selesai! Anda bisa menghapus file ini.</strong>";
} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage();
}
?>
