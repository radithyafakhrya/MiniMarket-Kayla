-- ============================================================
-- SKEMA BASIS DATA — MESIN KASIR BERBASIS WEB
-- ============================================================
-- Berkas ini berisi seluruh struktur tabel untuk sistem kasir.
-- Jalankan berkas ini di phpMyAdmin atau terminal MySQL.
-- ============================================================

-- Membuat basis data
CREATE DATABASE IF NOT EXISTS kasir_toko
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci;

USE kasir_toko;

-- ============================================================
-- BAGIAN 1: TABEL PENGGUNA (Radit)
-- ============================================================

-- Tabel utama pengguna (pemilik toko dan kasir)
CREATE TABLE IF NOT EXISTS pengguna (
    id              INT AUTO_INCREMENT PRIMARY KEY,
    nama_lengkap    VARCHAR(100)    NOT NULL,
    nama_pengguna   VARCHAR(50)     NOT NULL UNIQUE,
    kata_sandi      VARCHAR(255)    NOT NULL,
    peran           ENUM('pemilik', 'kasir') NOT NULL DEFAULT 'kasir',
    dibuat_pada     DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    diperbarui_pada DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel pencatatan percobaan masuk (untuk perlindungan brute force)
CREATE TABLE IF NOT EXISTS percobaan_masuk (
    id              INT AUTO_INCREMENT PRIMARY KEY,
    nama_pengguna   VARCHAR(50)     NOT NULL,
    alamat_ip       VARCHAR(45)     NOT NULL,
    waktu_percobaan DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,

    INDEX idx_percobaan (nama_pengguna, alamat_ip, waktu_percobaan)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- Menyisipkan akun pemilik toko bawaan
-- Kata sandi bawaan: "pemilik123" (sudah di-hash dengan password_hash)
-- PENTING: Segera ubah kata sandi ini setelah pertama kali masuk!
-- ============================================================
INSERT INTO pengguna (nama_lengkap, nama_pengguna, kata_sandi, peran) VALUES
('Pemilik Toko', 'pemilik', '$2y$10$YJGfrOjVbNxkPGE8gN8oXOKz.sBdTq9fVHfGk3kR6Oa0eBm.Xz6Wy', 'pemilik');

-- ============================================================
-- BAGIAN 2: TABEL KATEGORI DAN BARANG (Elfina)
-- ============================================================
-- Silakan tambahkan tabel kategori dan barang di sini.

CREATE TABLE IF NOT EXISTS kategori (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    nama        VARCHAR(100)    NOT NULL UNIQUE,
    dibuat_pada DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS barang (
    id              INT AUTO_INCREMENT PRIMARY KEY,
    kategori_id     INT             NULL,
    nama_barang     VARCHAR(150)    NOT NULL UNIQUE,
    harga_jual      INT             NOT NULL DEFAULT 0,
    jumlah_stok     INT             NOT NULL DEFAULT 0,
    batas_stok_min  INT             NOT NULL DEFAULT 5,
    dibuat_pada     DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    diperbarui_pada DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    FOREIGN KEY (kategori_id) REFERENCES kategori(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- BAGIAN 3: TABEL TRANSAKSI (Rafli)
-- ============================================================
-- Silakan tambahkan tabel transaksi dan detail_transaksi di sini.

CREATE TABLE IF NOT EXISTS transaksi (
    id              INT AUTO_INCREMENT PRIMARY KEY,
    pengguna_id     INT             NOT NULL,
    total           INT             NOT NULL DEFAULT 0,
    uang_diterima   INT             NOT NULL DEFAULT 0,
    kembalian       INT             NOT NULL DEFAULT 0,
    tanggal         DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (pengguna_id) REFERENCES pengguna(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS detail_transaksi (
    id              INT AUTO_INCREMENT PRIMARY KEY,
    transaksi_id    INT             NOT NULL,
    barang_id       INT             NOT NULL,
    nama_barang     VARCHAR(150)    NOT NULL,
    harga_satuan    INT             NOT NULL DEFAULT 0,
    jumlah          INT             NOT NULL DEFAULT 1,
    subtotal        INT             NOT NULL DEFAULT 0,

    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id) ON DELETE CASCADE,
    FOREIGN KEY (barang_id) REFERENCES barang(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- Sisipkan kategori contoh
-- ============================================================
INSERT INTO kategori (nama) VALUES
('Makanan Ringan'),
('Minuman'),
('Kebutuhan Pokok'),
('Peralatan Mandi'),
('Peralatan Rumah Tangga');
