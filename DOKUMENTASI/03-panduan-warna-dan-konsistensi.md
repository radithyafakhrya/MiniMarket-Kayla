# 🎨 Dokumentasi Panduan Warna dan Konsistensi Antarmuka

## Aturan Warna Resmi & Konsistensi Visual

---

## 1. Pendahuluan

Dokumen ini menetapkan **aturan warna resmi** dan **prinsip konsistensi visual** untuk seluruh halaman pada sistem Mesin Kasir Berbasis Web. Semua pengembang dan perancang **wajib mengikuti panduan ini tanpa pengecualian**.

> ⚠️ **PERATURAN PENTING:**
> - **TIDAK BOLEH** menambahkan warna baru di luar daftar yang tercantum dalam dokumen ini.
> - **TIDAK BOLEH** mengubah nilai warna yang sudah ditetapkan.
> - **TIDAK BOLEH** menambahkan desain, ornamen, atau elemen dekoratif di luar panduan ini.
> - Semua halaman **HARUS** terlihat seragam dan konsisten dari segi warna, tata letak, dan gaya visual.

---

## 2. Palet Warna Resmi

### 2.1 Warna Dasar (Foundation Colors)

#### 🖼️ Background / Kanvas

| Properti | Nilai |
|----------|-------|
| **Nama** | Soft Off-White |
| **Kode Warna (Hex)** | `#F4F6F8` |
| **Kegunaan** | Latar belakang halaman utama. Warna ini dipilih karena mengurangi pantulan cahaya dan silau pada layar, sehingga nyaman untuk mata dalam penggunaan jangka panjang. |

```css
:root {
    --warna-latar: #F4F6F8;
}
body {
    background-color: var(--warna-latar);
}
```

---

#### 🃏 Card / Container

| Properti | Nilai |
|----------|-------|
| **Nama** | Pure White |
| **Kode Warna (Hex)** | `#FFFFFF` |
| **Kegunaan** | Latar belakang kartu produk, tabel transaksi, panel struk belanja, dan semua elemen kontainer. |

```css
:root {
    --warna-kartu: #FFFFFF;
}
.kartu, .panel, .tabel-container {
    background-color: var(--warna-kartu);
}
```

---

### 2.2 Warna Teks (Text Colors)

#### ✏️ Teks Utama

| Properti | Nilai |
|----------|-------|
| **Nama** | Deep Charcoal |
| **Kode Warna (Hex)** | `#1A1D20` |
| **Kegunaan** | Teks utama, label harga, nama produk, judul halaman. Kontras tinggi untuk kemudahan membaca. |

```css
:root {
    --warna-teks-utama: #1A1D20;
}
body {
    color: var(--warna-teks-utama);
}
```

---

#### 📝 Teks Sekunder

| Properti | Nilai |
|----------|-------|
| **Nama** | Slate Gray |
| **Kode Warna (Hex)** | `#5A6573` |
| **Kegunaan** | Teks deskripsi, nama kategori, keterangan waktu transaksi, dan informasi pendukung lainnya. |

```css
:root {
    --warna-teks-sekunder: #5A6573;
}
.teks-sekunder, .deskripsi, .waktu-transaksi {
    color: var(--warna-teks-sekunder);
}
```

---

### 2.3 Warna Interaktif (Interactive Colors)

#### 🟢 Primary — Aksi Utama

| Properti | Nilai |
|----------|-------|
| **Nama** | Deep Teal |
| **Kode Warna (Hex)** | `#0F766E` |
| **Kegunaan** | Tombol "Bayar", tombol "Proses", navigasi yang sedang aktif, ikon utama, dan semua elemen aksi utama. |

```css
:root {
    --warna-utama: #0F766E;
}
.tombol-utama, .navigasi-aktif {
    background-color: var(--warna-utama);
    color: #FFFFFF;
}
```

---

#### 🔵 Accent / Hover

| Properti | Nilai |
|----------|-------|
| **Nama** | Vibrant Cyan |
| **Kode Warna (Hex)** | `#0D9488` |
| **Kegunaan** | Warna saat tombol disentuh atau diarahkan kursor (hover), indikator elemen interaktif. |

```css
:root {
    --warna-hover: #0D9488;
}
.tombol-utama:hover, .tombol-utama:active {
    background-color: var(--warna-hover);
}
```

---

### 2.4 Warna Status (Status Colors)

#### ✅ Success — Pembayaran Berhasil

| Properti | Nilai |
|----------|-------|
| **Nama** | Emerald Green |
| **Kode Warna (Hex)** | `#15803D` |
| **Kegunaan** | Status pembayaran lunas, konfirmasi transaksi berhasil, tampilan jumlah kembalian. |

```css
:root {
    --warna-sukses: #15803D;
}
.status-lunas, .kembalian, .konfirmasi-sukses {
    color: var(--warna-sukses);
}
```

---

#### ⚠️ Warning — Peringatan

| Properti | Nilai |
|----------|-------|
| **Nama** | Amber Gold |
| **Kode Warna (Hex)** | `#B45309` |
| **Kegunaan** | Peringatan stok barang yang menipis, penanda diskon atau promosi, dan peringatan umum. |

```css
:root {
    --warna-peringatan: #B45309;
}
.stok-menipis, .diskon, .peringatan {
    color: var(--warna-peringatan);
}
```

---

#### ❌ Danger — Hapus / Batal

| Properti | Nilai |
|----------|-------|
| **Nama** | Crimson Red |
| **Kode Warna (Hex)** | `#B91C1C` |
| **Kegunaan** | Tombol hapus barang dari keranjang, tombol batal transaksi, penanda stok habis. |

```css
:root {
    --warna-bahaya: #B91C1C;
}
.tombol-hapus, .tombol-batal, .stok-habis {
    color: var(--warna-bahaya);
}
.tombol-hapus {
    background-color: var(--warna-bahaya);
    color: #FFFFFF;
}
```

---

## 3. Ringkasan Variabel CSS

Berikut adalah **satu-satunya** variabel warna yang boleh digunakan di seluruh proyek:

```css
:root {
    /* Warna Dasar */
    --warna-latar:          #F4F6F8;   /* Soft Off-White     */
    --warna-kartu:          #FFFFFF;   /* Pure White          */

    /* Warna Teks */
    --warna-teks-utama:     #1A1D20;   /* Deep Charcoal      */
    --warna-teks-sekunder:  #5A6573;   /* Slate Gray          */

    /* Warna Interaktif */
    --warna-utama:          #0F766E;   /* Deep Teal           */
    --warna-hover:          #0D9488;   /* Vibrant Cyan        */

    /* Warna Status */
    --warna-sukses:         #15803D;   /* Emerald Green       */
    --warna-peringatan:     #B45309;   /* Amber Gold          */
    --warna-bahaya:         #B91C1C;   /* Crimson Red         */
}
```

---

## 4. Visualisasi Palet Warna

```
┌─────────────────────────────────────────────────────────────┐
│                                                             │
│  ┌───────────┐  ┌───────────┐  ┌───────────┐               │
│  │           │  │           │  │           │               │
│  │  #F4F6F8  │  │  #FFFFFF  │  │  #1A1D20  │               │
│  │  Latar    │  │  Kartu    │  │  Teks     │               │
│  │           │  │           │  │  Utama    │               │
│  └───────────┘  └───────────┘  └───────────┘               │
│                                                             │
│  ┌───────────┐  ┌───────────┐  ┌───────────┐               │
│  │           │  │           │  │           │               │
│  │  #5A6573  │  │  #0F766E  │  │  #0D9488  │               │
│  │  Teks     │  │  Utama    │  │  Hover    │               │
│  │  Sekunder │  │  (Teal)   │  │  (Cyan)   │               │
│  └───────────┘  └───────────┘  └───────────┘               │
│                                                             │
│  ┌───────────┐  ┌───────────┐  ┌───────────┐               │
│  │           │  │           │  │           │               │
│  │  #15803D  │  │  #B45309  │  │  #B91C1C  │               │
│  │  Sukses   │  │  Peringat │  │  Bahaya   │               │
│  │  (Hijau)  │  │  (Kuning) │  │  (Merah)  │               │
│  └───────────┘  └───────────┘  └───────────┘               │
│                                                             │
└─────────────────────────────────────────────────────────────┘
```

---

## 5. Aturan Konsistensi Visual

### 5.1 Yang WAJIB Dilakukan

| No | Aturan |
|----|--------|
| 1 | Selalu gunakan variabel CSS (`var(--nama-warna)`) — **jangan** menulis kode warna langsung. |
| 2 | Semua halaman harus menggunakan tata letak yang **sama** (bilah atas, menu samping, area konten). |
| 3 | Semua tombol sejenis harus memiliki **bentuk, ukuran, dan warna yang sama** di semua halaman. |
| 4 | Semua kartu harus memiliki **sudut membulat, bayangan, dan jarak** yang sama. |
| 5 | Semua tabel harus menggunakan **gaya yang seragam** (zebra striping, ukuran baris, ukuran teks). |
| 6 | Semua ikon harus dari **satu sumber yang sama** (misalnya Heroicons atau Lucide Icons). |

### 5.2 Yang DILARANG

| No | Larangan |
|----|----------|
| 1 | **Dilarang** menambahkan warna baru di luar 9 warna yang sudah ditetapkan. |
| 2 | **Dilarang** mengubah nilai Hex dari warna yang sudah ada. |
| 3 | **Dilarang** menambahkan gradasi warna (gradient) pada elemen mana pun. |
| 4 | **Dilarang** menambahkan gambar latar belakang (background image). |
| 5 | **Dilarang** menambahkan bayangan berwarna (colored box-shadow). Bayangan hanya boleh berwarna abu-abu transparan. |
| 6 | **Dilarang** menggunakan gaya huruf (font) yang berbeda dari yang sudah ditetapkan. |
| 7 | **Dilarang** menambahkan animasi atau transisi selain yang sudah diatur (hanya transisi hover 0.2s). |
| 8 | **Dilarang** membuat tata letak halaman yang berbeda dari struktur standar. |

---

## 6. Contoh Penerapan

### 6.1 Tombol

```css
/* Tombol Utama (Bayar, Proses, Simpan) */
.tombol-utama {
    background-color: var(--warna-utama);
    color: #FFFFFF;
    border: none;
    border-radius: 10px;
    padding: 14px 28px;
    font-size: 18px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.2s ease;
}
.tombol-utama:hover {
    background-color: var(--warna-hover);
}

/* Tombol Bahaya (Hapus, Batal) */
.tombol-bahaya {
    background-color: var(--warna-bahaya);
    color: #FFFFFF;
    border: none;
    border-radius: 10px;
    padding: 14px 28px;
    font-size: 18px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.2s ease;
}

/* Tombol Sekunder (Kembali, Tutup) */
.tombol-sekunder {
    background-color: transparent;
    color: var(--warna-teks-sekunder);
    border: 2px solid #D1D5DB;
    border-radius: 10px;
    padding: 14px 28px;
    font-size: 18px;
    font-weight: 600;
    cursor: pointer;
    transition: border-color 0.2s ease;
}
.tombol-sekunder:hover {
    border-color: var(--warna-utama);
    color: var(--warna-utama);
}
```

### 6.2 Kartu Barang

```css
.kartu-barang {
    background-color: var(--warna-kartu);
    border-radius: 12px;
    padding: 16px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
    border: 1px solid #E5E7EB;
    cursor: pointer;
    transition: box-shadow 0.2s ease;
}
.kartu-barang:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
}
```

### 6.3 Garis Tepi (Border)

Satu-satunya warna garis tepi yang boleh digunakan:

```css
/* Garis tepi standar */
border: 1px solid #E5E7EB;

/* Garis tepi saat fokus */
border: 2px solid var(--warna-utama);
```

> **Catatan Penting:** Warna `#E5E7EB` dan `#D1D5DB` adalah turunan dari warna abu-abu netral yang digunakan **hanya** untuk garis tepi dan pemisah. Warna ini **bukan** warna tambahan, melainkan warna pendukung struktural yang tidak muncul sebagai elemen visual utama.

---

## 7. Daftar Periksa Konsistensi

Sebelum menyelesaikan setiap halaman, periksa hal-hal berikut:

- [ ] Apakah latar belakang halaman menggunakan `#F4F6F8`?
- [ ] Apakah semua kartu/panel menggunakan `#FFFFFF`?
- [ ] Apakah semua teks utama menggunakan `#1A1D20`?
- [ ] Apakah semua teks sekunder menggunakan `#5A6573`?
- [ ] Apakah tombol utama menggunakan `#0F766E` dengan hover `#0D9488`?
- [ ] Apakah semua status sukses menggunakan `#15803D`?
- [ ] Apakah semua peringatan menggunakan `#B45309`?
- [ ] Apakah semua elemen bahaya menggunakan `#B91C1C`?
- [ ] Apakah tidak ada warna lain yang digunakan?
- [ ] Apakah tata letak halaman sesuai dengan struktur standar?
- [ ] Apakah semua tombol memiliki bentuk dan ukuran yang konsisten?
- [ ] Apakah jenis huruf yang digunakan sesuai panduan?

---

> **Dokumen ini bersifat FINAL. Setiap perubahan warna atau penambahan elemen visual harus melalui persetujuan dan didokumentasikan terlebih dahulu di dalam dokumen ini.**

