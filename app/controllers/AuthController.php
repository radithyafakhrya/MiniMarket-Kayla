<?php
// ============================================================
// CONTROLLER AUTENTIKASI
// Berkas: app/controllers/AuthController.php
// Penanggung Jawab: Radit
// ============================================================
// Menangani proses masuk, keluar, dan pengelolaan pengguna.
// ============================================================

require_once APP_PATH . '/models/Pengguna.php';

// ============================================================
// MASUK (LOGIN)
// ============================================================

/**
 * Menampilkan halaman masuk.
 */
function halaman_masuk(PDO $pdo): void
{
    // Jika sudah masuk, langsung arahkan ke beranda
    if (sudah_masuk()) {
        alihkan('index.php?halaman=beranda');
    }

    require APP_PATH . '/views/auth/masuk.php';
}

/**
 * Memproses formulir masuk (login).
 */
function proses_masuk(PDO $pdo): void
{
    // Validasi token CSRF
    if (!verifikasi_token_csrf($_POST['token_csrf'] ?? '')) {
        simpan_pesan_kilat('gagal', 'Maaf, terjadi kesalahan keamanan. Silakan coba lagi.');
        alihkan('index.php?halaman=masuk');
    }

    $nama_pengguna = trim($_POST['nama_pengguna'] ?? '');
    $kata_sandi    = $_POST['kata_sandi'] ?? '';
    $alamat_ip     = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';

    // Validasi kolom kosong
    if (empty($nama_pengguna) || empty($kata_sandi)) {
        simpan_pesan_kilat('gagal', 'Mohon lengkapi semua kolom yang bertanda bintang (*).');
        alihkan('index.php?halaman=masuk');
    }

    // Bersihkan percobaan masuk yang sudah lama
    bersihkan_percobaan_lama($pdo);

    // Periksa apakah akun sedang dikunci (brute force protection)
    $jumlah_percobaan = hitung_percobaan_masuk($pdo, $nama_pengguna, $alamat_ip);
    if ($jumlah_percobaan >= BATAS_PERCOBAAN_MASUK) {
        simpan_pesan_kilat('gagal', 'Maaf, terlalu banyak percobaan masuk yang gagal. Demi keamanan, silakan coba lagi setelah ' . DURASI_KUNCI_MENIT . ' menit.');
        alihkan('index.php?halaman=masuk');
    }

    // Cari pengguna di basis data
    $pengguna = ambil_pengguna_berdasarkan_nama($pdo, $nama_pengguna);

    // Verifikasi kata sandi
    // Pesan kesalahan TIDAK menyebutkan apakah nama pengguna atau kata sandi yang salah (keamanan)
    if ($pengguna === null || !password_verify($kata_sandi, $pengguna['kata_sandi'])) {
        // Catat percobaan gagal
        catat_percobaan_masuk($pdo, $nama_pengguna, $alamat_ip);

        simpan_pesan_kilat('gagal', 'Maaf, nama pengguna atau kata sandi yang Anda masukkan tidak sesuai. Silakan coba lagi.');
        alihkan('index.php?halaman=masuk');
    }

    // === BERHASIL MASUK ===

    // Hapus catatan percobaan masuk
    hapus_percobaan_masuk($pdo, $nama_pengguna, $alamat_ip);

    // Regenerasi ID sesi untuk keamanan
    session_regenerate_id(true);

    // Simpan data pengguna ke sesi
    $_SESSION['pengguna_id']              = $pengguna['id'];
    $_SESSION['pengguna_nama']            = $pengguna['nama_lengkap'];
    $_SESSION['pengguna_nama_pengguna']   = $pengguna['nama_pengguna'];
    $_SESSION['pengguna_peran']           = $pengguna['peran'];
    $_SESSION['waktu_aktivitas_terakhir'] = time();

    // Pesan selamat datang
    simpan_pesan_kilat('sukses', 'Selamat datang kembali, ' . $pengguna['nama_lengkap'] . '!');

    // Arahkan ke halaman yang sesuai berdasarkan peran
    if ($pengguna['peran'] === 'pemilik') {
        alihkan('index.php?halaman=beranda');
    } else {
        alihkan('index.php?halaman=kasir');
    }
}

// ============================================================
// KELUAR (LOGOUT)
// ============================================================

/**
 * Memproses keluar dari sistem.
 */
function proses_keluar(): void
{
    // Hapus semua data sesi
    session_unset();
    session_destroy();

    // Mulai sesi baru untuk pesan kilat
    session_start();
    simpan_pesan_kilat('sukses', 'Anda telah berhasil keluar dari sistem. Sampai jumpa kembali!');

    alihkan('index.php?halaman=masuk');
}

// ============================================================
// KELOLA PENGGUNA (Hanya Pemilik Toko)
// ============================================================

/**
 * Menampilkan halaman daftar pengguna.
 */
function halaman_daftar_pengguna(PDO $pdo): void
{
    wajib_pemilik();

    $daftar_pengguna = ambil_semua_pengguna($pdo);
    $judul_halaman   = 'Kelola Pengguna';

    require APP_PATH . '/views/layouts/header.php';
    require APP_PATH . '/views/layouts/sidebar.php';
    require APP_PATH . '/views/pengguna/daftar.php';
    require APP_PATH . '/views/layouts/footer.php';
}

/**
 * Menampilkan halaman tambah pengguna baru.
 */
function halaman_tambah_pengguna(PDO $pdo): void
{
    wajib_pemilik();

    $judul_halaman = 'Tambah Kasir Baru';

    require APP_PATH . '/views/layouts/header.php';
    require APP_PATH . '/views/layouts/sidebar.php';
    require APP_PATH . '/views/pengguna/tambah.php';
    require APP_PATH . '/views/layouts/footer.php';
}

/**
 * Memproses penambahan pengguna baru.
 */
function proses_tambah_pengguna(PDO $pdo): void
{
    wajib_pemilik();

    // Validasi CSRF
    if (!verifikasi_token_csrf($_POST['token_csrf'] ?? '')) {
        simpan_pesan_kilat('gagal', 'Maaf, terjadi kesalahan keamanan. Silakan coba lagi.');
        alihkan('index.php?halaman=pengguna&aksi=tambah');
    }

    $nama_lengkap  = trim($_POST['nama_lengkap'] ?? '');
    $nama_pengguna = trim($_POST['nama_pengguna'] ?? '');
    $kata_sandi    = $_POST['kata_sandi'] ?? '';
    $peran         = 'kasir'; // Hanya bisa menambahkan kasir

    // Validasi kolom kosong
    if (empty($nama_lengkap) || empty($nama_pengguna) || empty($kata_sandi)) {
        simpan_pesan_kilat('gagal', 'Mohon lengkapi semua kolom yang bertanda bintang (*).');
        alihkan('index.php?halaman=pengguna&aksi=tambah');
    }

    // Validasi panjang kata sandi
    if (strlen($kata_sandi) < PANJANG_KATA_SANDI_MIN) {
        simpan_pesan_kilat('gagal', 'Kata sandi harus terdiri dari minimal ' . PANJANG_KATA_SANDI_MIN . ' karakter.');
        alihkan('index.php?halaman=pengguna&aksi=tambah');
    }

    // Validasi nama pengguna unik
    if (nama_pengguna_sudah_ada($pdo, $nama_pengguna)) {
        simpan_pesan_kilat('gagal', 'Maaf, nama pengguna tersebut sudah digunakan. Silakan pilih nama pengguna yang lain.');
        alihkan('index.php?halaman=pengguna&aksi=tambah');
    }

    // Simpan pengguna baru
    $berhasil = tambah_pengguna($pdo, $nama_lengkap, $nama_pengguna, $kata_sandi, $peran);

    if ($berhasil) {
        simpan_pesan_kilat('sukses', 'Akun kasir baru berhasil ditambahkan.');
    } else {
        simpan_pesan_kilat('gagal', 'Maaf, terjadi kendala saat menyimpan data. Silakan coba lagi.');
    }

    alihkan('index.php?halaman=pengguna');
}

/**
 * Memproses penghapusan pengguna.
 */
function proses_hapus_pengguna(PDO $pdo): void
{
    wajib_pemilik();

    // Validasi CSRF
    if (!verifikasi_token_csrf($_POST['token_csrf'] ?? '')) {
        simpan_pesan_kilat('gagal', 'Maaf, terjadi kesalahan keamanan. Silakan coba lagi.');
        alihkan('index.php?halaman=pengguna');
    }

    $id = (int) ($_POST['id'] ?? 0);

    if ($id <= 0) {
        simpan_pesan_kilat('gagal', 'Maaf, data pengguna tidak ditemukan.');
        alihkan('index.php?halaman=pengguna');
    }

    // Cegah menghapus akun sendiri
    if ($id === id_pengguna_saat_ini()) {
        simpan_pesan_kilat('gagal', 'Maaf, Anda tidak dapat menghapus akun yang sedang Anda gunakan.');
        alihkan('index.php?halaman=pengguna');
    }

    // Cek apakah pengguna ada dan bukan pemilik
    $pengguna = ambil_pengguna_berdasarkan_id($pdo, $id);
    if ($pengguna === null) {
        simpan_pesan_kilat('gagal', 'Maaf, data pengguna tidak ditemukan.');
        alihkan('index.php?halaman=pengguna');
    }

    if ($pengguna['peran'] === 'pemilik') {
        simpan_pesan_kilat('gagal', 'Maaf, akun pemilik toko tidak dapat dihapus.');
        alihkan('index.php?halaman=pengguna');
    }

    // Hapus pengguna
    $berhasil = hapus_pengguna($pdo, $id);

    if ($berhasil) {
        simpan_pesan_kilat('sukses', 'Akun kasir berhasil dihapus.');
    } else {
        simpan_pesan_kilat('gagal', 'Maaf, terjadi kendala saat menghapus data. Silakan coba lagi.');
    }

    alihkan('index.php?halaman=pengguna');
}
