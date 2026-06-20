# SIGAPN - Sistem Informasi Anggota Pagar Nusa

Source code Laravel 12 untuk aplikasi SIGAPN.

Folder `vendor` dan `node_modules` tidak ikut dimasukkan supaya ZIP ringan. Jalankan instalasi sesuai langkah di bawah.

## Cara pemasangan

1. Ekstrak ZIP ke folder web kamu, contoh `C:\laragon\www\sigapn` atau `C:\xampp\htdocs\sigapn`.
2. Buka terminal di folder project.
3. Jalankan perintah berikut.

```bash
composer install
npm install
copy .env.example .env
php artisan key:generate
```

4. Buat database MySQL dengan nama:

```txt
sigapn
```

5. Sesuaikan `.env`:

```env
DB_DATABASE=sigapn
DB_USERNAME=root
DB_PASSWORD=
```

6. Jalankan migrasi, seeder, storage link, Vite, dan server.

```bash
php artisan migrate:fresh --seed
php artisan storage:link
npm run dev
php artisan serve
```

Login admin:

```txt
Email    : admin@sigapn.test
Password : password
```

## Fitur sudah ada

- Login dan register
- Role Super Admin, Ketum, Pengurus, Anggota
- Dashboard statistik
- Landing page publik
- CRUD Kampus
- CRUD Anggota
- CRUD Pengurus
- CRUD Kegiatan
- CRUD Berita
- Surat sederhana
- Absensi sederhana
- Kartu anggota digital PDF dengan QR Code
- Export Excel anggota
- Import Excel anggota
- Data dummy kampus dan anggota Jombang

## Jika CSS tidak tampil

Pastikan `npm run dev` masih berjalan. Jangan ditutup.

## Jika composer error ext-gd

Aktifkan extension `gd` di `php.ini`, lalu ulangi `composer install`.
