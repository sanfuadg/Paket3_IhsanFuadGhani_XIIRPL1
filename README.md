# NeskarFix - Laravel 12

Aplikasi Pengaduan Sarana Sekolah berbasis Laravel 12, Blade, Tailwind-style custom CSS, dan Vanilla JS.

## Fitur utama
- Form aspirasi siswa
- Hasil aspirasi siswa
- Login admin
- Dashboard admin
- Detail / proses aspirasi
- Histori aspirasi
- 5 tabel saling berelasi: admin, siswa, kategori, input_aspirasi, aspirasi

## Akun admin default
- Username: `admin`
- Password: `admin123`

## Cara menjalankan
1. `composer install`
2. `copy .env.example .env` (Windows) atau `cp .env.example .env`
3. Atur database MySQL di `.env`
4. `php artisan key:generate`
5. `php artisan migrate:fresh --seed`
6. `php artisan serve`

## Catatan
- Jika tabel `kategori` kosong, aplikasi akan otomatis membuat kategori default saat halaman form siswa dibuka.
- Jika admin belum ada, aplikasi akan otomatis membuat akun admin default saat halaman login admin dibuka.
- Frontend tidak memerlukan `npm run dev`.
