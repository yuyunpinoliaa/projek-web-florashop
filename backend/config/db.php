<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$host = 'localhost';
$dbname = 'florashop';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Auto-create orders and order_items tables if they do not exist
    $check = $conn->query("SHOW TABLES LIKE 'orders'")->fetch();
    if (!$check) {
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
    }

    // Auto-create notifications table if it does not exist
    $checkNotif = $conn->query("SHOW TABLES LIKE 'notifications'")->fetch();
    if (!$checkNotif) {
        $conn->exec("
            CREATE TABLE IF NOT EXISTS notifications (
                id          INT AUTO_INCREMENT PRIMARY KEY,
                user_id     INT DEFAULT NULL,
                order_id    INT NOT NULL,
                title       VARCHAR(255) NOT NULL,
                message     TEXT NOT NULL,
                is_read     TINYINT(1) DEFAULT 0,
                created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
                FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
        ");
    } else {
        try {
            $conn->exec("ALTER TABLE notifications MODIFY user_id INT DEFAULT NULL");
        } catch (PDOException $ex) {
            // Silently handle if it's already nullable
        }
    }
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
