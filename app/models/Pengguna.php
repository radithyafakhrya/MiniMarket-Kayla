<?php
// ============================================================
// MODEL PENGGUNA
// Berkas: app/models/Pengguna.php
// Penanggung Jawab: Radit
// ============================================================
// Berisi fungsi-fungsi untuk mengelola data pengguna di basis data.
// ============================================================

/**
 * Mengambil semua data pengguna.
 */
function ambil_semua_pengguna(PDO $pdo): array
{
    $sql  = "SELECT id, nama_lengkap, nama_pengguna, peran, dibuat_pada FROM pengguna ORDER BY peran ASC, nama_lengkap ASC";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll();
}

/**
 * Mengambil data pengguna berdasarkan ID.
 */
function ambil_pengguna_berdasarkan_id(PDO $pdo, int $id): ?array
{
    $sql  = "SELECT id, nama_lengkap, nama_pengguna, peran, dibuat_pada FROM pengguna WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    $hasil = $stmt->fetch();
    return $hasil ?: null;
}

/**
 * Mengambil data pengguna berdasarkan nama pengguna (untuk login).
 * Mengembalikan data lengkap termasuk kata sandi (untuk verifikasi).
 */
function ambil_pengguna_berdasarkan_nama(PDO $pdo, string $nama_pengguna): ?array
{
    $sql  = "SELECT * FROM pengguna WHERE nama_pengguna = :nama_pengguna";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['nama_pengguna' => $nama_pengguna]);
    $hasil = $stmt->fetch();
    return $hasil ?: null;
}

/**
 * Memeriksa apakah nama pengguna sudah digunakan.
 */
function nama_pengguna_sudah_ada(PDO $pdo, string $nama_pengguna, ?int $kecuali_id = null): bool
{
    if ($kecuali_id !== null) {
        $sql  = "SELECT COUNT(*) FROM pengguna WHERE nama_pengguna = :nama_pengguna AND id != :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['nama_pengguna' => $nama_pengguna, 'id' => $kecuali_id]);
    } else {
        $sql  = "SELECT COUNT(*) FROM pengguna WHERE nama_pengguna = :nama_pengguna";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['nama_pengguna' => $nama_pengguna]);
    }
    return $stmt->fetchColumn() > 0;
}

/**
 * Menambahkan pengguna baru.
 * Kata sandi otomatis di-hash menggunakan password_hash().
 */
function tambah_pengguna(PDO $pdo, string $nama_lengkap, string $nama_pengguna, string $kata_sandi, string $peran = 'kasir'): bool
{
    $sql = "INSERT INTO pengguna (nama_lengkap, nama_pengguna, kata_sandi, peran) 
            VALUES (:nama_lengkap, :nama_pengguna, :kata_sandi, :peran)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        'nama_lengkap'  => $nama_lengkap,
        'nama_pengguna' => $nama_pengguna,
        'kata_sandi'    => password_hash($kata_sandi, PASSWORD_DEFAULT),
        'peran'         => $peran,
    ]);
}

/**
 * Menghapus pengguna berdasarkan ID.
 * Tidak bisa menghapus akun pemilik toko.
 */
function hapus_pengguna(PDO $pdo, int $id): bool
{
    // Pastikan yang dihapus bukan pemilik
    $pengguna = ambil_pengguna_berdasarkan_id($pdo, $id);
    if ($pengguna === null || $pengguna['peran'] === 'pemilik') {
        return false;
    }

    $sql  = "DELETE FROM pengguna WHERE id = :id AND peran = 'kasir'";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute(['id' => $id]);
}

/**
 * Menghitung jumlah pengguna berdasarkan peran.
 */
function hitung_pengguna(PDO $pdo, ?string $peran = null): int
{
    if ($peran !== null) {
        $sql  = "SELECT COUNT(*) FROM pengguna WHERE peran = :peran";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['peran' => $peran]);
    } else {
        $sql  = "SELECT COUNT(*) FROM pengguna";
        $stmt = $pdo->query($sql);
    }
    return (int) $stmt->fetchColumn();
}

// ============================================================
// FUNGSI PERCOBAAN MASUK (Perlindungan Brute Force)
// ============================================================

/**
 * Menghitung percobaan masuk yang gagal dalam 15 menit terakhir.
 */
function hitung_percobaan_masuk(PDO $pdo, string $nama_pengguna, string $alamat_ip): int
{
    $sql = "SELECT COUNT(*) FROM percobaan_masuk 
            WHERE (nama_pengguna = :nama_pengguna OR alamat_ip = :alamat_ip)
            AND waktu_percobaan > DATE_SUB(NOW(), INTERVAL :menit MINUTE)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'nama_pengguna' => $nama_pengguna,
        'alamat_ip'     => $alamat_ip,
        'menit'         => DURASI_KUNCI_MENIT,
    ]);
    return (int) $stmt->fetchColumn();
}

/**
 * Mencatat percobaan masuk yang gagal.
 */
function catat_percobaan_masuk(PDO $pdo, string $nama_pengguna, string $alamat_ip): void
{
    $sql  = "INSERT INTO percobaan_masuk (nama_pengguna, alamat_ip) VALUES (:nama_pengguna, :alamat_ip)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'nama_pengguna' => $nama_pengguna,
        'alamat_ip'     => $alamat_ip,
    ]);
}

/**
 * Menghapus catatan percobaan masuk (setelah berhasil login).
 */
function hapus_percobaan_masuk(PDO $pdo, string $nama_pengguna, string $alamat_ip): void
{
    $sql  = "DELETE FROM percobaan_masuk WHERE nama_pengguna = :nama_pengguna OR alamat_ip = :alamat_ip";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'nama_pengguna' => $nama_pengguna,
        'alamat_ip'     => $alamat_ip,
    ]);
}

/**
 * Membersihkan catatan percobaan masuk yang sudah lama (lebih dari 1 jam).
 */
function bersihkan_percobaan_lama(PDO $pdo): void
{
    $sql = "DELETE FROM percobaan_masuk WHERE waktu_percobaan < DATE_SUB(NOW(), INTERVAL 1 HOUR)";
    $pdo->exec($sql);
}
