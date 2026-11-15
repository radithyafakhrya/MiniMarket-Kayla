# 🎨 Dokumentasi Desain Antarmuka Pengguna (User Interface)

## Prinsip Kenyamanan untuk Semua Kalangan Usia

---

## 1. Pendahuluan

Dokumen ini berisi panduan lengkap untuk merancang antarmuka pengguna (User Interface / UI) pada sistem **Mesin Kasir Berbasis Web**. Desain ini dirancang agar **nyaman dan enak dilihat** oleh semua kalangan usia, mulai dari **anak muda** hingga **orang tua yang memerlukan kacamata untuk membaca**.

---

## 2. Prinsip Utama Desain

### 2.1 Mudah Dibaca (Readability)

- **Ukuran huruf minimum 16px** untuk teks biasa agar mudah dibaca tanpa harus mendekatkan wajah ke layar.
- **Ukuran huruf 20px–28px** untuk label harga, nama barang, dan total belanja.
- **Ukuran huruf 32px–48px** untuk angka total pembayaran dan kembalian.
- Menggunakan jenis huruf (font) yang **jelas dan tidak bersambung**, seperti:
  - `Inter` (utama)
  - `Segoe UI` (cadangan di Windows)
  - `sans-serif` (cadangan umum)
- **Tidak menggunakan** huruf miring (italic) untuk informasi penting.
- **Tidak menggunakan** huruf yang terlalu tipis (font-weight di bawah 400).

### 2.2 Kontras Tinggi

- Teks gelap di atas latar belakang terang.
- Rasio kontras minimal **4.5:1** untuk teks biasa (sesuai standar WCAG 2.1 AA).
- Rasio kontras minimal **3:1** untuk teks berukuran besar dan elemen interaktif.
- Tombol menggunakan warna latar yang **tegas dan jelas terlihat**.

### 2.3 Tata Letak Sederhana

- Setiap halaman hanya memiliki **satu tujuan utama** yang jelas.
- Tidak ada elemen dekoratif yang tidak perlu (tanpa animasi berlebihan, tanpa gambar latar belakang yang ramai).
- Jarak antar elemen (spacing) cukup lebar agar **tidak terasa sesak**.
- Menggunakan grid yang rapi dan konsisten.

### 2.4 Area Sentuh yang Lebar

- Semua tombol memiliki ukuran minimum **48px × 48px** (sesuai panduan aksesibilitas).
- Jarak antar tombol minimal **12px** agar tidak salah tekan.
- Tombol utama (seperti "Bayar") berukuran **lebih besar** dari tombol biasa.

---

## 3. Tipografi (Pengaturan Huruf)

### 3.1 Keluarga Huruf

```css
font-family: 'Inter', 'Segoe UI', system-ui, -apple-system, sans-serif;
```

### 3.2 Ukuran Huruf

| Elemen | Ukuran | Ketebalan | Keterangan |
|--------|--------|-----------|------------|
| Judul halaman | 28px | 700 (Tebal) | Contoh: "Halaman Kasir", "Daftar Barang" |
| Subjudul / Nama bagian | 22px | 600 (Agak Tebal) | Contoh: "Keranjang Belanja", "Kategori" |
| Nama barang di daftar | 18px | 600 (Agak Tebal) | Agar mudah dibaca saat memilih barang |
| Harga barang | 18px | 700 (Tebal) | Angka harga harus jelas dan tegas |
| Teks biasa / deskripsi | 16px | 400 (Normal) | Teks penjelasan, keterangan, dan label |
| Teks kecil (waktu, kode) | 14px | 400 (Normal) | Hanya untuk informasi tambahan yang tidak kritis |
| Total belanja | 36px | 700 (Tebal) | Angka besar agar terlihat jelas dari jarak jauh |
| Kembalian | 32px | 700 (Tebal) | Angka besar dengan warna hijau (sukses) |

### 3.3 Tinggi Baris (Line Height)

- Teks biasa: `line-height: 1.6` (memberi ruang napas antar baris).
- Judul: `line-height: 1.3`.
- Angka harga dan total: `line-height: 1.2`.

---

## 4. Tata Letak Halaman

### 4.1 Struktur Umum

```
┌──────────────────────────────────────────────────────┐
│                    BILAH ATAS (Header)                │
│  Logo / Nama Toko    │    Jam & Tanggal    │  Profil  │
├──────────┬───────────────────────────────────────────┤
│          │                                           │
│  MENU    │           AREA KONTEN UTAMA               │
│  SAMPING │                                           │
│  (Sidebar│    (Isi berubah sesuai halaman yang        │
│   kiri)  │     sedang dibuka)                        │
│          │                                           │
│          │                                           │
│          │                                           │
├──────────┴───────────────────────────────────────────┤
│                  BILAH BAWAH (Footer)                │
│           Informasi tambahan / versi sistem           │
└──────────────────────────────────────────────────────┘
```

### 4.2 Halaman Kasir (Transaksi)

```
┌──────────────────────────────────────────────────────┐
│                    BILAH ATAS                         │
├──────────┬──────────────────────┬────────────────────┤
│          │                      │                    │
│  MENU    │   DAFTAR BARANG      │  KERANJANG BELANJA │
│  SAMPING │                      │                    │
│          │  ┌──────┐ ┌──────┐  │  Barang 1  Rp xxx  │
│          │  │Barang│ │Barang│  │  Barang 2  Rp xxx  │
│          │  │  1   │ │  2   │  │  ──────────────── │
│          │  └──────┘ └──────┘  │  TOTAL:  Rp xxxxx  │
│          │  ┌──────┐ ┌──────┐  │                    │
│          │  │Barang│ │Barang│  │  [Uang Diterima]   │
│          │  │  3   │ │  4   │  │  Kembalian: Rp xx  │
│          │  └──────┘ └──────┘  │                    │
│          │                      │  ┌──────────────┐  │
│          │  [🔍 Cari barang...] │  │    BAYAR      │  │
│          │                      │  └──────────────┘  │
├──────────┴──────────────────────┴────────────────────┤
│                    BILAH BAWAH                       │
└──────────────────────────────────────────────────────┘
```

---

## 5. Komponen Antarmuka

### 5.1 Kartu Barang

- Ukuran kartu: minimal **160px × 140px** agar mudah ditekan.
- Menampilkan: **nama barang**, **harga**, dan **stok tersedia**.
- Sudut kartu membulat (`border-radius: 12px`) agar terkesan ramah.
- Bayangan halus (`box-shadow`) untuk membedakan kartu dari latar belakang.

### 5.2 Tombol Utama ("Bayar" / "Proses")

- Ukuran tinggi minimal: **56px**.
- Lebar penuh di dalam panel keranjang.
- Teks tombol berukuran **18px–20px** dan **tebal**.
- Warna latar: Deep Teal (`#0F766E`).
- Warna teks: Putih (`#FFFFFF`).
- Efek saat disentuh: warna berubah ke Vibrant Cyan (`#0D9488`).

### 5.3 Kolom Masukan (Input Field)

- Tinggi minimal: **48px**.
- Ukuran teks di dalam kolom: **16px**.
- Garis tepi yang jelas (`border: 2px solid #D1D5DB`).
- Saat kolom dipilih (fokus): garis tepi berubah menjadi Deep Teal (`#0F766E`).
- Label selalu terlihat di atas kolom (tidak hanya sebagai placeholder).

### 5.4 Tabel Data

- Tinggi setiap baris: minimal **48px**.
- Teks di dalam tabel: **16px**.
- Baris ganjil dan genap memiliki warna latar yang sedikit berbeda (zebra striping) agar mudah mengikuti baris.
- Garis pemisah antar baris yang jelas.

---

## 6. Aksesibilitas (Kemudahan Akses)

### 6.1 Untuk Pengguna Berusia Lanjut

| Kebutuhan | Solusi |
|-----------|--------|
| Sulit membaca huruf kecil | Ukuran huruf minimum 16px, huruf penting 18px ke atas |
| Sulit membedakan warna serupa | Kontras tinggi, tidak mengandalkan warna saja sebagai pembeda |
| Sulit menekan tombol kecil | Tombol minimal 48px × 48px dengan jarak antar tombol 12px |
| Bingung dengan tata letak rumit | Tata letak sederhana, satu halaman satu tujuan |
| Tidak terbiasa dengan istilah asing | Semua teks menggunakan Bahasa Indonesia yang mudah dipahami |

### 6.2 Untuk Pengguna Muda

| Kebutuhan | Solusi |
|-----------|--------|
| Ingin proses cepat | Pencarian barang instan, pintasan papan ketik |
| Tampilan modern | Desain bersih dan minimalis dengan warna yang enak dilihat |
| Responsif | Tampilan menyesuaikan ukuran layar (komputer, laptop, tablet) |

---

## 7. Responsivitas (Penyesuaian Layar)

| Ukuran Layar | Penyesuaian |
|--------------|-------------|
| **≥ 1280px** (Komputer) | Tata letak tiga kolom: menu samping + daftar barang + keranjang |
| **768px–1279px** (Laptop kecil / Tablet) | Tata letak dua kolom: daftar barang + keranjang (menu menjadi ikon di atas) |
| **< 768px** (Ponsel) | Tata letak satu kolom: bergantian antara daftar barang dan keranjang |

---

## 8. Animasi dan Transisi

- **Hanya menggunakan transisi halus** pada perubahan warna tombol saat disentuh (`transition: 0.2s ease`).
- **Tidak ada animasi yang berlebihan** seperti elemen berkedip, bergerak, atau memantul.
- **Tidak ada pop-up yang muncul tiba-tiba** — semua konfirmasi menggunakan area yang sudah terlihat di halaman.

---

## 9. Ikon

- Menggunakan ikon **garis sederhana** (outline icons), bukan ikon yang terlalu detail.
- Setiap ikon **selalu disertai teks label** agar tidak membingungkan.
- Contoh:
  - 🏠 Beranda
  - 🛒 Kasir
  - 📦 Barang
  - 📊 Laporan
  - ⚙️ Pengaturan

---

> **Catatan:** Semua ukuran dan jarak dalam dokumen ini adalah nilai minimum. Boleh diperbesar, tetapi **tidak boleh diperkecil** demi kenyamanan semua pengguna.

