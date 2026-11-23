<?php
// ============================================================
// PENGATURAN KONEKSI BASIS DATA
// Berkas: app/config/database.php
// Penanggung Jawab: Radit
// ============================================================

// Pengaturan basis data
// Sesuaikan nilai di bawah ini dengan pengaturan server Anda
define('DB_HOST', 'localhost');
define('DB_NAME', 'kasir_toko');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

// Pengaturan aplikasi
define('NAMA_TOKO', 'Toko Kelontong');
define('VERSI_SISTEM', '1.0.0');
define('BATAS_PERCOBAAN_MASUK', 5);         // Maksimal percobaan masuk sebelum dikunci
define('DURASI_KUNCI_MENIT', 15);           // Durasi penguncian akun (dalam menit)
define('DURASI_SESI_MENIT', 30);            // Durasi sesi sebelum otomatis keluar
define('PANJANG_KATA_SANDI_MIN', 6);        // Panjang minimum kata sandi

// Jalur direktori
define('BASE_PATH', dirname(__DIR__, 2));    // Akar proyek (test kasir/)
define('APP_PATH', dirname(__DIR__));        // Folder app/
define('PUBLIC_PATH', BASE_PATH . '/public');

// Membuat koneksi PDO
try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET,
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );
} catch (PDOException $e) {
    // Pesan ramah untuk pengguna, detail error disembunyikan
    die("Maaf, tidak dapat terhubung ke basis data. Silakan periksa pengaturan server.");
}
