<<<<<<< HEAD
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
    id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama       VARCHAR(100)        NOT NULL,
    email      VARCHAR(150)        NOT NULL UNIQUE,
    password   VARCHAR(255)        NOT NULL,          -- disimpan dengan password_hash()
    role       ENUM('user','admin') NOT NULL DEFAULT 'user',
    created_at TIMESTAMP           NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ------------------------------------------------------------
-- Contoh data: akun admin (password: admin123)
-- Hash dibuat dengan: password_hash('admin123', PASSWORD_DEFAULT)
-- ------------------------------------------------------------
INSERT INTO users (nama, email, password, role) VALUES
(
    'Admin Florashop',
    'admin@florashop.com',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', -- password: password
    'admin'
=======
CREATE DATABASE IF NOT EXISTS florashop;
USE florashop;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
>>>>>>> 8885c56dd68b483b6724449d6273e7e3787a101e
);
