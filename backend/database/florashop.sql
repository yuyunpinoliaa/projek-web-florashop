-- ============================================================
-- Database: florashop
-- ============================================================

CREATE DATABASE IF NOT EXISTS florashop
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE florashop;

-- ------------------------------------------------------------
-- Tabel: users
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS users (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(100)        NOT NULL,
    email      VARCHAR(100)        NOT NULL UNIQUE,
    password   VARCHAR(255)        NOT NULL,
    role       ENUM('admin', 'user') DEFAULT 'user',
    created_at TIMESTAMP           DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ------------------------------------------------------------
-- Contoh data: akun admin (password: admin123)
-- Hash dibuat dengan: password_hash('admin123', PASSWORD_BCRYPT)
-- ------------------------------------------------------------
INSERT IGNORE INTO users (name, email, password, role) VALUES
(
    'Admin Florashop',
    'admin@florashop.com',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', -- password: password
    'admin'
);

-- ------------------------------------------------------------
-- Tabel: products
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS products (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(255) NOT NULL,
    price       DECIMAL(10,2) NOT NULL,
    description TEXT,
    img         VARCHAR(500),
    tag         VARCHAR(50),
    stock       INT DEFAULT 0,
    status      ENUM('Aktif', 'Stok Rendah', 'Habis') DEFAULT 'Aktif',
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ------------------------------------------------------------
-- Contoh data: products
-- ------------------------------------------------------------
INSERT IGNORE INTO products (name, price, description, img, tag, stock, status) VALUES
('Buket Mawar Merah Segar', 185000, 'Rangkaian mawar merah asli yang fresh dan wangi, dipetik langsung', 'https://lh3.googleusercontent.com/aida-public/AB6AXuC5NnuNUAoGLVTQmVc3h-aK-lR05EllNdOAcWorexgwMRnjtZfLrSD8VUCA807bhBii_NyrJ4Sh7WgXFWW9vUtTkZQOiY2rBk4PlnrVM9GbSq1eHEZBnsMHNUOMhUoEEr1Dwrb_tpUahodD4uasyUPlWku6gtNtrm8AqS8BzuhpD8NTx67vzITqqsXKQNGDXgtVNtPHucKq2OwkqehLsPNdTRGnMKGA1zOBTmyENGB2hAt4PDhX3BDNcUtx6Cb-TyYi3cWKF6x9uHM', 'Premium', 15, 'Aktif'),
('Buket Satin Rose Elegant', 65000, 'Buket bunga mawar dari kain satin kerajinan tangan awet selamanya', 'https://lh3.googleusercontent.com/aida-public/AB6AXuBUqku_1rAE_kBk5pZDIiaY9DuQZlsijWRcKk_jcPTDpswVWlxSguqYk3g9QwtfHUNSGvGiZ92O_V00BOcM2HPv3BSjvD01XeA7XOzc_BSydJA3BRAFTooHIYt7VJD29dkdqAL8GqifVHIv3hCweo3o1_1Dxym6q-iVWFZPUuWrzGXnGU9BgH3VLHed70QoTJDYjOorcu3vJ5gPf4V10AkeTw5DK1u477KBVCpYw_g9IT6mh8dvHXOeDvA1xlQv4sMraA6t1usG1SM', 'Best Seller', 50, 'Aktif'),
('Buket Fresh Sunflower', 135000, 'Bunga matahari asli berukuran besar dikombinasikan dengan baby breath', 'https://lh3.googleusercontent.com/aida-public/AB6AXuCTOTQK0qUlxJogYOHu_crSwfBQ_j7LP-CiTs26N81y3T_ZJtRQpUNalI4Ghcc3rIswmEDVeuWRHyaSOyQQcc31wfiTBmI3RiK8C-rdG3cH_mwKID4IYU_jkG5poRcAh5D0uLIQ7QPXPo-0TRMlO52eeoJbxTAcRe6P9osxqQlykTjPMZW7zwNXsRlbbDYNyYK_xIy9fjAH5YNnctEfL-AEFGsgTppWIvL7M3Nd-UTpMnJWvv0UosCRKYqJQrKOr5AP6O-0ArroOV8', '', 8, 'Stok Rendah'),
('Buket Uang Money Bloom', 150000, 'Buket uang kertas kosong/asli rangkai rapi untuk kado wisuda mewah', 'https://lh3.googleusercontent.com/aida-public/AB6AXuA14T4tD79K-C5sb6rneYZY9ncHh08H83PhLznPW8IsBnHlngG293bOhGcYvfIVeeNcd1gm6FJSBXH5GhR2CpxMYhzqmVgD5cbrlFf0jq3U6x38l21Jv5LEqiXZDVYqc7elJB0kX4MKs_cMVaYzVi8eY38CjWnCXP0x4Cdr6kGcNUg3wvIJeuOgcyvUmvdWtp5pCAP_pmHDlBhjAT2f7J6HBub66-7i0ahUVvJStbIVArtv0Avi4LFsIBVJJpAE4-PSp8xA_tJlPCo', 'Populer', 20, 'Aktif'),
('Buket Artificial Daisy Lily', 75000, 'Buket kombinasi bunga palsu tiruan berbahan plastik & kain premium', 'https://lh3.googleusercontent.com/aida-public/AB6AXuDS4bVXbZMRUnDeOD5vC4NiFEhT0R-UKhUW2HeBDeFhGuwI4XEh-vCmHx5Oy6c7BV_n0vSzGy-qaWooLrYy9ggXf_OaM665tC8kueeixh-MrJ4MTXDyXbvfBSAK59lrvvvYd01dGD06dk0-0wLbRilOopkSB5DRA8GROmFTmJ0HThtE6OYCswKtr962fyRuGbt0h-Y0e_b45UsZ-_7_AX0Drl3dJHF0MO_aDpFaLL8w8JZPBij4wPVphCI8bRsE3Ck3L3qOlHK1-LM', '', 0, 'Habis');

-- ------------------------------------------------------------
-- Tabel: orders
-- ------------------------------------------------------------
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ------------------------------------------------------------
-- Tabel: order_items
-- ------------------------------------------------------------
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
