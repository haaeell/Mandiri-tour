# Sistem CRM Travel Documentation

## Deskripsi Proyek
Sistem CRM Travel merupakan sebuah aplikasi berbasis web yang dikembangkan untuk PT. Mandiri Tour & Travel Subang. Tujuan dari sistem ini adalah untuk membantu perusahaan dalam mengelola hubungan dengan pelanggan mereka secara efektif serta meningkatkan layanan yang mereka tawarkan.

## Fitur Utama
- Manajemen Informasi Pelanggan: Sistem ini memungkinkan untuk mencatat dan mengelola informasi pelanggan seperti nama, kontak, riwayat transaksi, preferensi perjalanan, dan lain-lain.
- Manajemen Reservasi: Pelanggan dapat melakukan reservasi perjalanan melalui sistem ini, dan perusahaan dapat dengan mudah mengelola dan mengonfirmasi reservasi tersebut.
- Pelacakan Aktivitas Pelanggan: Sistem memungkinkan untuk melacak aktivitas pelanggan, seperti interaksi dengan perusahaan, komunikasi, dan feedback.
- Analisis Data Pelanggan: Sistem menyediakan analisis data pelanggan yang dapat membantu perusahaan memahami pola perilaku pelanggan dan membuat keputusan yang lebih baik.

## Teknologi yang Digunakan
- Bahasa Pemrograman: PHP, JavaScript
- Framework: Laravel (backend), Bootstrap (frontend)
- Database: MySQL
- Pemetaan Lokasi: Google Maps API

## Cara Menjalankan Proyek
1. Pastikan Anda memiliki lingkungan pengembangan PHP yang telah terpasang di komputer Anda.
2. Clone repositori proyek ini ke komputer Anda.
3. Buka terminal dan arahkan ke direktori proyek.
4. Jalankan perintah `composer install` untuk menginstal semua dependensi PHP yang diperlukan.
5. Salin file `.env.example` menjadi `.env` dan konfigurasikan file `.env` sesuai dengan lingkungan Anda.
6. Jalankan perintah `php artisan key:generate` untuk menghasilkan kunci aplikasi baru.
7. Buatlah database baru untuk proyek Anda dan konfigurasikan koneksi database di file `.env`.
8. Jalankan perintah `php artisan migrate` untuk menjalankan semua migrasi database.
9. Jalankan perintah `php artisan serve` untuk menjalankan server pengembangan lokal.
10. Buka browser dan akses `http://localhost:8000` untuk mengakses aplikasi.

## Kontribusi
Kontribusi terhadap pengembangan proyek ini sangat dipersilakan. Jika Anda menemukan bug atau memiliki saran perbaikan, silakan buka "Issue" baru atau kirimkan "Pull Request" dengan perubahan yang diusulkan.

## Lisensi
Proyek ini dilisensikan di bawah Lisensi MIT.
