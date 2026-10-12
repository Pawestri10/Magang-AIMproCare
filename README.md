# AIMpro Care — Warranty & After-Sales System

**AIMpro Care** adalah aplikasi berbasis web untuk mengelola proses Quality Control (QC), penjualan unit, aktivasi garansi, pengecekan garansi, dan pengajuan klaim garansi dalam satu sistem terintegrasi.

Proyek ini dikembangkan untuk mendukung proses operasional **CV. Amis Project Teknologi Indonesia**, mulai dari pemeriksaan unit hingga layanan purna jual kepada pelanggan.

## 🎯 Tujuan Proyek

- Mengelola proses QC dan dokumentasi pemeriksaan unit.
- Memastikan hanya unit yang memenuhi kriteria QC yang dapat dijual.
- Mengelola data pelanggan, transaksi penjualan, dan aktivasi garansi.
- Menyediakan kartu garansi digital dengan QR Code.
- Memungkinkan pelanggan memeriksa garansi dan mengajukan klaim secara online.
- Menyediakan riwayat proses klaim agar status penanganan dapat ditelusuri.
- Mendukung pengelolaan layanan purna jual secara terstruktur.

## 🛠️ Teknologi

| Teknologi                 | Penggunaan                                                   |
| ------------------------- | ------------------------------------------------------------ |
| PHP 8                     | Bahasa pemrograman backend                                   |
| CodeIgniter 4             | Framework aplikasi web                                       |
| MySQL / MariaDB           | Database                                                     |
| HTML, CSS, JavaScript     | Antarmuka dan interaksi                                      |
| Bootstrap 5               | Dasar pengembangan antarmuka responsif                       |
| Git & GitHub              | Version control dan pengelolaan kode                         |
| Progressive Web App (PWA) | Dukungan pengalaman aplikasi web                             |
| WAKITA                    | Integrasi notifikasi WhatsApp yang direncanakan dalam sistem |

## 👥 Role Pengguna

### 1. Administrator

Administrator mengelola data dan proses operasional utama, meliputi:

- Manajemen pengguna, produk, dan pelanggan.
- Pengelolaan unit yang telah lulus QC.
- Pencatatan transaksi penjualan.
- Aktivasi garansi dan penerbitan kartu garansi digital.
- Pengelolaan klaim garansi.
- Pemantauan dashboard, laporan, dan aktivitas sistem.

### 2. Petugas QC

Petugas QC bertanggung jawab untuk:

- Memeriksa kondisi fisik unit.
- Memeriksa kelengkapan produk.
- Mengisi checklist pemeriksaan.
- Mengunggah dokumentasi foto dan video.
- Mencatat hasil pemeriksaan dan catatan QC.

Petugas QC tidak bertanggung jawab untuk mengelola pelanggan atau mengaktifkan garansi.

### 3. Pelanggan

Pelanggan dapat mengakses layanan publik tanpa harus masuk ke dashboard internal, termasuk:

- Memeriksa status garansi menggunakan identitas unit atau garansi.
- Melihat kartu garansi digital.
- Mengajukan klaim garansi.
- Melacak status dan riwayat klaim menggunakan tautan pelacakan.

## ✨ Fitur Sistem

### Quality Control (QC)

- Pencatatan hasil pemeriksaan unit.
- Checklist kondisi fisik dan kelengkapan.
- Dokumentasi foto dan video.
- Riwayat pemeriksaan unit.
- Pengendalian status unit berdasarkan hasil QC.

### Penjualan dan Garansi

- Pencatatan data pelanggan dan transaksi.
- Pemilihan unit yang memenuhi persyaratan penjualan.
- Aktivasi garansi berdasarkan transaksi.
- Nomor garansi dan periode garansi.
- QR Code dan kartu garansi digital.
- Pemeriksaan garansi melalui halaman publik.

### Klaim Garansi

- Pengajuan klaim oleh pelanggan.
- Nomor klaim dan token pelacakan.
- Unggahan foto kerusakan dan video opsional.
- Pencatatan metode pengiriman serta alamat jika diperlukan.
- Riwayat status klaim.
- Daftar klaim pada dashboard Administrator.
- Detail klaim dan timeline penanganan.

Status klaim yang digunakan:

1. Pengajuan Baru
2. Sedang Diverifikasi
3. Klaim Diterima
4. Klaim Ditolak
5. Barang Diterima
6. Sedang Diperiksa
7. Sedang Diproses
8. Selesai

### Dashboard, Laporan, dan Notifikasi

Pengembangan sistem juga mencakup dashboard operasional, laporan QC dan garansi, ekspor laporan, notifikasi WhatsApp melalui WAKITA, serta dukungan PWA. Ketersediaan setiap fitur bergantung pada tahap implementasi dan pengujian terakhir.

## 🏗️ Struktur Aplikasi

Aplikasi menggunakan pola MVC dari CodeIgniter 4:

- **Models** — akses data dan interaksi dengan database.
- **Views** — tampilan halaman dan komponen antarmuka.
- **Controllers** — menangani request dan alur proses aplikasi.
- **Filters** — pembatasan akses berdasarkan autentikasi dan role.
- **Migrations** — pengelolaan perubahan struktur database.
- **Services** — logika atau layanan yang digunakan lintas bagian aplikasi.
- **Public Assets** — file CSS, JavaScript, gambar, dan aset publik lainnya.

Struktur ini membantu menjaga pemisahan tanggung jawab dan mempermudah pengembangan serta pemeliharaan aplikasi.

## ⚙️ Persyaratan Sistem

Sebelum menjalankan aplikasi, siapkan:

- PHP 8 yang kompatibel dengan versi CodeIgniter 4 proyek.
- Composer.
- MySQL atau MariaDB.
- Web server lokal seperti Laragon.
- Git.

Ekstensi PHP yang diperlukan mengikuti persyaratan CodeIgniter 4 dan dependensi yang digunakan proyek.

## 🚀 Instalasi dan Menjalankan Aplikasi

### 1. Clone Repository

```bash
git clone <URL_REPOSITORY>
cd Magang-AIMproCare
```

### 2. Instal Dependensi

```bash
composer install
```

### 3. Konfigurasi Environment

Salin file konfigurasi environment contoh jika tersedia:

```bash
cp env .env
```

Pada Windows, file tersebut juga dapat disalin melalui File Explorer.

Sesuaikan konfigurasi environment, termasuk pengaturan aplikasi dan koneksi database, berdasarkan lingkungan lokal.

### 4. Buat Database

Buat database MySQL/MariaDB untuk AIMpro Care, kemudian atur nama database, username, dan password di `.env`.

Contoh konfigurasi:

```ini
database.default.hostname = localhost
database.default.database = nama_database
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.port = 3306
```

Sesuaikan nilai tersebut dengan konfigurasi lokal. Jangan menggunakan contoh ini sebagai kredensial produksi.

### 5. Jalankan Migration

```bash
php spark migrate
```

Jalankan seeder hanya jika proyek menyediakan seeder dan data awal memang diperlukan:

```bash
php spark db:seed NamaSeeder
```

Ganti `NamaSeeder` dengan nama seeder yang benar-benar tersedia di proyek.

### 6. Jalankan Aplikasi

```bash
php spark serve
```

Buka alamat lokal yang ditampilkan oleh terminal, biasanya:

```text
http://localhost:8080
```

Jika menggunakan Laragon, sesuaikan alamat dengan konfigurasi virtual host lokal.

## 🔐 Keamanan

Pengembangan AIMpro Care memperhatikan aspek keamanan berikut:

- Validasi input di sisi server.
- Proteksi CSRF pada form yang sesuai.
- Pembatasan akses berdasarkan autentikasi dan role.
- Penggunaan query builder atau mekanisme query yang aman.
- Validasi tipe dan ukuran file unggahan.
- Pembatasan informasi sensitif pada halaman publik.
- Penggunaan token pelacakan untuk akses pelacakan klaim.
- Pencatatan aktivitas dan riwayat perubahan status.
- Penyimpanan kredensial dan konfigurasi sensitif di environment, bukan di repository.

Konfigurasi produksi dan seluruh alur akses tetap harus diuji sebelum aplikasi digunakan dengan data nyata.

## 🧪 Pengujian

Pengujian proyek perlu mencakup:

- Login, logout, dan pembatasan role.
- Validasi proses QC dan status unit.
- Penjualan dan aktivasi garansi.
- Keunikan serial unit dan relasi transaksi-garansi.
- Pengecekan garansi melalui halaman publik.
- Pengajuan klaim dan validasi unggahan.
- Pelacakan klaim dan kelengkapan timeline.
- Otorisasi pengelolaan klaim oleh Administrator.
- Proteksi akses langsung ke data klaim milik pihak lain.
- Pengujian notifikasi, laporan, dan PWA sesuai fitur yang sudah diimplementasikan.

Hasil pengujian aktual perlu dicatat berdasarkan eksekusi pengujian, bukan hanya berdasarkan keberadaan kode.

## 📌 Status Pengembangan

AIMpro Care dikembangkan secara bertahap.

Area yang telah dikerjakan mencakup proses pengajuan dan pelacakan klaim publik serta daftar klaim pada dashboard Administrator. Detail klaim dalam modal, perubahan status, pencatatan aktivitas, integrasi notifikasi, dan penyelesaian fitur Week 4 harus dinyatakan selesai setelah implementasi dan pengujiannya benar-benar lulus.

**AIMpro Care — Warranty & After-Sales System**
