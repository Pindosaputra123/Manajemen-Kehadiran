# Manajemen Kehadiran

Manajemen Kehadiran adalah aplikasi berbasis web untuk mencatat dan mengelola data kehadiran siswa di sebuah sekolah.

## Fitur Utama

- **Pencatatan Kehadiran**: Tambahkan dan pantau data kehadiran siswa.
- **Rekap Kehadiran**: Lihat laporan kehadiran harian.
- **Manajemen Data Karyawan**: Tambah, edit, atau hapus data siswa.

## Teknologi yang Digunakan

- **Backend**: PHP
- **Database**: MySQL
- **Frontend**: Bootstrap, HTML, CSS

## Instalasi dan Penggunaan

1. **Clone Repositori**
   ```bash
   git clone https://github.com/Pindosaputra123/Manajemen-Kehadiran.git
   ```

2. **Import Database**
   - Buka phpMyAdmin atau tool database lainnya.
   - Import file SQL yang terdapat dalam folder `db` ke MySQL Anda.

3. **Konfigurasi Aplikasi**
   - Buka file `config.php` dan sesuaikan pengaturan koneksi database sesuai dengan environment Anda.

4. **Jalankan Aplikasi**
   - Gunakan server lokal seperti XAMPP atau WAMP.
   - Akses aplikasi melalui browser di alamat `http://localhost/Manajemen-Kehadiran`.

## Struktur Folder

- `db/` : File SQL untuk struktur dan data awal.
- `config.php` : Konfigurasi database.
- `admin/` : File frontend dan aset statis.
- `resources/` : File bootstrap.

## Kontribusi

Saya menyambut kontribusi Anda! Berikut adalah cara Anda dapat membantu:

1. Fork repositori ini.
2. Buat branch untuk fitur atau perbaikan Anda:
   ```bash
   git checkout -b fitur-anda
   ```
3. Commit perubahan Anda:
   ```bash
   git commit -m 'Menambahkan fitur baru'
   ```
4. Push branch Anda:
   ```bash
   git push origin fitur-anda
   ```
5. Ajukan pull request.

## Lisensi

Aplikasi ini dilisensikan di bawah MIT License.
