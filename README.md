# Sistem Manajemen Data Mahasiswa

1. Pastikan PHP, Composer, MySQL, dan (opsional) XAMPP terpasang.
2. Clone / copy project ke folder kerja.
3. Salin `.env.example` ke `.env` dan atur DB.
4. Jalankan: composer install, php artisan key:generate, php artisan migrate, php artisan serve
5. Buka http://127.0.0.1:8000 

# About 
Program student_management adalah aplikasi web Laravel untuk mengelola data mahasiswa dengan pola MVC. Model Student menangani interaksi ke tabel mahasiswa di database, controller seperti StudentController dan AuthController mengatur logika dan alur, sedangkan tampilan menggunakan Blade dan Bootstrap untuk menampilkan halaman login, daftar mahasiswa, serta form tambah dan edit.
Alur aplikasi dimulai dari login. Jika pengguna memasukkan email dan password, sistem memperlakukan itu sebagai login admin menggunakan mekanisme autentikasi Laravel. Jika yang dimasukkan adalah NIM, sistem memperlakukannya sebagai login mahasiswa dan menyimpan data login dalam session khusus. Setelah login berhasil, session diregenerasi dan pengguna diarahkan ke halaman /students.
Admin yang sudah login mendapatkan akses penuh ke fitur CRUD mahasiswa. Admin bisa melihat daftar mahasiswa, menambah data baru, mengedit data yang sudah ada, menghapus data yang tidak diperlukan, dan melakukan pencarian berdasarkan NIM, nama, jurusan, atau angkatan. Setiap penyimpanan atau pembaruan data melalui controller divalidasi terlebih dahulu (misalnya NIM dan email harus unik dan berformat benar) sebelum ditulis ke database.
Mahasiswa yang login dengan NIM akan diarahkan ke tampilan “Student Portal” yang menampilkan profil singkat (NIM, nama, jurusan, angkatan) serta informasi sederhana seperti jumlah total mahasiswa atau daftar teman satu jurusan. Dengan pemisahan peran ini, admin fokus mengelola data, sedangkan mahasiswa hanya melihat informasi yang relevan dengan dirinya, tetapi keduanya tetap menggunakan basis data dan struktur program yang sama sehingga aplikasi mudah dipahami dan dipelihara.
