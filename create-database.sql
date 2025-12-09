-- ========================================
-- Script untuk membuat database MySQL
-- Aplikasi Manajemen Buku Paket Sekolah
-- ========================================

-- Buat database baru
CREATE DATABASE IF NOT EXISTS library_management 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

-- Gunakan database
USE library_management;

-- Buat user baru (opsional, jika ingin user khusus)
-- CREATE USER IF NOT EXISTS 'library_user'@'localhost' IDENTIFIED BY 'password_anda';
-- GRANT ALL PRIVILEGES ON library_management.* TO 'library_user'@'localhost';
-- FLUSH PRIVILEGES;

-- Tampilkan konfirmasi
SELECT 'Database library_management berhasil dibuat!' AS status;
SELECT 'Silakan jalankan: php artisan migrate' AS next_step;
