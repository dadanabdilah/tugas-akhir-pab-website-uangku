

# UANGKU - Website Catatan Keuangan
Projek ini adalah API dari project [APLIKASI UANGKU](https://github.com/dadanabdilah/tugas-akhir-pab-aplikasi-uangku) dan project ini dibuat bertujuan untuk memenuhi tugas akhir Matakuliah Pemrograman Aplikasi Bergerak.
## Konfigurasi

1. **Setting Database**:
   - Atur konfigurasi database pada file `.env`.
   
2. **Setting URL dan JWT**:
   - Atur juga `BASE_URL` dan `JWT_SECRET` pada file `.env`.

## Data Pengguna

- **Email**: `user@gmail.com`
- **Password**: `123456789`

## Fitur Utama

- Login Akun
- Daftar Akun
- Kelola Rekening
- Kelola Kategori Keuangan
- Kelolca Catatan Keuangan

## Kebutuhan Server

Pastikan server memenuhi persyaratan berikut:

- **PHP versi 7.4 atau lebih tinggi**, dengan mengaktifkan beberapa ekstensi berikut:
  - [intl](http://php.net/manual/en/intl.requirements.php)
  - [mbstring](http://php.net/manual/en/mbstring.installation.php)
  - json (enabled by default - jangan dinonaktifkan)
  - [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)
  - [libcurl](http://php.net/manual/en/curl.requirements.php)

## Tambahan

- Pastikan untuk menyesuaikan konfigurasi sesuai dengan server Anda.
- Periksa dokumentasi resmi PHP untuk instruksi lebih lanjut mengenai pemasangan dan konfigurasi ekstensi yang diperlukan.
