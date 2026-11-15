# 📋 Dokumentasi Gambaran Umum Proyek

## Mesin Kasir Berbasis Web — Toko Kelontong

---

## 1. Pendahuluan

Dokumen ini menjelaskan secara menyeluruh tentang proyek **Mesin Kasir Berbasis Web** yang dirancang khusus untuk kebutuhan **toko kelontong**. Sistem ini bertujuan menggantikan pencatatan manual dengan sistem digital yang mudah digunakan, cepat, dan dapat diandalkan oleh siapa saja — termasuk pemilik toko yang sudah berusia lanjut.

---

## 2. Latar Belakang

Banyak toko kelontong di Indonesia masih menggunakan catatan tangan atau kalkulator untuk menghitung transaksi. Hal ini rentan terhadap:

- **Kesalahan hitung** saat transaksi ramai.
- **Kehilangan data** penjualan harian.
- **Kesulitan memantau stok** barang dagangan.
- **Tidak ada rekap** pendapatan secara otomatis.

Dengan adanya mesin kasir berbasis web ini, semua masalah di atas dapat diatasi dengan cara yang **sederhana dan ramah pengguna**.

---

## 3. Tujuan Proyek

| No | Tujuan | Keterangan |
|----|--------|------------|
| 1 | **Mempermudah transaksi** | Kasir tinggal memilih barang, jumlah, dan sistem menghitung otomatis. |
| 2 | **Mencatat penjualan** | Setiap transaksi tersimpan rapi beserta tanggal dan waktunya. |
| 3 | **Mengelola stok barang** | Stok otomatis berkurang setiap ada penjualan, dan ada peringatan saat stok menipis. |
| 4 | **Rekap laporan** | Laporan harian, mingguan, dan bulanan tersedia otomatis. |
| 5 | **Mudah digunakan** | Antarmuka dirancang agar bisa dipakai oleh semua kalangan usia. |

---

## 4. Ruang Lingkup Sistem

### 4.1 Fitur Utama

1. **Transaksi Penjualan**
   - Pencarian dan pemilihan barang dagangan.
   - Penambahan barang ke keranjang belanja.
   - Penghitungan total belanja secara otomatis.
   - Penghitungan kembalian secara otomatis.
   - Pencetakan atau tampilan struk belanja.

2. **Manajemen Barang Dagangan**
   - Penambahan barang baru beserta harga jual.
   - Perubahan harga barang.
   - Penghapusan barang yang sudah tidak dijual.
   - Pengelompokan barang berdasarkan kategori (misalnya: makanan ringan, minuman, kebutuhan pokok, dan lain-lain).

3. **Manajemen Stok**
   - Pencatatan jumlah stok setiap barang.
   - Pengurangan stok otomatis setelah transaksi berhasil.
   - Peringatan saat stok barang menipis.
   - Peringatan saat stok barang habis.

4. **Laporan Penjualan**
   - Rekap penjualan harian.
   - Rekap penjualan mingguan.
   - Rekap penjualan bulanan.
   - Total pendapatan dalam periode tertentu.

5. **Pengaturan Pengguna**
   - Akun pemilik toko (mempunyai akses penuh).
   - Akun kasir (hanya bisa melakukan transaksi dan melihat stok).

---

### 4.2 Fitur Pendukung

- **Pencarian barang** berdasarkan nama atau kategori.
- **Riwayat transaksi** yang bisa dilihat kapan saja.
- **Tampilan jam dan tanggal** pada halaman kasir.

---

## 5. Pengguna Sistem

| Peran | Hak Akses |
|-------|-----------|
| **Pemilik Toko** | Mengelola barang, melihat laporan, mengatur akun kasir, melakukan transaksi. |
| **Kasir** | Melakukan transaksi penjualan, melihat stok barang, melihat riwayat transaksi hari ini. |

---

## 6. Alur Kerja Utama (Transaksi)

```
┌─────────────────┐
│  Kasir membuka   │
│  halaman kasir   │
└───────┬─────────┘
        │
        ▼
┌─────────────────┐
│  Mencari atau    │
│  memilih barang  │
└───────┬─────────┘
        │
        ▼
┌─────────────────┐
│  Barang masuk    │
│  ke keranjang    │
└───────┬─────────┘
        │
        ▼
┌─────────────────────────┐
│  Kasir mengisi jumlah    │
│  uang yang diterima      │
└───────┬─────────────────┘
        │
        ▼
┌─────────────────────────┐
│  Sistem menghitung       │
│  kembalian secara        │
│  otomatis                │
└───────┬─────────────────┘
        │
        ▼
┌─────────────────────────┐
│  Kasir menekan tombol    │
│  "Bayar"                 │
└───────┬─────────────────┘
        │
        ▼
┌─────────────────────────┐
│  Transaksi tersimpan,    │
│  stok berkurang,         │
│  struk ditampilkan       │
└─────────────────────────┘
```

---

## 7. Kebutuhan Perangkat

| Komponen | Keterangan |
|----------|------------|
| **Perangkat** | Komputer, laptop, atau tablet yang memiliki peramban (browser). |
| **Peramban** | Google Chrome, Mozilla Firefox, Microsoft Edge, atau peramban modern lainnya. |
| **Server** | Server PHP yang mendukung hosting online seperti InfinityFree, 000WebHost, atau layanan hosting PHP lainnya. Untuk pengembangan lokal bisa menggunakan XAMPP atau Laragon. |
| **Basis Data** | MySQL atau MariaDB (tersedia di layanan hosting maupun di XAMPP/Laragon untuk lokal). |
| **Jaringan** | Memerlukan koneksi internet karena sistem akan di-hosting secara online agar bisa diakses dari mana saja. |

---

## 8. Batasan Proyek

- Sistem ini dirancang untuk **satu toko** (bukan sistem multi-cabang).
- Sistem akan di-**hosting secara online** agar bisa diakses dari perangkat mana saja yang terhubung internet.
- Untuk pengembangan dan pengujian, sistem juga bisa dijalankan secara **lokal** menggunakan XAMPP atau Laragon.
- Sistem **tidak** memproses pembayaran digital (e-wallet, QRIS, dan sebagainya) — hanya mencatat transaksi tunai.
- Sistem menggunakan **bahasa Indonesia** sepenuhnya.

---

## 9. Jadwal Pengembangan (Rencana)

| Tahap | Kegiatan | Perkiraan Waktu |
|-------|----------|-----------------|
| 1 | Perancangan basis data dan struktur proyek | 2–3 hari |
| 2 | Pembuatan halaman masuk (login) | 1–2 hari |
| 3 | Pembuatan halaman kasir (transaksi) | 3–5 hari |
| 4 | Pembuatan halaman manajemen barang | 2–3 hari |
| 5 | Pembuatan halaman laporan | 2–3 hari |
| 6 | Pengujian dan perbaikan | 2–3 hari |

---

> **Catatan:** Dokumen ini akan diperbarui seiring perkembangan proyek.

