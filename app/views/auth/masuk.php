<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk — <?php echo e(NAMA_TOKO); ?></title>

    <!-- Gaya Huruf Inter dari Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* ============================================ */
        /* Variabel Warna Resmi (sesuai Dokumen 03)     */
        /* ============================================ */
        :root {
            --warna-latar:          #F4F6F8;
            --warna-kartu:          #FFFFFF;
            --warna-teks-utama:     #1A1D20;
            --warna-teks-sekunder:  #5A6573;
            --warna-utama:          #0F766E;
            --warna-hover:          #0D9488;
            --warna-sukses:         #15803D;
            --warna-peringatan:     #B45309;
            --warna-bahaya:         #B91C1C;
        }

        /* ============================================ */
        /* Tata Letak Dasar                             */
        /* ============================================ */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Segoe UI', system-ui, -apple-system, sans-serif;
            background-color: var(--warna-latar);
            color: var(--warna-teks-utama);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            line-height: 1.6;
        }

        /* ============================================ */
        /* Kontainer Masuk                              */
        /* ============================================ */
        .kontainer-masuk {
            width: 100%;
            max-width: 440px;
        }

        .kartu-masuk {
            background-color: var(--warna-kartu);
            border-radius: 16px;
            padding: 40px 36px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
            border: 1px solid #E5E7EB;
        }

        /* ============================================ */
        /* Judul & Deskripsi                            */
        /* ============================================ */
        .judul-masuk {
            font-size: 28px;
            font-weight: 700;
            color: var(--warna-teks-utama);
            text-align: center;
            margin-bottom: 8px;
            line-height: 1.3;
        }

        .nama-toko {
            font-size: 18px;
            font-weight: 600;
            color: var(--warna-utama);
            text-align: center;
            margin-bottom: 8px;
        }

        .deskripsi-masuk {
            font-size: 16px;
            color: var(--warna-teks-sekunder);
            text-align: center;
            margin-bottom: 32px;
        }

        /* ============================================ */
        /* Formulir                                     */
        /* ============================================ */
        .kelompok-kolom {
            margin-bottom: 20px;
        }

        .label-kolom {
            display: block;
            font-size: 16px;
            font-weight: 600;
            color: var(--warna-teks-utama);
            margin-bottom: 8px;
        }

        .label-kolom .wajib {
            color: var(--warna-bahaya);
        }

        .kolom-isian {
            width: 100%;
            height: 52px;
            padding: 0 16px;
            font-size: 16px;
            font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
            color: var(--warna-teks-utama);
            background-color: var(--warna-kartu);
            border: 2px solid #D1D5DB;
            border-radius: 10px;
            outline: none;
            transition: border-color 0.2s ease;
        }

        .kolom-isian::placeholder {
            color: #9CA3AF;
        }

        .kolom-isian:focus {
            border-color: var(--warna-utama);
        }

        /* ============================================ */
        /* Tombol Masuk                                 */
        /* ============================================ */
        .tombol-masuk {
            width: 100%;
            height: 56px;
            font-size: 18px;
            font-weight: 600;
            font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
            color: #FFFFFF;
            background-color: var(--warna-utama);
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.2s ease;
            margin-top: 8px;
        }

        .tombol-masuk:hover {
            background-color: var(--warna-hover);
        }

        .tombol-masuk:active {
            transform: scale(0.99);
        }

        /* ============================================ */
        /* Pesan Kilat                                  */
        /* ============================================ */
        .pesan-kilat {
            padding: 14px 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 500;
        }

        /* ============================================ */
        /* Catatan Bawah                                */
        /* ============================================ */
        .catatan-bawah {
            text-align: center;
            margin-top: 24px;
            font-size: 14px;
            color: var(--warna-teks-sekunder);
        }
    </style>
</head>

<body>
    <div class="kontainer-masuk">
        <div class="kartu-masuk">

            <!-- Judul -->
            <div class="nama-toko"><?php echo e(NAMA_TOKO); ?></div>
            <h1 class="judul-masuk">Masuk ke Sistem</h1>
            <p class="deskripsi-masuk">Silakan masukkan nama pengguna dan kata sandi Anda untuk melanjutkan.</p>

            <!-- Pesan Kilat -->
            <?php echo tampilkan_pesan_kilat(); ?>

            <!-- Formulir Masuk -->
            <form method="POST" action="index.php?halaman=masuk&aksi=proses">
                <?php echo kolom_csrf(); ?>

                <!-- Nama Pengguna -->
                <div class="kelompok-kolom">
                    <label class="label-kolom" for="nama_pengguna">
                        Nama Pengguna <span class="wajib">*</span>
                    </label>
                    <input
                        type="text"
                        id="nama_pengguna"
                        name="nama_pengguna"
                        class="kolom-isian"
                        placeholder="Masukkan nama pengguna Anda"
                        autocomplete="username"
                        required
                    >
                </div>

                <!-- Kata Sandi -->
                <div class="kelompok-kolom">
                    <label class="label-kolom" for="kata_sandi">
                        Kata Sandi <span class="wajib">*</span>
                    </label>
                    <input
                        type="password"
                        id="kata_sandi"
                        name="kata_sandi"
                        class="kolom-isian"
                        placeholder="Masukkan kata sandi Anda"
                        autocomplete="current-password"
                        required
                    >
                </div>

                <!-- Tombol Masuk -->
                <button type="submit" class="tombol-masuk">Masuk</button>
            </form>
        </div>

        <!-- Catatan -->
        <p class="catatan-bawah">
            <?php echo e(NAMA_TOKO); ?> — Sistem Kasir v<?php echo e(VERSI_SISTEM); ?>
        </p>
    </div>
</body>
</html>
