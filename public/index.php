<?php
// ============================================================
// HALAMAN UTAMA (ROUTER / TITIK MASUK)
// Berkas: public/index.php
// ============================================================
// Berkas ini menerima semua permintaan dari peramban dan
// mengarahkannya ke controller yang sesuai.
//
// Pola URL:
//   index.php?halaman=masuk          → Halaman masuk
//   index.php?halaman=kasir          → Halaman kasir
//   index.php?halaman=barang         → Halaman barang
//   index.php?halaman=laporan        → Halaman laporan
//   index.php?halaman=pengguna       → Halaman kelola pengguna
//   index.php?halaman=beranda        → Halaman beranda
// ============================================================

// Muat pengaturan dan fungsi bantuan
require_once __DIR__ . '/../app/config/database.php';
require_once __DIR__ . '/../app/helpers/fungsi.php';

// Ambil halaman dan aksi dari URL
$halaman = $_GET['halaman'] ?? 'beranda';
$aksi    = $_GET['aksi'] ?? 'index';

// ============================================================
// ROUTING — Mengarahkan ke Controller yang sesuai
// ============================================================

switch ($halaman) {

    // --------------------------------------------------------
    // MASUK & KELUAR (Radit)
    // --------------------------------------------------------
    case 'masuk':
        require_once APP_PATH . '/controllers/AuthController.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $aksi === 'proses') {
            proses_masuk($pdo);
        } else {
            halaman_masuk($pdo);
        }
        break;

    case 'keluar':
        require_once APP_PATH . '/controllers/AuthController.php';
        proses_keluar();
        break;

    // --------------------------------------------------------
    // KELOLA PENGGUNA (Radit)
    // --------------------------------------------------------
    case 'pengguna':
        require_once APP_PATH . '/controllers/AuthController.php';
        switch ($aksi) {
            case 'tambah':
                halaman_tambah_pengguna($pdo);
                break;
            case 'simpan':
                proses_tambah_pengguna($pdo);
                break;
            case 'hapus':
                proses_hapus_pengguna($pdo);
                break;
            default:
                halaman_daftar_pengguna($pdo);
                break;
        }
        break;

    // --------------------------------------------------------
    // KASIR / TRANSAKSI (Rafli)
    // --------------------------------------------------------
    case 'kasir':
        wajib_masuk();
        // require_once APP_PATH . '/controllers/KasirController.php';
        // Belum dikerjakan — akan dibuat oleh Rafli
        $judul_halaman = 'Kasir';
        require APP_PATH . '/views/layouts/header.php';
        require APP_PATH . '/views/layouts/sidebar.php';
        echo '<div class="area-konten"><h1 style="font-size:28px;font-weight:700;color:var(--warna-teks-utama);">Halaman Kasir</h1>';
        echo '<p style="font-size:16px;color:var(--warna-teks-sekunder);margin-top:8px;">Halaman ini sedang dalam tahap pengembangan oleh Rafli.</p></div>';
        require APP_PATH . '/views/layouts/footer.php';
        break;

    // --------------------------------------------------------
    // BARANG (Elfina)
    // --------------------------------------------------------
    case 'barang':
        wajib_masuk();
        // require_once APP_PATH . '/controllers/BarangController.php';
        // Belum dikerjakan — akan dibuat oleh Elfina
        $judul_halaman = 'Daftar Barang';
        require APP_PATH . '/views/layouts/header.php';
        require APP_PATH . '/views/layouts/sidebar.php';
        echo '<div class="area-konten"><h1 style="font-size:28px;font-weight:700;color:var(--warna-teks-utama);">Daftar Barang</h1>';
        echo '<p style="font-size:16px;color:var(--warna-teks-sekunder);margin-top:8px;">Halaman ini sedang dalam tahap pengembangan oleh Elfina.</p></div>';
        require APP_PATH . '/views/layouts/footer.php';
        break;

    // --------------------------------------------------------
    // LAPORAN (Elfina)
    // --------------------------------------------------------
    case 'laporan':
        wajib_pemilik();
        // require_once APP_PATH . '/controllers/LaporanController.php';
        // Belum dikerjakan — akan dibuat oleh Elfina
        $judul_halaman = 'Laporan Penjualan';
        require APP_PATH . '/views/layouts/header.php';
        require APP_PATH . '/views/layouts/sidebar.php';
        echo '<div class="area-konten"><h1 style="font-size:28px;font-weight:700;color:var(--warna-teks-utama);">Laporan Penjualan</h1>';
        echo '<p style="font-size:16px;color:var(--warna-teks-sekunder);margin-top:8px;">Halaman ini sedang dalam tahap pengembangan oleh Elfina.</p></div>';
        require APP_PATH . '/views/layouts/footer.php';
        break;

    // --------------------------------------------------------
    // BERANDA (Default)
    // --------------------------------------------------------
    case 'beranda':
    default:
        wajib_masuk();
        $judul_halaman = 'Beranda';
        require APP_PATH . '/views/layouts/header.php';
        require APP_PATH . '/views/layouts/sidebar.php';
        echo '<div class="area-konten">';
        echo tampilkan_pesan_kilat();
        echo '<h1 style="font-size:28px;font-weight:700;color:var(--warna-teks-utama);">Selamat Datang di ' . e(NAMA_TOKO) . '</h1>';
        echo '<p style="font-size:16px;color:var(--warna-teks-sekunder);margin-top:8px;">Silakan pilih menu di sebelah kiri untuk memulai.</p>';
        echo '</div>';
        require APP_PATH . '/views/layouts/footer.php';
        break;
}
