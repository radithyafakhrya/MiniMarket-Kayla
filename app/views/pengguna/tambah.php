<!-- ============================================================ -->
<!-- HALAMAN TAMBAH KASIR BARU                                    -->
<!-- Berkas: app/views/pengguna/tambah.php                        -->
<!-- Penanggung Jawab: Radit                                      -->
<!-- Hanya bisa diakses oleh: Pemilik Toko                        -->
<!-- ============================================================ -->

<div class="area-konten">
    <!-- Judul Halaman -->
    <div style="margin-bottom: 24px;">
        <a href="index.php?halaman=pengguna"
           style="font-size: 16px; color: var(--warna-utama); text-decoration: none; font-weight: 500;
                  display: inline-flex; align-items: center; gap: 6px; margin-bottom: 12px;"
           onmouseover="this.style.color='var(--warna-hover)'"
           onmouseout="this.style.color='var(--warna-utama)'">
            ← Kembali ke Daftar Pengguna
        </a>
        <h1 style="font-size: 28px; font-weight: 700; color: var(--warna-teks-utama); line-height: 1.3;">
            Tambah Kasir Baru
        </h1>
        <p style="font-size: 16px; color: var(--warna-teks-sekunder); margin-top: 4px;">
            Silakan lengkapi data di bawah ini untuk membuat akun kasir baru.
        </p>
    </div>

    <!-- Pesan Kilat -->
    <?php echo tampilkan_pesan_kilat(); ?>

    <!-- Formulir Tambah Kasir -->
    <div class="kartu" style="background-color: var(--warna-kartu); border-radius: 12px;
                              box-shadow: 0 1px 3px rgba(0,0,0,0.08); border: 1px solid #E5E7EB;
                              padding: 32px; max-width: 560px;">

        <form method="POST" action="index.php?halaman=pengguna&aksi=simpan">
            <?php echo kolom_csrf(); ?>

            <!-- Nama Lengkap -->
            <div style="margin-bottom: 20px;">
                <label for="nama_lengkap"
                       style="display: block; font-size: 16px; font-weight: 600;
                              color: var(--warna-teks-utama); margin-bottom: 8px;">
                    Nama Lengkap <span style="color: var(--warna-bahaya);">*</span>
                </label>
                <input type="text"
                       id="nama_lengkap"
                       name="nama_lengkap"
                       placeholder="Masukkan nama lengkap kasir"
                       required
                       style="width: 100%; height: 52px; padding: 0 16px; font-size: 16px;
                              font-family: 'Inter', 'Segoe UI', sans-serif;
                              color: var(--warna-teks-utama); background-color: var(--warna-kartu);
                              border: 2px solid #D1D5DB; border-radius: 10px; outline: none;
                              transition: border-color 0.2s ease;"
                       onfocus="this.style.borderColor='var(--warna-utama)'"
                       onblur="this.style.borderColor='#D1D5DB'">
            </div>

            <!-- Nama Pengguna -->
            <div style="margin-bottom: 20px;">
                <label for="nama_pengguna"
                       style="display: block; font-size: 16px; font-weight: 600;
                              color: var(--warna-teks-utama); margin-bottom: 8px;">
                    Nama Pengguna <span style="color: var(--warna-bahaya);">*</span>
                </label>
                <input type="text"
                       id="nama_pengguna"
                       name="nama_pengguna"
                       placeholder="Masukkan nama pengguna (untuk masuk ke sistem)"
                       required
                       style="width: 100%; height: 52px; padding: 0 16px; font-size: 16px;
                              font-family: 'Inter', 'Segoe UI', sans-serif;
                              color: var(--warna-teks-utama); background-color: var(--warna-kartu);
                              border: 2px solid #D1D5DB; border-radius: 10px; outline: none;
                              transition: border-color 0.2s ease;"
                       onfocus="this.style.borderColor='var(--warna-utama)'"
                       onblur="this.style.borderColor='#D1D5DB'">
                <p style="font-size: 14px; color: var(--warna-teks-sekunder); margin-top: 6px;">
                    Nama pengguna digunakan untuk masuk ke sistem. Gunakan huruf kecil tanpa spasi.
                </p>
            </div>

            <!-- Kata Sandi -->
            <div style="margin-bottom: 28px;">
                <label for="kata_sandi"
                       style="display: block; font-size: 16px; font-weight: 600;
                              color: var(--warna-teks-utama); margin-bottom: 8px;">
                    Kata Sandi <span style="color: var(--warna-bahaya);">*</span>
                </label>
                <input type="password"
                       id="kata_sandi"
                       name="kata_sandi"
                       placeholder="Masukkan kata sandi (minimal <?php echo PANJANG_KATA_SANDI_MIN; ?> karakter)"
                       required
                       minlength="<?php echo PANJANG_KATA_SANDI_MIN; ?>"
                       style="width: 100%; height: 52px; padding: 0 16px; font-size: 16px;
                              font-family: 'Inter', 'Segoe UI', sans-serif;
                              color: var(--warna-teks-utama); background-color: var(--warna-kartu);
                              border: 2px solid #D1D5DB; border-radius: 10px; outline: none;
                              transition: border-color 0.2s ease;"
                       onfocus="this.style.borderColor='var(--warna-utama)'"
                       onblur="this.style.borderColor='#D1D5DB'">
                <p style="font-size: 14px; color: var(--warna-teks-sekunder); margin-top: 6px;">
                    Kata sandi harus terdiri dari minimal <?php echo PANJANG_KATA_SANDI_MIN; ?> karakter.
                </p>
            </div>

            <!-- Tombol -->
            <div style="display: flex; gap: 12px;">
                <button type="submit"
                        style="flex: 1; height: 56px; font-size: 18px; font-weight: 600;
                               font-family: 'Inter', 'Segoe UI', sans-serif;
                               color: #FFFFFF; background-color: var(--warna-utama);
                               border: none; border-radius: 10px; cursor: pointer;
                               transition: background-color 0.2s ease;"
                        onmouseover="this.style.backgroundColor='var(--warna-hover)'"
                        onmouseout="this.style.backgroundColor='var(--warna-utama)'">
                    Simpan
                </button>
                <a href="index.php?halaman=pengguna"
                   style="flex: 0 0 auto; display: inline-flex; align-items: center; justify-content: center;
                          height: 56px; padding: 0 28px; font-size: 18px; font-weight: 600;
                          color: var(--warna-teks-sekunder); background-color: transparent;
                          border: 2px solid #D1D5DB; border-radius: 10px; text-decoration: none;
                          transition: border-color 0.2s ease;"
                   onmouseover="this.style.borderColor='var(--warna-utama)'; this.style.color='var(--warna-utama)'"
                   onmouseout="this.style.borderColor='#D1D5DB'; this.style.color='var(--warna-teks-sekunder)'">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
