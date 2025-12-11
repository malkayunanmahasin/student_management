# Sistem Manajemen Data Mahasiswa


1. Pastikan PHP, Composer, MySQL, dan (opsional) XAMPP terpasang.
2. Clone / copy project ke folder kerja.
3. Salin `.env.example` ke `.env` dan atur DB.
4. Jalankan:
composer install
php artisan key:generate
php artisan migrate
php artisan serve


5. Buka http://127.0.0.1:8000