<!-- ============================================================ -->
<!-- HALAMAN DAFTAR PENGGUNA                                      -->
<!-- Berkas: app/views/pengguna/daftar.php                        -->
<!-- Penanggung Jawab: Radit                                      -->
<!-- Hanya bisa diakses oleh: Pemilik Toko                        -->
<!-- ============================================================ -->

<div class="area-konten">
    <!-- Judul Halaman -->
    <div class="judul-area" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <h1 style="font-size: 28px; font-weight: 700; color: var(--warna-teks-utama); line-height: 1.3;">
            Kelola Pengguna
        </h1>
        <a href="index.php?halaman=pengguna&aksi=tambah"
           class="tombol-utama"
           style="display: inline-flex; align-items: center; gap: 8px; padding: 14px 28px;
                  background-color: var(--warna-utama); color: #FFFFFF; text-decoration: none;
                  border-radius: 10px; font-size: 16px; font-weight: 600;
                  transition: background-color 0.2s ease;"
           onmouseover="this.style.backgroundColor='var(--warna-hover)'"
           onmouseout="this.style.backgroundColor='var(--warna-utama)'">
            ➕ Tambah Kasir Baru
        </a>
    </div>

    <!-- Pesan Kilat -->
    <?php echo tampilkan_pesan_kilat(); ?>

    <!-- Tabel Pengguna -->
    <div class="kartu" style="background-color: var(--warna-kartu); border-radius: 12px;
                              box-shadow: 0 1px 3px rgba(0,0,0,0.08); border: 1px solid #E5E7EB;
                              overflow: hidden;">

        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: var(--warna-latar); border-bottom: 2px solid #E5E7EB;">
                    <th style="padding: 16px 20px; text-align: left; font-size: 16px; font-weight: 600; color: var(--warna-teks-sekunder);">
                        No
                    </th>
                    <th style="padding: 16px 20px; text-align: left; font-size: 16px; font-weight: 600; color: var(--warna-teks-sekunder);">
                        Nama Lengkap
                    </th>
                    <th style="padding: 16px 20px; text-align: left; font-size: 16px; font-weight: 600; color: var(--warna-teks-sekunder);">
                        Nama Pengguna
                    </th>
                    <th style="padding: 16px 20px; text-align: left; font-size: 16px; font-weight: 600; color: var(--warna-teks-sekunder);">
                        Peran
                    </th>
                    <th style="padding: 16px 20px; text-align: left; font-size: 16px; font-weight: 600; color: var(--warna-teks-sekunder);">
                        Terdaftar Sejak
                    </th>
                    <th style="padding: 16px 20px; text-align: center; font-size: 16px; font-weight: 600; color: var(--warna-teks-sekunder);">
                        Tindakan
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($daftar_pengguna)): ?>
                    <tr>
                        <td colspan="6" style="padding: 40px 20px; text-align: center; font-size: 16px; color: var(--warna-teks-sekunder);">
                            Belum ada pengguna yang terdaftar.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php $nomor = 1; ?>
                    <?php foreach ($daftar_pengguna as $pengguna): ?>
                        <tr style="border-bottom: 1px solid #E5E7EB; min-height: 48px;
                                   <?php echo $nomor % 2 === 0 ? 'background-color: #FAFBFC;' : ''; ?>">

                            <!-- No -->
                            <td style="padding: 16px 20px; font-size: 16px; color: var(--warna-teks-utama);">
                                <?php echo $nomor; ?>
                            </td>

                            <!-- Nama Lengkap -->
                            <td style="padding: 16px 20px; font-size: 16px; font-weight: 600; color: var(--warna-teks-utama);">
                                <?php echo e($pengguna['nama_lengkap']); ?>
                            </td>

                            <!-- Nama Pengguna -->
                            <td style="padding: 16px 20px; font-size: 16px; color: var(--warna-teks-utama);">
                                <?php echo e($pengguna['nama_pengguna']); ?>
                            </td>

                            <!-- Peran -->
                            <td style="padding: 16px 20px;">
                                <?php if ($pengguna['peran'] === 'pemilik'): ?>
                                    <span style="display: inline-block; padding: 4px 14px; border-radius: 8px;
                                                 font-size: 14px; font-weight: 600;
                                                 background-color: #F0FDFA; color: var(--warna-utama);">
                                        Pemilik Toko
                                    </span>
                                <?php else: ?>
                                    <span style="display: inline-block; padding: 4px 14px; border-radius: 8px;
                                                 font-size: 14px; font-weight: 600;
                                                 background-color: var(--warna-latar); color: var(--warna-teks-sekunder);">
                                        Kasir
                                    </span>
                                <?php endif; ?>
                            </td>

                            <!-- Terdaftar Sejak -->
                            <td style="padding: 16px 20px; font-size: 16px; color: var(--warna-teks-sekunder);">
                                <?php echo format_tanggal($pengguna['dibuat_pada']); ?>
                            </td>

                            <!-- Tindakan -->
                            <td style="padding: 16px 20px; text-align: center;">
                                <?php if ($pengguna['peran'] === 'kasir'): ?>
                                    <form method="POST" action="index.php?halaman=pengguna&aksi=hapus"
                                          style="display: inline;"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun kasir <?php echo e($pengguna['nama_lengkap']); ?>?');">
                                        <?php echo kolom_csrf(); ?>
                                        <input type="hidden" name="id" value="<?php echo $pengguna['id']; ?>">
                                        <button type="submit"
                                                style="padding: 10px 20px; font-size: 16px; font-weight: 600;
                                                       font-family: 'Inter', 'Segoe UI', sans-serif;
                                                       color: #FFFFFF; background-color: var(--warna-bahaya);
                                                       border: none; border-radius: 10px; cursor: pointer;
                                                       transition: opacity 0.2s ease; min-height: 48px;"
                                                onmouseover="this.style.opacity='0.9'"
                                                onmouseout="this.style.opacity='1'">
                                            Hapus
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <span style="font-size: 14px; color: var(--warna-teks-sekunder);">—</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php $nomor++; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Informasi Tambahan -->
    <p style="margin-top: 20px; font-size: 14px; color: var(--warna-teks-sekunder);">
        Total pengguna terdaftar: <?php echo count($daftar_pengguna); ?> orang
    </p>
</div>
