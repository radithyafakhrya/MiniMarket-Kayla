# 💻 Dokumentasi Panduan Bahasa Pemrograman

## Penggunaan PHP sebagai Bahasa Utama dan Satu-satunya

---

## 1. Pendahuluan

Dokumen ini menjelaskan keputusan teknis mengenai **bahasa pemrograman** yang digunakan dalam proyek Mesin Kasir Berbasis Web. Proyek ini menggunakan **PHP** sebagai bahasa pemrograman **utama dan satu-satunya** untuk seluruh logika sistem, baik di sisi tampilan (frontend) maupun di sisi server (backend).

---

## 2. Alasan Pemilihan PHP

### 2.1 Mengapa PHP?

| No | Alasan | Penjelasan |
|----|--------|------------|
| 1 | **Mudah dipelajari** | PHP memiliki sintaksis yang sederhana dan banyak dokumentasi dalam Bahasa Indonesia. |
| 2 | **Tidak perlu kompilasi** | Kode PHP langsung bisa dijalankan tanpa proses kompilasi yang rumit. |
| 3 | **Berjalan di mana saja** | PHP dapat berjalan di Windows, Linux, dan macOS menggunakan XAMPP, Laragon, atau sejenisnya. |
| 4 | **Gratis dan terbuka** | PHP adalah perangkat lunak sumber terbuka (open source) yang tidak memerlukan biaya lisensi. |
| 5 | **Terintegrasi dengan MySQL** | PHP memiliki dukungan bawaan untuk basis data MySQL/MariaDB. |
| 6 | **Cocok untuk hosting** | PHP didukung oleh hampir semua layanan hosting (InfinityFree, 000WebHost, Niagahoster, dan lain-lain) dengan biaya yang sangat terjangkau bahkan gratis. |
| 7 | **Komunitas besar** | Jika ada kendala, mudah mencari solusi karena komunitas PHP sangat besar. |

### 2.2 Mengapa Hanya PHP?

| No | Alasan | Penjelasan |
|----|--------|------------|
| 1 | **Konsistensi** | Dengan satu bahasa, seluruh kode lebih mudah dipahami dan dirawat. |
| 2 | **Kesederhanaan** | Tidak perlu mempelajari atau mengatur banyak bahasa dan kerangka kerja (framework). |
| 3 | **Kemudahan perawatan** | Siapa pun yang memahami PHP bisa merawat dan mengembangkan sistem ini. |
| 4 | **PHP sudah cukup** | Untuk kebutuhan sistem kasir toko kelontong, kemampuan PHP sudah lebih dari memadai. |

---

## 3. Arsitektur Teknologi

### 3.1 Tumpukan Teknologi (Tech Stack)

```
┌─────────────────────────────────────────────┐
│              PERAMBAN (Browser)              │
│         Chrome / Firefox / Edge              │
├─────────────────────────────────────────────┤
│                                             │
│   HTML  ──  dihasilkan oleh PHP             │
│   CSS   ──  berkas .css biasa (statis)      │
│                                             │
├─────────────────────────────────────────────┤
│          SERVER WEB (Hosting Online)        │
│    Apache / LiteSpeed (dari penyedia        │
│    hosting seperti InfinityFree, dll.)      │
│    atau lokal: XAMPP / Laragon              │
├─────────────────────────────────────────────┤
│                                             │
│         PHP 8.x (Logika Sistem)             │
│                                             │
├─────────────────────────────────────────────┤
│             BASIS DATA                      │
│        MySQL / MariaDB                      │
└─────────────────────────────────────────────┘
```

### 3.2 Penjelasan Setiap Lapisan

| Lapisan | Teknologi | Keterangan |
|---------|-----------|------------|
| **Tampilan (Frontend)** | HTML + CSS | HTML dihasilkan oleh PHP menggunakan templat. CSS disimpan sebagai berkas terpisah. |
| **Logika Aplikasi** | PHP 8.x | Semua proses — mulai dari menampilkan halaman, memproses formulir, menghitung transaksi, hingga menghasilkan laporan — dilakukan oleh PHP. |
| **Basis Data** | MySQL / MariaDB | Menyimpan data barang, transaksi, pengguna, dan pengaturan. Diakses melalui PHP menggunakan PDO. |
| **Server Web** | Apache / LiteSpeed | Menerima permintaan dari peramban dan meneruskannya ke PHP. Tersedia di layanan hosting online maupun di XAMPP/Laragon untuk pengembangan lokal. |

---

## 4. Struktur Proyek

```
test kasir/
│
├── doc/                        ← Dokumentasi proyek (Anda sedang di sini)
│
├── public/                     ← Berkas yang bisa diakses oleh peramban
│   ├── index.php               ← Halaman utama (titik masuk)
│   ├── css/
│   │   └── style.css           ← Berkas gaya tampilan
│   └── gambar/
│       └── logo.png            ← Gambar logo toko (jika ada)
│
├── app/                        ← Logika aplikasi (tidak diakses langsung)
│   ├── config/
│   │   └── database.php        ← Pengaturan koneksi basis data
│   ├── helpers/
│   │   └── fungsi.php          ← Fungsi-fungsi bantuan (format harga, dll.)
│   ├── models/
│   │   ├── Barang.php          ← Model untuk data barang
│   │   ├── Transaksi.php       ← Model untuk data transaksi
│   │   └── Pengguna.php        ← Model untuk data pengguna
│   ├── controllers/
│   │   ├── KasirController.php     ← Logika halaman kasir
│   │   ├── BarangController.php    ← Logika halaman barang
│   │   ├── LaporanController.php   ← Logika halaman laporan
│   │   └── AuthController.php      ← Logika masuk/keluar
│   └── views/
│       ├── layouts/
│       │   ├── header.php      ← Bagian atas halaman (bilah atas)
│       │   ├── sidebar.php     ← Menu samping
│       │   └── footer.php      ← Bagian bawah halaman
│       ├── kasir/
│       │   └── index.php       ← Tampilan halaman kasir
│       ├── barang/
│       │   ├── daftar.php      ← Tampilan daftar barang
│       │   ├── tambah.php      ← Tampilan formulir tambah barang
│       │   └── ubah.php        ← Tampilan formulir ubah barang
│       ├── laporan/
│       │   └── index.php       ← Tampilan halaman laporan
│       └── auth/
│           └── masuk.php       ← Tampilan halaman masuk (login)
│
└── database/
    └── skema.sql               ← Berkas SQL untuk membuat tabel-tabel
```

---

## 5. Standar Penulisan Kode PHP

### 5.1 Versi PHP

- Menggunakan **PHP 8.0 atau yang lebih baru**.
- Memanfaatkan fitur-fitur modern PHP seperti `match`, `named arguments`, dan `null safe operator` jika diperlukan.

### 5.2 Aturan Penamaan

| Jenis | Aturan | Contoh |
|-------|--------|--------|
| Variabel | huruf kecil dengan garis bawah (snake_case) | `$nama_barang`, `$total_harga` |
| Fungsi | huruf kecil dengan garis bawah (snake_case) | `hitung_total()`, `ambil_semua_barang()` |
| Kelas (Class) | huruf besar di awal setiap kata (PascalCase) | `Barang`, `TransaksiController` |
| Konstanta | huruf besar semua dengan garis bawah | `HARGA_MINIMUM`, `BATAS_STOK` |
| Berkas | huruf kecil dengan garis bawah | `kasir_controller.php`, `daftar_barang.php` |

### 5.3 Penamaan dalam Bahasa Indonesia

Karena sistem ini ditujukan untuk pengguna Indonesia dan agar konsisten dengan panduan bahasa antarmuka, **penamaan variabel, fungsi, dan kelas boleh menggunakan Bahasa Indonesia**:

```php
// ✅ Diperbolehkan (Bahasa Indonesia)
$nama_barang = "Beras 5kg";
$harga_jual = 75000;
$jumlah_stok = 50;

function hitung_kembalian($uang_diterima, $total_belanja) {
    return $uang_diterima - $total_belanja;
}

function format_rupiah($angka) {
    return 'Rp' . number_format($angka, 0, ',', '.');
}

// ✅ Juga diperbolehkan (Bahasa Inggris) jika lebih nyaman
$product_name = "Beras 5kg";
$selling_price = 75000;
```

### 5.4 Koneksi Basis Data

Selalu menggunakan **PDO** dengan prepared statements untuk keamanan:

```php
<?php
// app/config/database.php

$host   = 'localhost';
$dbname = 'kasir_toko';
$user   = 'root';
$pass   = '';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );
} catch (PDOException $e) {
    die("Maaf, tidak dapat terhubung ke basis data. Silakan periksa pengaturan.");
}
```

### 5.5 Contoh Pengambilan Data

```php
<?php
// Mengambil semua barang
function ambil_semua_barang($pdo) {
    $sql = "SELECT * FROM barang ORDER BY nama_barang ASC";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll();
}

// Mencari barang berdasarkan nama
function cari_barang($pdo, $kata_kunci) {
    $sql = "SELECT * FROM barang WHERE nama_barang LIKE :kata_kunci";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['kata_kunci' => '%' . $kata_kunci . '%']);
    return $stmt->fetchAll();
}

// Menyimpan transaksi baru
function simpan_transaksi($pdo, $data_transaksi) {
    $sql = "INSERT INTO transaksi (tanggal, total, uang_diterima, kembalian) 
            VALUES (:tanggal, :total, :uang_diterima, :kembalian)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'tanggal'        => date('Y-m-d H:i:s'),
        'total'          => $data_transaksi['total'],
        'uang_diterima'  => $data_transaksi['uang_diterima'],
        'kembalian'      => $data_transaksi['kembalian'],
    ]);
    return $pdo->lastInsertId();
}
```

---

## 6. Penanganan CSS (Tanpa JavaScript Framework)

Karena proyek ini **hanya menggunakan PHP**, tampilan (styling) ditangani sepenuhnya oleh **berkas CSS biasa** yang dimuat secara statis:

```php
<!-- Di dalam header.php -->
<link rel="stylesheet" href="/css/style.css">
```

### 6.1 Apa yang Ditangani CSS

- Tata letak halaman (layout).
- Warna, huruf, dan ukuran teks.
- Tampilan tombol, kartu, tabel, dan formulir.
- Responsivitas (penyesuaian ukuran layar).
- Efek hover pada tombol.

### 6.2 Interaktivitas Minimal Tanpa JavaScript

Beberapa interaksi sederhana bisa dilakukan **tanpa JavaScript**, cukup dengan PHP dan CSS:

| Interaksi | Cara Penanganan |
|-----------|-----------------|
| Menambah barang ke keranjang | Formulir PHP (`<form method="POST">`) — halaman dimuat ulang |
| Menghapus barang dari keranjang | Tautan atau formulir PHP — halaman dimuat ulang |
| Pencarian barang | Formulir PHP (`<form method="GET">`) — halaman dimuat ulang |
| Navigasi antar halaman | Tautan biasa (`<a href="...">`) |
| Menampilkan/menyembunyikan menu | CSS `:target` atau `:checked` (tanpa JavaScript) |

### 6.3 Jika Diperlukan JavaScript Minimal

Jika ada kebutuhan interaksi yang **tidak bisa** ditangani oleh PHP dan CSS saja (misalnya penghitungan kembalian secara langsung tanpa memuat ulang halaman), maka:

- **Boleh** menggunakan JavaScript **murni** (vanilla JavaScript).
- **Tidak boleh** menggunakan kerangka kerja JavaScript seperti React, Vue, Angular, jQuery, atau sejenisnya.
- JavaScript hanya digunakan untuk **keperluan yang sangat terbatas** dan ditulis langsung di dalam berkas PHP atau berkas `.js` terpisah yang sederhana.

```php
<!-- Contoh JavaScript minimal yang diperbolehkan -->
<script>
    // Menghitung kembalian secara langsung saat kasir mengetik
    const kolomUang = document.getElementById('uang-diterima');
    const tampilKembalian = document.getElementById('kembalian');
    const totalBelanja = <?php echo $total_belanja; ?>;

    kolomUang.addEventListener('input', function() {
        const uang = parseInt(this.value) || 0;
        const kembalian = uang - totalBelanja;
        if (kembalian >= 0) {
            tampilKembalian.textContent = 'Rp' + kembalian.toLocaleString('id-ID');
            tampilKembalian.style.color = '#15803D';
        } else {
            tampilKembalian.textContent = 'Uang belum cukup';
            tampilKembalian.style.color = '#B91C1C';
        }
    });
</script>
```

---

## 7. Pengelolaan Sesi (Session)

PHP menangani sesi pengguna menggunakan fitur bawaan `$_SESSION`:

```php
<?php
// Memulai sesi di setiap halaman
session_start();

// Menyimpan data pengguna setelah berhasil masuk
$_SESSION['pengguna_id']   = $pengguna['id'];
$_SESSION['pengguna_nama'] = $pengguna['nama'];
$_SESSION['pengguna_peran'] = $pengguna['peran']; // 'pemilik' atau 'kasir'

// Memeriksa apakah pengguna sudah masuk
function sudah_masuk() {
    return isset($_SESSION['pengguna_id']);
}

// Memeriksa apakah pengguna adalah pemilik
function adalah_pemilik() {
    return isset($_SESSION['pengguna_peran']) 
        && $_SESSION['pengguna_peran'] === 'pemilik';
}
```

---

## 8. Keamanan Dasar

| Aspek | Penanganan |
|-------|------------|
| **Injeksi SQL** | Selalu menggunakan PDO prepared statements. |
| **XSS (Cross-Site Scripting)** | Selalu menggunakan `htmlspecialchars()` saat menampilkan data dari pengguna. |
| **CSRF** | Menggunakan token CSRF pada setiap formulir. |
| **Kata Sandi** | Menyimpan kata sandi menggunakan `password_hash()` dan memverifikasi dengan `password_verify()`. |

```php
<?php
// Contoh: Menampilkan data dengan aman
echo htmlspecialchars($nama_barang, ENT_QUOTES, 'UTF-8');

// Contoh: Menyimpan kata sandi dengan aman
$kata_sandi_aman = password_hash($kata_sandi, PASSWORD_DEFAULT);

// Contoh: Memverifikasi kata sandi
if (password_verify($kata_sandi_masukan, $kata_sandi_tersimpan)) {
    // Kata sandi cocok
}
```

---

## 9. Lingkungan Pengembangan yang Disarankan

| Perangkat Lunak | Kegunaan | Catatan |
|-----------------|----------|---------|
| **XAMPP** atau **Laragon** | Server lokal (Apache + PHP + MySQL) | Laragon lebih ringan untuk Windows |
| **Visual Studio Code** | Penyunting kode (code editor) | Gratis dan ringan |
| **phpMyAdmin** | Pengelola basis data berbasis web | Sudah termasuk dalam XAMPP |
| **Google Chrome** | Peramban untuk menguji tampilan | DevTools untuk memeriksa CSS |

---

## 10. Ringkasan Teknologi

| Komponen | Teknologi | Versi Minimum |
|----------|-----------|---------------|
| Bahasa pemrograman | PHP | 8.0 |
| Basis data | MySQL / MariaDB | 5.7 / 10.4 |
| Server web | Apache | 2.4 |
| Tampilan | HTML5 + CSS3 | — |
| JavaScript | Vanilla JS (opsional, minimal) | — |
| Framework PHP | Tidak ada (PHP murni) | — |
| Framework CSS | Tidak ada (CSS murni) | — |
| Framework JS | Tidak ada | — |

---

> **Catatan:** Keputusan untuk menggunakan PHP murni tanpa kerangka kerja adalah keputusan yang disengaja demi kesederhanaan. Jika di masa depan proyek berkembang dan membutuhkan fitur yang lebih kompleks, migrasi ke kerangka kerja PHP seperti Laravel atau CodeIgniter dapat dipertimbangkan — tetapi untuk saat ini, PHP murni sudah lebih dari cukup untuk kebutuhan toko kelontong.

