# 👥 Dokumentasi Pembagian Kerja Kelompok

## Tim Pengembang Mesin Kasir Berbasis Web

---

## 1. Anggota Kelompok

| No | Nama Lengkap | Panggilan |
|----|--------------|-----------|
| 1 | **Elfina** | Elfina |
| 2 | **Delia** | Delia |
| 3 | **Rafli** | Rafli |
| 4 | **Radit** | Radit |

---

## 2. Pembagian Peran Utama

| Anggota | Peran | Tanggung Jawab Umum |
|---------|-------|---------------------|
| **Radit** | Ketua Tim & Pengembang Autentikasi | Mengkoordinasi tim, membangun sistem masuk/keluar, dan mengelola hak akses pengguna. |
| **Delia** | Pengembang Antarmuka (Frontend) | Merancang dan membuat tampilan seluruh halaman sesuai panduan desain dan warna. |
| **Rafli** | Pengembang Transaksi & Kasir | Membangun logika transaksi penjualan, keranjang belanja, dan perhitungan pembayaran. |
| **Elfina** | Pengembang Barang, Stok & Laporan | Membangun fitur manajemen barang, pengelolaan stok, dan pembuatan laporan. |

---

## 3. Rincian Pembagian Kerja

### 3.1 Radit — Ketua Tim & Pengembang Autentikasi

#### Tugas Koordinasi
- Memastikan semua anggota bekerja sesuai jadwal.
- Menjadi penghubung antar anggota jika ada kendala.
- Memeriksa hasil kerja akhir sebelum digabungkan.
- Memastikan semua kode dan tampilan konsisten sesuai dokumentasi.

#### Tugas Pengembangan

| No | Tugas | Berkas Terkait | Keterangan |
|----|-------|----------------|------------|
| 1 | Membuat basis data dan tabel pengguna | `database/skema.sql` (bagian tabel `pengguna`) | Struktur tabel untuk menyimpan data akun pemilik dan kasir. |
| 2 | Membuat halaman masuk (login) | `app/views/auth/masuk.php` | Tampilan formulir masuk sesuai panduan desain. |
| 3 | Membuat logika masuk (login) | `app/controllers/AuthController.php` | Proses verifikasi nama pengguna dan kata sandi. |
| 4 | Membuat sistem sesi (session) | `app/controllers/AuthController.php` | Menyimpan data pengguna yang sedang masuk ke dalam sesi. |
| 5 | Membuat pengecekan hak akses | `app/helpers/fungsi.php` (bagian autentikasi) | Fungsi `sudah_masuk()`, `adalah_pemilik()`, dan pengalihan halaman jika tidak berhak. |
| 6 | Membuat fitur keluar (logout) | `app/controllers/AuthController.php` | Menghapus sesi dan mengarahkan ke halaman masuk. |
| 7 | Membuat pengaturan koneksi basis data | `app/config/database.php` | Koneksi PDO ke MySQL/MariaDB. |
| 8 | Membuat halaman kelola pengguna | (tambahan di `app/views/`) | Halaman untuk pemilik menambah/menghapus akun kasir. |
| 9 | Membuat model Pengguna | `app/models/Pengguna.php` | Fungsi-fungsi untuk mengambil, menambah, dan menghapus data pengguna. |
| 10 | Menerapkan keamanan (brute force, CSRF) | Seluruh formulir | Token CSRF dan pembatasan percobaan masuk. |

#### Referensi Dokumentasi
- [06-use-case-dan-skenario-kesalahan.md](file:///d:/test kasir/DOKUMENTASI/06-use-case-dan-skenario-kesalahan.md) → UC-01 s/d UC-12 (Login & Hak Akses), UC-31 s/d UC-37 (Logout & Pengguna)

---

### 3.2 Delia — Pengembang Antarmuka (Frontend)

#### Tugas Pengembangan

| No | Tugas | Berkas Terkait | Keterangan |
|----|-------|----------------|------------|
| 1 | Membuat berkas CSS utama | `public/css/style.css` | Seluruh gaya tampilan sesuai panduan warna dan desain (9 warna resmi, tipografi, dll.). |
| 2 | Membuat tata letak header | `app/views/layouts/header.php` | Bilah atas: logo/nama toko, jam & tanggal, profil pengguna. |
| 3 | Membuat tata letak sidebar | `app/views/layouts/sidebar.php` | Menu samping: navigasi ke Beranda, Kasir, Barang, Laporan, Pengaturan. |
| 4 | Membuat tata letak footer | `app/views/layouts/footer.php` | Bilah bawah: informasi versi sistem. |
| 5 | Membuat tampilan responsif | `public/css/style.css` | Penyesuaian layar untuk komputer, tablet, dan ponsel. |
| 6 | Membuat komponen tombol | `public/css/style.css` | Tombol utama, tombol bahaya, tombol sekunder sesuai panduan. |
| 7 | Membuat komponen kartu barang | `public/css/style.css` | Kartu produk dengan sudut membulat, bayangan halus, ukuran yang mudah ditekan. |
| 8 | Membuat komponen tabel | `public/css/style.css` | Tabel zebra striping, ukuran baris minimal 48px. |
| 9 | Membuat komponen formulir | `public/css/style.css` | Kolom masukan, label, garis tepi fokus. |
| 10 | Memastikan aksesibilitas | Seluruh tampilan | Ukuran huruf minimum 16px, kontras tinggi, area sentuh 48×48px. |

#### Referensi Dokumentasi
- [02-desain-antarmuka-pengguna.md](file:///d:/test kasir/doc/02-desain-antarmuka-pengguna.md) → Semua bagian
- [03-panduan-warna-dan-konsistensi.md](file:///d:/test kasir/doc/03-panduan-warna-dan-konsistensi.md) → Semua bagian
- [04-panduan-bahasa-antarmuka.md](file:///d:/test kasir/doc/04-panduan-bahasa-antarmuka.md) → Semua bagian (label, tombol, pesan)

---

### 3.3 Rafli — Pengembang Transaksi & Kasir

#### Tugas Pengembangan

| No | Tugas | Berkas Terkait | Keterangan |
|----|-------|----------------|------------|
| 1 | Membuat basis data tabel transaksi | `database/skema.sql` (bagian tabel `transaksi` dan `detail_transaksi`) | Struktur tabel untuk menyimpan data transaksi dan detail barang yang terjual. |
| 2 | Membuat halaman kasir (transaksi) | `app/views/kasir/index.php` | Tampilan daftar barang, keranjang belanja, total, uang diterima, kembalian. |
| 3 | Membuat logika kasir | `app/controllers/KasirController.php` | Proses menambah/menghapus barang di keranjang, menghitung total dan kembalian. |
| 4 | Membuat model Transaksi | `app/models/Transaksi.php` | Fungsi untuk menyimpan transaksi, mengambil riwayat, dan menghitung total. |
| 5 | Membuat fitur keranjang belanja | `app/controllers/KasirController.php` | Penyimpanan keranjang di sesi, penambahan/pengurangan jumlah, penghapusan barang. |
| 6 | Membuat fitur pembayaran | `app/controllers/KasirController.php` | Validasi uang diterima, perhitungan kembalian, penyimpanan transaksi ke basis data. |
| 7 | Membuat tampilan struk | `app/views/kasir/index.php` (bagian struk) | Tampilan struk belanja setelah pembayaran berhasil. |
| 8 | Membuat fitur pencarian barang | `app/controllers/KasirController.php` | Pencarian barang berdasarkan nama di halaman kasir. |
| 9 | Membuat fitur batal transaksi | `app/controllers/KasirController.php` | Mengosongkan keranjang setelah konfirmasi. |
| 10 | Membuat halaman utama (index) | `public/index.php` | Titik masuk aplikasi, pengaturan routing dasar. |
| 11 | Membuat fungsi bantuan | `app/helpers/fungsi.php` (bagian format) | Fungsi `format_rupiah()`, `format_tanggal()`, dan fungsi bantuan lainnya. |

#### Referensi Dokumentasi
- [06-use-case-dan-skenario-kesalahan.md](file:///d:/test kasir/doc/06-use-case-dan-skenario-kesalahan.md) → UC-13 s/d UC-19 (Transaksi Penjualan)

---

### 3.4 Elfina — Pengembang Barang, Stok & Laporan

#### Tugas Pengembangan

| No | Tugas | Berkas Terkait | Keterangan |
|----|-------|----------------|------------|
| 1 | Membuat basis data tabel barang dan kategori | `database/skema.sql` (bagian tabel `barang` dan `kategori`) | Struktur tabel untuk menyimpan data barang dan kategori. |
| 2 | Membuat halaman daftar barang | `app/views/barang/daftar.php` | Tampilan daftar seluruh barang dengan pencarian dan penyaringan. |
| 3 | Membuat halaman tambah barang | `app/views/barang/tambah.php` | Formulir untuk menambahkan barang baru. |
| 4 | Membuat halaman ubah barang | `app/views/barang/ubah.php` | Formulir untuk mengubah data barang yang sudah ada. |
| 5 | Membuat logika kelola barang | `app/controllers/BarangController.php` | Proses tambah, ubah, hapus, dan pencarian barang. |
| 6 | Membuat model Barang | `app/models/Barang.php` | Fungsi untuk mengambil, menambah, mengubah, menghapus, dan mencari data barang. |
| 7 | Membuat fitur pengelolaan stok | `app/controllers/BarangController.php` | Pengurangan stok otomatis saat transaksi, peringatan stok menipis dan habis. |
| 8 | Membuat halaman laporan | `app/views/laporan/index.php` | Tampilan rekap penjualan harian, mingguan, dan bulanan. |
| 9 | Membuat logika laporan | `app/controllers/LaporanController.php` | Proses pengambilan dan penghitungan data laporan berdasarkan periode. |
| 10 | Membuat validasi data barang | `app/controllers/BarangController.php` | Validasi nama duplikat, harga negatif/nol, stok negatif. |

#### Referensi Dokumentasi
- [06-use-case-dan-skenario-kesalahan.md](file:///d:/test kasir/DOKUMENTASI/06-use-case-dan-skenario-kesalahan.md) → UC-20 s/d UC-28 (Manajemen Barang & Stok), UC-29 s/d UC-30 (Laporan)

---

## 4. Peta Kepemilikan Berkas

| Berkas / Folder | Radit | Delia | Rafli | Elfina |
|-----------------|:-----:|:-----:|:-----:|:------:|
| `database/skema.sql` | ✏️ pengguna | — | ✏️ transaksi | ✏️ barang, kategori |
| `app/config/database.php` | ✅ | — | — | — |
| `app/helpers/fungsi.php` | ✏️ autentikasi | — | ✏️ format | — |
| `app/models/Pengguna.php` | ✅ | — | — | — |
| `app/models/Transaksi.php` | — | — | ✅ | — |
| `app/models/Barang.php` | — | — | — | ✅ |
| `app/controllers/AuthController.php` | ✅ | — | — | — |
| `app/controllers/KasirController.php` | — | — | ✅ | — |
| `app/controllers/BarangController.php` | — | — | — | ✅ |
| `app/controllers/LaporanController.php` | — | — | — | ✅ |
| `app/views/auth/masuk.php` | ✅ | 🎨 bantuan | — | — |
| `app/views/kasir/index.php` | — | 🎨 bantuan | ✅ | — |
| `app/views/barang/daftar.php` | — | 🎨 bantuan | — | ✅ |
| `app/views/barang/tambah.php` | — | 🎨 bantuan | — | ✅ |
| `app/views/barang/ubah.php` | — | 🎨 bantuan | — | ✅ |
| `app/views/laporan/index.php` | — | 🎨 bantuan | — | ✅ |
| `app/views/layouts/header.php` | — | ✅ | — | — |
| `app/views/layouts/sidebar.php` | — | ✅ | — | — |
| `app/views/layouts/footer.php` | — | ✅ | — | — |
| `public/index.php` | — | — | ✅ | — |
| `public/css/style.css` | — | ✅ | — | — |

**Keterangan:**
- ✅ = Penanggung jawab utama
- ✏️ = Mengerjakan sebagian dari berkas tersebut
- 🎨 = Membantu dari sisi tampilan/desain

---

## 5. Jadwal Kerja (Rencana)

### Tahap 1: Persiapan (Hari 1–2)

| Anggota | Kegiatan |
|---------|----------|
| **Radit** | Membuat `database/skema.sql` (tabel pengguna) dan `app/config/database.php`. |
| **Delia** | Membuat `public/css/style.css` (variabel warna, tipografi, komponen dasar). |
| **Rafli** | Membuat `database/skema.sql` (tabel transaksi) dan `public/index.php`. |
| **Elfina** | Membuat `database/skema.sql` (tabel barang, kategori). |

### Tahap 2: Komponen Dasar (Hari 3–5)

| Anggota | Kegiatan |
|---------|----------|
| **Radit** | Membuat sistem login, logout, sesi, dan pengecekan hak akses. |
| **Delia** | Membuat layout (header, sidebar, footer) dan CSS responsif. |
| **Rafli** | Membuat logika keranjang belanja dan fungsi bantuan (`format_rupiah`, dll.). |
| **Elfina** | Membuat model Barang dan logika tambah/ubah/hapus barang. |

### Tahap 3: Fitur Utama (Hari 6–10)

| Anggota | Kegiatan |
|---------|----------|
| **Radit** | Membuat halaman kelola pengguna dan keamanan (CSRF, brute force). |
| **Delia** | Membantu merapikan tampilan semua halaman yang sudah dibuat anggota lain. |
| **Rafli** | Membuat halaman kasir lengkap (pencarian, pembayaran, struk, batal transaksi). |
| **Elfina** | Membuat halaman daftar/tambah/ubah barang, pengelolaan stok, dan halaman laporan. |

### Tahap 4: Pengujian & Perbaikan (Hari 11–13)

| Anggota | Kegiatan |
|---------|----------|
| **Semua** | Menguji semua use case sesuai dokumen 06. Memperbaiki kesalahan yang ditemukan. Memastikan konsistensi tampilan dan bahasa. |

---

## 6. Aturan Kerja Tim

### 6.1 Komunikasi
- Setiap anggota **wajib melaporkan** kemajuan harian kepada Radit (ketua tim).
- Jika ada **kendala atau pertanyaan**, segera sampaikan ke grup agar bisa dibantu.
- Jangan mengubah berkas milik anggota lain **tanpa konfirmasi** terlebih dahulu.

### 6.2 Standar Kode
- Semua anggota **wajib mengikuti** panduan penulisan kode di [05-panduan-bahasa-pemrograman.md](file:///d:/test kasir/doc/05-panduan-bahasa-pemrograman.md).
- Semua teks antarmuka **wajib mengikuti** panduan bahasa di [04-panduan-bahasa-antarmuka.md](file:///d:/test kasir/doc/04-panduan-bahasa-antarmuka.md).
- Semua tampilan **wajib mengikuti** panduan warna di [03-panduan-warna-dan-konsistensi.md](file:///d:/test kasir/doc/03-panduan-warna-dan-konsistensi.md).

### 6.3 Penggabungan Kerja
- Setiap akhir tahap, semua anggota **menggabungkan** hasil kerja dan menguji bersama.
- Jika ada konflik (dua orang mengubah berkas yang sama), selesaikan bersama dengan koordinasi Radit.

---

> **Catatan:** Pembagian kerja ini bersifat fleksibel. Jika ada anggota yang sudah selesai lebih awal, diharapkan **membantu anggota lain** yang masih membutuhkan bantuan. Kerja sama tim adalah kunci keberhasilan proyek ini.
