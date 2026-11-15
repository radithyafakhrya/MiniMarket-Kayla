# 🔄 Dokumentasi Use Case dan Skenario Kesalahan

## Alur Penggunaan & Penanganan Kesalahan Sistem

---

## 1. Pendahuluan

Dokumen ini berisi daftar lengkap **use case** (alur penggunaan) dan **skenario kesalahan** yang mungkin terjadi pada sistem Mesin Kasir Berbasis Web. Setiap skenario dilengkapi dengan:

- **Kondisi awal** — situasi sebelum aksi dilakukan.
- **Aksi pengguna** — apa yang dilakukan oleh pengguna.
- **Hasil yang diharapkan** — apa yang seharusnya terjadi.
- **Pesan sistem** — teks yang ditampilkan kepada pengguna.

Dokumen ini menjadi acuan utama saat pengembangan dan pengujian sistem.

---

## 2. Use Case: Masuk ke Sistem (Login)

### UC-01: Pemilik Toko Berhasil Masuk

| Komponen | Keterangan |
|----------|------------|
| **Aktor** | Pemilik Toko |
| **Kondisi Awal** | Pengguna berada di halaman masuk (login). |
| **Aksi** | Mengisi nama pengguna dan kata sandi yang benar, lalu menekan tombol "Masuk". |
| **Hasil yang Diharapkan** | Sistem mengarahkan ke halaman Beranda dengan akses penuh (kasir, barang, laporan, pengaturan). |
| **Pesan Sistem** | "Selamat datang kembali, [Nama Pemilik]!" |

---

### UC-02: Kasir Berhasil Masuk

| Komponen | Keterangan |
|----------|------------|
| **Aktor** | Kasir |
| **Kondisi Awal** | Pengguna berada di halaman masuk (login). |
| **Aksi** | Mengisi nama pengguna dan kata sandi yang benar, lalu menekan tombol "Masuk". |
| **Hasil yang Diharapkan** | Sistem mengarahkan ke halaman Kasir. Menu yang tersedia hanya: Kasir, Stok Barang (lihat saja), dan Riwayat Transaksi hari ini. |
| **Pesan Sistem** | "Selamat datang kembali, [Nama Kasir]!" |

---

### ❌ UC-03: Kasir Mencoba Masuk dengan Akun Pemilik

| Komponen | Keterangan |
|----------|------------|
| **Aktor** | Kasir (mencoba menggunakan akun pemilik) |
| **Kondisi Awal** | Pengguna berada di halaman masuk (login). |
| **Aksi** | Mengisi nama pengguna milik pemilik toko tetapi memasukkan kata sandi yang salah atau menebak kata sandi. |
| **Hasil yang Diharapkan** | Sistem **menolak** akses. Tidak ada informasi apakah nama pengguna benar atau salah (untuk keamanan). Percobaan gagal dicatat di log sistem. |
| **Pesan Sistem** | "Maaf, nama pengguna atau kata sandi yang Anda masukkan tidak sesuai. Silakan coba lagi." |
| **Catatan Keamanan** | Pesan kesalahan **tidak boleh** menyebutkan secara spesifik apakah yang salah itu nama pengguna atau kata sandinya. Ini untuk mencegah pihak lain mengetahui nama pengguna yang valid. |

---

### ❌ UC-04: Kata Sandi Salah

| Komponen | Keterangan |
|----------|------------|
| **Aktor** | Siapa saja |
| **Kondisi Awal** | Pengguna berada di halaman masuk (login). |
| **Aksi** | Mengisi nama pengguna yang benar tetapi kata sandi yang salah. |
| **Hasil yang Diharapkan** | Sistem menolak akses. Kolom kata sandi dikosongkan. |
| **Pesan Sistem** | "Maaf, nama pengguna atau kata sandi yang Anda masukkan tidak sesuai. Silakan coba lagi." |

---

### ❌ UC-05: Nama Pengguna Tidak Terdaftar

| Komponen | Keterangan |
|----------|------------|
| **Aktor** | Siapa saja |
| **Kondisi Awal** | Pengguna berada di halaman masuk (login). |
| **Aksi** | Mengisi nama pengguna yang tidak terdaftar di sistem. |
| **Hasil yang Diharapkan** | Sistem menolak akses dengan pesan yang **sama** seperti kata sandi salah (untuk keamanan). |
| **Pesan Sistem** | "Maaf, nama pengguna atau kata sandi yang Anda masukkan tidak sesuai. Silakan coba lagi." |

---

### ❌ UC-06: Kolom Masuk Dikosongkan

| Komponen | Keterangan |
|----------|------------|
| **Aktor** | Siapa saja |
| **Kondisi Awal** | Pengguna berada di halaman masuk (login). |
| **Aksi** | Menekan tombol "Masuk" tanpa mengisi nama pengguna dan/atau kata sandi. |
| **Hasil yang Diharapkan** | Sistem tidak memproses dan menampilkan peringatan. |
| **Pesan Sistem** | "Mohon lengkapi semua kolom yang bertanda bintang (*)." |

---

### ❌ UC-07: Percobaan Masuk Berulang (Brute Force)

| Komponen | Keterangan |
|----------|------------|
| **Aktor** | Siapa saja |
| **Kondisi Awal** | Pengguna sudah gagal masuk sebanyak 5 kali berturut-turut. |
| **Aksi** | Mencoba masuk lagi untuk yang ke-6 kalinya. |
| **Hasil yang Diharapkan** | Sistem **mengunci** akses masuk untuk sementara waktu (15 menit). Tombol "Masuk" dinonaktifkan. |
| **Pesan Sistem** | "Maaf, terlalu banyak percobaan masuk yang gagal. Demi keamanan, silakan coba lagi setelah 15 menit." |

---

## 3. Use Case: Hak Akses dan Otorisasi

### ❌ UC-08: Kasir Mencoba Mengakses Halaman Kelola Barang

| Komponen | Keterangan |
|----------|------------|
| **Aktor** | Kasir |
| **Kondisi Awal** | Kasir sudah masuk ke sistem dengan akunnya sendiri. |
| **Aksi** | Kasir mencoba mengakses halaman "Daftar Barang" untuk menambah, mengubah, atau menghapus barang (misalnya dengan mengetik langsung alamat halaman di peramban). |
| **Hasil yang Diharapkan** | Sistem **menolak** akses dan mengarahkan kembali ke halaman Kasir. |
| **Pesan Sistem** | "Maaf, Anda tidak memiliki izin untuk mengakses halaman ini." |

---

### ❌ UC-09: Kasir Mencoba Mengakses Halaman Laporan

| Komponen | Keterangan |
|----------|------------|
| **Aktor** | Kasir |
| **Kondisi Awal** | Kasir sudah masuk ke sistem. |
| **Aksi** | Kasir mencoba membuka halaman "Laporan" penjualan (harian/mingguan/bulanan). |
| **Hasil yang Diharapkan** | Sistem **menolak** akses. Kasir hanya bisa melihat riwayat transaksi hari ini di halaman kasir. |
| **Pesan Sistem** | "Maaf, Anda tidak memiliki izin untuk mengakses halaman ini." |

---

### ❌ UC-10: Kasir Mencoba Mengakses Halaman Pengaturan Pengguna

| Komponen | Keterangan |
|----------|------------|
| **Aktor** | Kasir |
| **Kondisi Awal** | Kasir sudah masuk ke sistem. |
| **Aksi** | Kasir mencoba membuka halaman "Pengaturan" untuk melihat atau mengubah data pengguna lain. |
| **Hasil yang Diharapkan** | Sistem **menolak** akses. |
| **Pesan Sistem** | "Maaf, Anda tidak memiliki izin untuk mengakses halaman ini." |

---

### ❌ UC-11: Pengguna Belum Masuk Mencoba Mengakses Halaman Sistem

| Komponen | Keterangan |
|----------|------------|
| **Aktor** | Siapa saja (belum masuk/login) |
| **Kondisi Awal** | Pengguna belum masuk ke sistem. |
| **Aksi** | Mengetik langsung alamat halaman kasir, barang, laporan, atau halaman lainnya di peramban. |
| **Hasil yang Diharapkan** | Sistem **mengarahkan** ke halaman masuk (login). |
| **Pesan Sistem** | "Silakan masuk terlebih dahulu untuk menggunakan sistem ini." |

---

### ❌ UC-12: Sesi Pengguna Habis (Session Expired)

| Komponen | Keterangan |
|----------|------------|
| **Aktor** | Siapa saja (sudah masuk) |
| **Kondisi Awal** | Pengguna sudah masuk tetapi tidak aktif selama waktu tertentu (misalnya 30 menit). |
| **Aksi** | Pengguna mencoba melakukan aksi apa pun (klik tombol, buka halaman). |
| **Hasil yang Diharapkan** | Sistem mengarahkan ke halaman masuk. |
| **Pesan Sistem** | "Sesi Anda telah berakhir karena tidak ada aktivitas. Silakan masuk kembali." |

---

## 4. Use Case: Transaksi Penjualan

### UC-13: Transaksi Berhasil

| Komponen | Keterangan |
|----------|------------|
| **Aktor** | Kasir atau Pemilik Toko |
| **Kondisi Awal** | Pengguna berada di halaman Kasir. Keranjang belanja sudah berisi minimal 1 barang. |
| **Aksi** | Mengisi jumlah uang yang diterima dari pembeli (harus sama atau lebih besar dari total belanja), lalu menekan tombol "Bayar". |
| **Hasil yang Diharapkan** | Transaksi tersimpan ke basis data. Stok barang berkurang sesuai jumlah yang terjual. Struk ditampilkan. Keranjang dikosongkan. |
| **Pesan Sistem** | "Transaksi berhasil disimpan. Terima kasih!" |

---

### ❌ UC-14: Uang Diterima Kurang dari Total Belanja

| Komponen | Keterangan |
|----------|------------|
| **Aktor** | Kasir atau Pemilik Toko |
| **Kondisi Awal** | Pengguna berada di halaman Kasir. Total belanja Rp50.000. |
| **Aksi** | Mengisi jumlah uang diterima Rp30.000 (kurang dari total), lalu menekan tombol "Bayar". |
| **Hasil yang Diharapkan** | Sistem **tidak memproses** pembayaran. Tombol "Bayar" tetap tidak aktif selama uang diterima kurang dari total. |
| **Pesan Sistem** | "Uang yang diterima belum mencukupi. Kekurangan: Rp20.000." |

---

### ❌ UC-15: Keranjang Belanja Kosong Saat Menekan Bayar

| Komponen | Keterangan |
|----------|------------|
| **Aktor** | Kasir atau Pemilik Toko |
| **Kondisi Awal** | Pengguna berada di halaman Kasir. Keranjang belanja kosong. |
| **Aksi** | Menekan tombol "Bayar" tanpa ada barang di keranjang. |
| **Hasil yang Diharapkan** | Tombol "Bayar" dalam keadaan tidak aktif (disabled). Sistem tidak memproses apa pun. |
| **Pesan Sistem** | "Keranjang belanja masih kosong. Silakan pilih barang terlebih dahulu." |

---

### ❌ UC-16: Menambahkan Barang yang Stoknya Habis

| Komponen | Keterangan |
|----------|------------|
| **Aktor** | Kasir atau Pemilik Toko |
| **Kondisi Awal** | Pengguna berada di halaman Kasir. Stok barang "Gula Pasir 1kg" = 0. |
| **Aksi** | Mencoba menambahkan "Gula Pasir 1kg" ke keranjang belanja. |
| **Hasil yang Diharapkan** | Sistem **menolak** penambahan. Kartu barang ditandai "Stok Habis" dengan warna merah. |
| **Pesan Sistem** | "Maaf, stok barang Gula Pasir 1kg sudah habis." |

---

### ❌ UC-17: Menambahkan Barang Melebihi Stok Tersedia

| Komponen | Keterangan |
|----------|------------|
| **Aktor** | Kasir atau Pemilik Toko |
| **Kondisi Awal** | Stok "Minyak Goreng 1L" = 3 buah. Pengguna sudah menambahkan 3 ke keranjang. |
| **Aksi** | Mencoba menambahkan 1 lagi (total menjadi 4). |
| **Hasil yang Diharapkan** | Sistem **menolak** penambahan. Jumlah tetap 3. |
| **Pesan Sistem** | "Maaf, jumlah yang diminta melebihi stok tersedia. Stok Minyak Goreng 1L saat ini: 3 buah." |

---

### UC-18: Menghapus Barang dari Keranjang

| Komponen | Keterangan |
|----------|------------|
| **Aktor** | Kasir atau Pemilik Toko |
| **Kondisi Awal** | Keranjang belanja berisi beberapa barang. |
| **Aksi** | Menekan tombol hapus (❌) di samping salah satu barang di keranjang. |
| **Hasil yang Diharapkan** | Barang dihapus dari keranjang. Total belanja dihitung ulang. |
| **Pesan Sistem** | *(Tidak ada pesan — barang langsung hilang dari keranjang dan total diperbarui)* |

---

### UC-19: Membatalkan Seluruh Transaksi

| Komponen | Keterangan |
|----------|------------|
| **Aktor** | Kasir atau Pemilik Toko |
| **Kondisi Awal** | Keranjang belanja berisi beberapa barang. |
| **Aksi** | Menekan tombol "Batalkan Transaksi". |
| **Hasil yang Diharapkan** | Sistem menampilkan konfirmasi terlebih dahulu. Jika pengguna memilih "Ya, Batalkan", semua barang dihapus dari keranjang. |
| **Pesan Konfirmasi** | "Apakah Anda yakin ingin membatalkan transaksi ini? Semua barang di keranjang akan dihapus." |
| **Tombol Pilihan** | "Ya, Batalkan" dan "Kembali" |

---

## 5. Use Case: Manajemen Barang (Hanya Pemilik Toko)

### UC-20: Menambahkan Barang Baru

| Komponen | Keterangan |
|----------|------------|
| **Aktor** | Pemilik Toko |
| **Kondisi Awal** | Pemilik berada di halaman "Tambah Barang Baru". |
| **Aksi** | Mengisi nama barang, harga jual, jumlah stok awal, dan kategori, lalu menekan "Simpan". |
| **Hasil yang Diharapkan** | Barang baru tersimpan ke basis data. Pemilik diarahkan ke halaman daftar barang. |
| **Pesan Sistem** | "Barang berhasil ditambahkan ke daftar." |

---

### ❌ UC-21: Menambahkan Barang dengan Nama yang Sudah Ada

| Komponen | Keterangan |
|----------|------------|
| **Aktor** | Pemilik Toko |
| **Kondisi Awal** | Barang "Beras 5kg" sudah ada di daftar. |
| **Aksi** | Mencoba menambahkan barang baru dengan nama "Beras 5kg". |
| **Hasil yang Diharapkan** | Sistem **menolak** penyimpanan. |
| **Pesan Sistem** | "Maaf, barang dengan nama tersebut sudah terdaftar. Silakan gunakan nama yang berbeda atau perbarui barang yang sudah ada." |

---

### ❌ UC-22: Mengisi Harga dengan Angka Negatif atau Nol

| Komponen | Keterangan |
|----------|------------|
| **Aktor** | Pemilik Toko |
| **Kondisi Awal** | Pemilik berada di formulir tambah atau ubah barang. |
| **Aksi** | Mengisi harga jual dengan angka 0 atau angka negatif (-5000). |
| **Hasil yang Diharapkan** | Sistem **menolak** penyimpanan. |
| **Pesan Sistem** | "Mohon masukkan harga jual yang valid (harus lebih besar dari Rp0)." |

---

### ❌ UC-23: Mengisi Stok dengan Angka Negatif

| Komponen | Keterangan |
|----------|------------|
| **Aktor** | Pemilik Toko |
| **Kondisi Awal** | Pemilik berada di formulir tambah atau ubah barang. |
| **Aksi** | Mengisi jumlah stok dengan angka negatif (-10). |
| **Hasil yang Diharapkan** | Sistem **menolak** penyimpanan. |
| **Pesan Sistem** | "Mohon masukkan jumlah stok yang valid (tidak boleh kurang dari 0)." |

---

### ❌ UC-24: Kolom Wajib Tidak Diisi Saat Menambah Barang

| Komponen | Keterangan |
|----------|------------|
| **Aktor** | Pemilik Toko |
| **Kondisi Awal** | Pemilik berada di formulir tambah barang. |
| **Aksi** | Menekan "Simpan" tanpa mengisi nama barang atau harga jual. |
| **Hasil yang Diharapkan** | Sistem tidak memproses dan menandai kolom yang kosong. |
| **Pesan Sistem** | "Mohon lengkapi semua kolom yang bertanda bintang (*)." |

---

### UC-25: Menghapus Barang dari Daftar

| Komponen | Keterangan |
|----------|------------|
| **Aktor** | Pemilik Toko |
| **Kondisi Awal** | Pemilik berada di halaman daftar barang. |
| **Aksi** | Menekan tombol "Hapus" pada salah satu barang. |
| **Hasil yang Diharapkan** | Sistem menampilkan konfirmasi. Jika "Ya, Hapus" dipilih, barang dihapus dari daftar. |
| **Pesan Konfirmasi** | "Apakah Anda yakin ingin menghapus barang [nama barang] dari daftar? Tindakan ini tidak dapat dibatalkan." |
| **Pesan Setelah Hapus** | "Barang berhasil dihapus dari daftar." |

---

### ❌ UC-26: Menghapus Barang yang Masih Ada di Keranjang Aktif

| Komponen | Keterangan |
|----------|------------|
| **Aktor** | Pemilik Toko |
| **Kondisi Awal** | Barang "Sabun Mandi" sedang ada di dalam keranjang belanja transaksi yang belum selesai. |
| **Aksi** | Pemilik mencoba menghapus "Sabun Mandi" dari daftar barang. |
| **Hasil yang Diharapkan** | Sistem tetap memperbolehkan penghapusan, tetapi memberi peringatan tambahan. |
| **Pesan Sistem** | "Perhatian: Barang ini mungkin sedang dalam proses transaksi. Apakah Anda tetap ingin menghapusnya?" |

---

## 6. Use Case: Manajemen Stok

### UC-27: Peringatan Stok Menipis

| Komponen | Keterangan |
|----------|------------|
| **Aktor** | Sistem (otomatis) |
| **Kondisi Awal** | Stok barang "Teh Celup" turun menjadi 5 buah atau kurang (batas minimum stok). |
| **Aksi** | Sistem secara otomatis menampilkan peringatan. |
| **Hasil yang Diharapkan** | Kartu barang ditandai dengan warna kuning peringatan (Amber Gold). Ikon peringatan muncul. |
| **Pesan Sistem** | "Perhatian: Stok barang Teh Celup tinggal [jumlah] buah." |

---

### UC-28: Peringatan Stok Habis

| Komponen | Keterangan |
|----------|------------|
| **Aktor** | Sistem (otomatis) |
| **Kondisi Awal** | Stok barang turun menjadi 0 setelah transaksi. |
| **Aksi** | Sistem secara otomatis menandai barang. |
| **Hasil yang Diharapkan** | Kartu barang ditandai "Stok Habis" dengan warna merah (Crimson Red). Barang tidak bisa ditambahkan ke keranjang. |
| **Pesan di Kartu Barang** | "Stok Habis" |

---

## 7. Use Case: Laporan (Hanya Pemilik Toko)

### UC-29: Melihat Laporan Harian

| Komponen | Keterangan |
|----------|------------|
| **Aktor** | Pemilik Toko |
| **Kondisi Awal** | Pemilik berada di halaman Laporan. |
| **Aksi** | Memilih tanggal tertentu untuk melihat rekap penjualan. |
| **Hasil yang Diharapkan** | Sistem menampilkan daftar transaksi pada tanggal tersebut: waktu, daftar barang terjual, total per transaksi, dan total pendapatan hari itu. |

---

### UC-30: Melihat Laporan pada Periode Kosong

| Komponen | Keterangan |
|----------|------------|
| **Aktor** | Pemilik Toko |
| **Kondisi Awal** | Pemilik berada di halaman Laporan. |
| **Aksi** | Memilih periode yang tidak ada transaksinya. |
| **Hasil yang Diharapkan** | Sistem menampilkan pesan kosong tanpa error. |
| **Pesan Sistem** | "Belum ada data transaksi untuk periode ini." |

---

## 8. Use Case: Keluar dari Sistem (Logout)

### UC-31: Keluar dengan Benar

| Komponen | Keterangan |
|----------|------------|
| **Aktor** | Siapa saja (sudah masuk) |
| **Kondisi Awal** | Pengguna sudah masuk ke sistem. |
| **Aksi** | Menekan tombol "Keluar" di menu profil. |
| **Hasil yang Diharapkan** | Sistem menampilkan konfirmasi. Jika "Ya, Keluar" dipilih, sesi dihapus dan pengguna diarahkan ke halaman masuk. |
| **Pesan Konfirmasi** | "Apakah Anda yakin ingin keluar dari sistem?" |

---

### ❌ UC-32: Keluar Saat Ada Transaksi Belum Selesai

| Komponen | Keterangan |
|----------|------------|
| **Aktor** | Kasir atau Pemilik Toko |
| **Kondisi Awal** | Ada barang di keranjang belanja yang belum dibayar. |
| **Aksi** | Menekan tombol "Keluar". |
| **Hasil yang Diharapkan** | Sistem memberi peringatan bahwa ada transaksi yang belum selesai. |
| **Pesan Sistem** | "Perhatian: Anda masih memiliki transaksi yang belum selesai di keranjang. Apakah Anda tetap ingin keluar? Barang di keranjang akan dihapus." |
| **Tombol Pilihan** | "Ya, Keluar" dan "Kembali ke Kasir" |

---

## 9. Use Case: Pengelolaan Pengguna (Hanya Pemilik Toko)

### UC-33: Pemilik Menambahkan Akun Kasir Baru

| Komponen | Keterangan |
|----------|------------|
| **Aktor** | Pemilik Toko |
| **Kondisi Awal** | Pemilik berada di halaman Pengaturan > Pengguna. |
| **Aksi** | Mengisi nama lengkap, nama pengguna, dan kata sandi untuk kasir baru, lalu menekan "Simpan". |
| **Hasil yang Diharapkan** | Akun kasir baru tersimpan dengan peran "kasir". |
| **Pesan Sistem** | "Akun kasir baru berhasil ditambahkan." |

---

### ❌ UC-34: Menambahkan Akun dengan Nama Pengguna yang Sudah Ada

| Komponen | Keterangan |
|----------|------------|
| **Aktor** | Pemilik Toko |
| **Kondisi Awal** | Nama pengguna "kasir_ani" sudah terdaftar. |
| **Aksi** | Mencoba membuat akun baru dengan nama pengguna "kasir_ani". |
| **Hasil yang Diharapkan** | Sistem **menolak** penyimpanan. |
| **Pesan Sistem** | "Maaf, nama pengguna tersebut sudah digunakan. Silakan pilih nama pengguna yang lain." |

---

### ❌ UC-35: Kata Sandi Terlalu Pendek

| Komponen | Keterangan |
|----------|------------|
| **Aktor** | Pemilik Toko |
| **Kondisi Awal** | Pemilik membuat akun kasir baru. |
| **Aksi** | Mengisi kata sandi hanya dengan 3 karakter ("abc"). |
| **Hasil yang Diharapkan** | Sistem **menolak** penyimpanan. |
| **Pesan Sistem** | "Kata sandi harus terdiri dari minimal 6 karakter." |

---

### UC-36: Pemilik Menghapus Akun Kasir

| Komponen | Keterangan |
|----------|------------|
| **Aktor** | Pemilik Toko |
| **Kondisi Awal** | Pemilik berada di halaman daftar pengguna. |
| **Aksi** | Menekan tombol "Hapus" pada akun kasir tertentu. |
| **Hasil yang Diharapkan** | Sistem menampilkan konfirmasi. Jika "Ya, Hapus" dipilih, akun kasir dihapus. Kasir tersebut tidak bisa masuk lagi. |
| **Pesan Konfirmasi** | "Apakah Anda yakin ingin menghapus akun kasir [nama kasir]?" |
| **Pesan Setelah Hapus** | "Akun kasir berhasil dihapus." |

---

### ❌ UC-37: Pemilik Mencoba Menghapus Akun Sendiri

| Komponen | Keterangan |
|----------|------------|
| **Aktor** | Pemilik Toko |
| **Kondisi Awal** | Pemilik berada di halaman daftar pengguna. |
| **Aksi** | Mencoba menghapus akun pemiliknya sendiri. |
| **Hasil yang Diharapkan** | Sistem **menolak** penghapusan. Tombol "Hapus" tidak ditampilkan pada akun pemilik. |
| **Pesan Sistem** | "Maaf, akun pemilik toko tidak dapat dihapus." |

---

## 10. Ringkasan Matriks Hak Akses

| Halaman / Fitur | Pemilik Toko | Kasir | Belum Masuk |
|------------------|:------------:|:-----:|:-----------:|
| Halaman Masuk (Login) | ✅ | ✅ | ✅ |
| Beranda | ✅ | ✅ | ❌ → Login |
| Halaman Kasir (Transaksi) | ✅ | ✅ | ❌ → Login |
| Daftar Barang (Lihat) | ✅ | ✅ (lihat saja) | ❌ → Login |
| Tambah / Ubah / Hapus Barang | ✅ | ❌ | ❌ → Login |
| Stok Barang | ✅ | ✅ (lihat saja) | ❌ → Login |
| Riwayat Transaksi Hari Ini | ✅ | ✅ | ❌ → Login |
| Laporan (Harian/Mingguan/Bulanan) | ✅ | ❌ | ❌ → Login |
| Kelola Pengguna | ✅ | ❌ | ❌ → Login |
| Pengaturan Sistem | ✅ | ❌ | ❌ → Login |

---

## 11. Ringkasan Kode Skenario

| Kode | Tipe | Deskripsi Singkat |
|------|------|-------------------|
| UC-01 | ✅ Sukses | Pemilik berhasil masuk |
| UC-02 | ✅ Sukses | Kasir berhasil masuk |
| UC-03 | ❌ Gagal | Kasir mencoba masuk dengan akun pemilik |
| UC-04 | ❌ Gagal | Kata sandi salah |
| UC-05 | ❌ Gagal | Nama pengguna tidak terdaftar |
| UC-06 | ❌ Gagal | Kolom masuk dikosongkan |
| UC-07 | ❌ Gagal | Percobaan masuk berulang (brute force) |
| UC-08 | ❌ Gagal | Kasir akses halaman kelola barang |
| UC-09 | ❌ Gagal | Kasir akses halaman laporan |
| UC-10 | ❌ Gagal | Kasir akses halaman pengaturan |
| UC-11 | ❌ Gagal | Belum login mengakses sistem |
| UC-12 | ❌ Gagal | Sesi habis |
| UC-13 | ✅ Sukses | Transaksi berhasil |
| UC-14 | ❌ Gagal | Uang kurang dari total |
| UC-15 | ❌ Gagal | Keranjang kosong saat bayar |
| UC-16 | ❌ Gagal | Tambah barang stok habis |
| UC-17 | ❌ Gagal | Tambah melebihi stok |
| UC-18 | ✅ Sukses | Hapus barang dari keranjang |
| UC-19 | ✅ Sukses | Batalkan seluruh transaksi |
| UC-20 | ✅ Sukses | Tambah barang baru |
| UC-21 | ❌ Gagal | Nama barang sudah ada |
| UC-22 | ❌ Gagal | Harga negatif atau nol |
| UC-23 | ❌ Gagal | Stok negatif |
| UC-24 | ❌ Gagal | Kolom wajib kosong |
| UC-25 | ✅ Sukses | Hapus barang dari daftar |
| UC-26 | ⚠️ Peringatan | Hapus barang yang ada di keranjang aktif |
| UC-27 | ⚠️ Peringatan | Stok menipis |
| UC-28 | ⚠️ Peringatan | Stok habis |
| UC-29 | ✅ Sukses | Lihat laporan harian |
| UC-30 | ✅ Sukses | Laporan periode kosong |
| UC-31 | ✅ Sukses | Keluar dari sistem |
| UC-32 | ⚠️ Peringatan | Keluar saat transaksi belum selesai |
| UC-33 | ✅ Sukses | Tambah akun kasir baru |
| UC-34 | ❌ Gagal | Nama pengguna sudah ada |
| UC-35 | ❌ Gagal | Kata sandi terlalu pendek |
| UC-36 | ✅ Sukses | Hapus akun kasir |
| UC-37 | ❌ Gagal | Pemilik hapus akun sendiri |

---

> **Catatan:** Daftar use case ini akan terus diperbarui seiring penambahan fitur baru. Setiap fitur baru yang dikembangkan **wajib** memiliki use case sukses dan skenario kesalahan yang terdokumentasi sebelum mulai dikerjakan.

