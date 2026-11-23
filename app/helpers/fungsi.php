<?php
// ============================================================
// FUNGSI-FUNGSI BANTUAN (HELPER)
// Berkas: app/helpers/fungsi.php
// ============================================================
// Bagian Autentikasi & Keamanan: Radit
// Bagian Format & Utilitas: Rafli
// ============================================================

session_start();

// ============================================================
// BAGIAN 1: AUTENTIKASI & KEAMANAN (Radit)
// ============================================================

/**
 * Memeriksa apakah pengguna sudah masuk (login).
 */
function sudah_masuk(): bool
{
    return isset($_SESSION['pengguna_id']);
}

/**
 * Memeriksa apakah pengguna yang sedang masuk adalah pemilik toko.
 */
function adalah_pemilik(): bool
{
    return isset($_SESSION['pengguna_peran'])
        && $_SESSION['pengguna_peran'] === 'pemilik';
}

/**
 * Mengharuskan pengguna sudah masuk.
 * Jika belum masuk, akan dialihkan ke halaman masuk.
 */
function wajib_masuk(): void
{
    if (!sudah_masuk()) {
        simpan_pesan_kilat('peringatan', 'Silakan masuk terlebih dahulu untuk menggunakan sistem ini.');
        alihkan('index.php?halaman=masuk');
    }

    // Periksa apakah sesi sudah habis (timeout)
    if (isset($_SESSION['waktu_aktivitas_terakhir'])) {
        $selisih = time() - $_SESSION['waktu_aktivitas_terakhir'];
        if ($selisih > (DURASI_SESI_MENIT * 60)) {
            // Hapus sesi dan arahkan ke halaman masuk
            session_unset();
            session_destroy();
            session_start();
            simpan_pesan_kilat('peringatan', 'Sesi Anda telah berakhir karena tidak ada aktivitas. Silakan masuk kembali.');
            alihkan('index.php?halaman=masuk');
        }
    }

    // Perbarui waktu aktivitas terakhir
    $_SESSION['waktu_aktivitas_terakhir'] = time();
}

/**
 * Mengharuskan pengguna adalah pemilik toko.
 * Jika bukan pemilik, akan dialihkan ke halaman kasir.
 */
function wajib_pemilik(): void
{
    wajib_masuk();

    if (!adalah_pemilik()) {
        simpan_pesan_kilat('gagal', 'Maaf, Anda tidak memiliki izin untuk mengakses halaman ini.');
        alihkan('index.php?halaman=kasir');
    }
}

/**
 * Membuat token CSRF dan menyimpannya di sesi.
 */
function buat_token_csrf(): string
{
    if (empty($_SESSION['token_csrf'])) {
        $_SESSION['token_csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['token_csrf'];
}

/**
 * Memverifikasi token CSRF dari formulir.
 */
function verifikasi_token_csrf(string $token): bool
{
    if (empty($_SESSION['token_csrf']) || empty($token)) {
        return false;
    }

    $valid = hash_equals($_SESSION['token_csrf'], $token);

    // Hapus token setelah digunakan (sekali pakai)
    unset($_SESSION['token_csrf']);

    return $valid;
}

/**
 * Menghasilkan kolom input tersembunyi berisi token CSRF.
 */
function kolom_csrf(): string
{
    $token = buat_token_csrf();
    return '<input type="hidden" name="token_csrf" value="' . htmlspecialchars($token, ENT_QUOTES, 'UTF-8') . '">';
}

/**
 * Membersihkan input teks dari karakter berbahaya.
 */
function bersihkan_input(string $data): string
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

/**
 * Menampilkan teks dengan aman (mencegah XSS).
 */
function e(string $teks): string
{
    return htmlspecialchars($teks, ENT_QUOTES, 'UTF-8');
}

// ============================================================
// BAGIAN 2: PESAN KILAT (FLASH MESSAGE) (Radit)
// ============================================================

/**
 * Menyimpan pesan kilat ke sesi.
 * Tipe: 'sukses', 'gagal', 'peringatan', 'info'
 */
function simpan_pesan_kilat(string $tipe, string $pesan): void
{
    $_SESSION['pesan_kilat'] = [
        'tipe'  => $tipe,
        'pesan' => $pesan,
    ];
}

/**
 * Mengambil dan menghapus pesan kilat dari sesi.
 * Mengembalikan null jika tidak ada pesan.
 */
function ambil_pesan_kilat(): ?array
{
    if (isset($_SESSION['pesan_kilat'])) {
        $pesan = $_SESSION['pesan_kilat'];
        unset($_SESSION['pesan_kilat']);
        return $pesan;
    }
    return null;
}

/**
 * Menampilkan pesan kilat dalam bentuk HTML.
 */
function tampilkan_pesan_kilat(): string
{
    $pesan = ambil_pesan_kilat();

    if ($pesan === null) {
        return '';
    }

    $warna = match ($pesan['tipe']) {
        'sukses'     => '#15803D', // Emerald Green
        'gagal'      => '#B91C1C', // Crimson Red
        'peringatan' => '#B45309', // Amber Gold
        default      => '#0F766E', // Deep Teal
    };

    $warna_latar = match ($pesan['tipe']) {
        'sukses'     => '#F0FDF4',
        'gagal'      => '#FEF2F2',
        'peringatan' => '#FFFBEB',
        default      => '#F0FDFA',
    };

    return '<div class="pesan-kilat" style="padding: 14px 20px; margin-bottom: 20px; border-radius: 10px; '
        . 'border-left: 4px solid ' . $warna . '; background-color: ' . $warna_latar . '; '
        . 'color: ' . $warna . '; font-size: 16px; font-weight: 500;">'
        . e($pesan['pesan'])
        . '</div>';
}

// ============================================================
// BAGIAN 3: NAVIGASI & UTILITAS (Radit)
// ============================================================

/**
 * Mengalihkan pengguna ke halaman lain.
 */
function alihkan(string $url): void
{
    header("Location: $url");
    exit;
}

/**
 * Mendapatkan nama pengguna yang sedang masuk.
 */
function nama_pengguna_saat_ini(): string
{
    return $_SESSION['pengguna_nama'] ?? 'Pengguna';
}

/**
 * Mendapatkan peran pengguna yang sedang masuk.
 */
function peran_pengguna_saat_ini(): string
{
    return $_SESSION['pengguna_peran'] ?? '';
}

/**
 * Mendapatkan ID pengguna yang sedang masuk.
 */
function id_pengguna_saat_ini(): int
{
    return $_SESSION['pengguna_id'] ?? 0;
}

// ============================================================
// BAGIAN 4: FORMAT & UTILITAS (Rafli)
// ============================================================

/**
 * Memformat angka menjadi format Rupiah.
 * Contoh: 15000 → "Rp15.000"
 */
function format_rupiah(int $angka): string
{
    return 'Rp' . number_format($angka, 0, ',', '.');
}

/**
 * Memformat tanggal ke format Indonesia.
 * Contoh: "2026-11-15" → "15 November 2026"
 */
function format_tanggal(string $tanggal): string
{
    $nama_bulan = [
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];

    $waktu = strtotime($tanggal);
    $hari  = date('j', $waktu);
    $bulan = (int) date('n', $waktu);
    $tahun = date('Y', $waktu);

    return "$hari {$nama_bulan[$bulan]} $tahun";
}

/**
 * Memformat waktu ke format Indonesia.
 * Contoh: "20:35:00" → "20.35 WIB"
 */
function format_waktu(string $tanggal_waktu): string
{
    $waktu = strtotime($tanggal_waktu);
    return date('H.i', $waktu) . ' WIB';
}

/**
 * Memformat tanggal dan waktu ke format Indonesia.
 * Contoh: "2026-11-15 20:35:00" → "15 November 2026, 20.35 WIB"
 */
function format_tanggal_waktu(string $tanggal_waktu): string
{
    return format_tanggal($tanggal_waktu) . ', ' . format_waktu($tanggal_waktu);
}
