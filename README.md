# Sistem Manajemen Perpustakaan

Aplikasi web untuk mengelola buku, penulis, dan kategori di perpustakaan menggunakan Laravel dan MariaDB.

## Fitur

- **Dashboard**: Statistik dan overview perpustakaan
- **Manajemen Buku**: CRUD lengkap untuk data buku
- **Manajemen Penulis**: CRUD lengkap untuk data penulis
- **Manajemen Kategori**: CRUD lengkap untuk data kategori
- **UI Responsif**: Menggunakan Bootstrap 5 dengan desain modern
- **Validasi Form**: Validasi lengkap untuk semua input
- **Relasi Database**: Relasi yang tepat antara buku, penulis, dan kategori

## Tech Stack

- **Backend**: PHP 8.4 dengan Laravel 11
- **Database**: MariaDB
- **Frontend**: Bootstrap 5, Font Awesome
- **Server**: Laravel Development Server

## Instalasi

### Prerequisites

- PHP 8.4+
- Composer
- MariaDB
- Git

### Langkah Instalasi

1. **Clone repository**
   ```bash
   git clone <repository-url>
   cd library-management
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Setup environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Konfigurasi database**
   Edit file `.env` dan sesuaikan dengan konfigurasi MariaDB Anda:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=library_management
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. **Buat database**
   ```bash
   mysql -u your_username -p
   CREATE DATABASE library_management;
   ```

6. **Jalankan migrations**
   ```bash
   php artisan migrate
   ```

7. **Seed data sample (opsional)**
   ```bash
   php artisan db:seed --class=LibrarySeeder
   ```

8. **Jalankan server**
   ```bash
   php artisan serve
   ```

9. **Akses aplikasi**
   Buka browser dan akses `http://127.0.0.1:8000`

## Struktur Database

### Tabel Categories
- `id` (Primary Key)
- `name` (Nama kategori)
- `description` (Deskripsi kategori)
- `created_at`, `updated_at`

### Tabel Authors
- `id` (Primary Key)
- `name` (Nama penulis)
- `biography` (Biografi penulis)
- `birth_date` (Tanggal lahir)
- `nationality` (Kebangsaan)
- `created_at`, `updated_at`

### Tabel Books
- `id` (Primary Key)
- `title` (Judul buku)
- `isbn` (ISBN buku)
- `description` (Deskripsi buku)
- `published_date` (Tanggal terbit)
- `pages` (Jumlah halaman)
- `language` (Bahasa)
- `stock` (Stok buku)
- `author_id` (Foreign Key ke authors)
- `category_id` (Foreign Key ke categories)
- `created_at`, `updated_at`

## Fitur Aplikasi

### Dashboard
- Statistik total buku, penulis, dan kategori
- Daftar buku terbaru
- Quick actions untuk menambah data

### Manajemen Buku
- Tambah, edit, hapus, dan lihat detail buku
- Validasi form lengkap
- Relasi dengan penulis dan kategori
- Pagination untuk daftar buku

### Manajemen Penulis
- Tambah, edit, hapus, dan lihat profil penulis
- Daftar buku karya penulis
- Informasi biografi lengkap

### Manajemen Kategori
- Tambah, edit, hapus, dan lihat kategori
- Daftar buku dalam kategori
- Statistik jumlah buku per kategori

## Penggunaan

1. **Akses Dashboard**: Halaman utama menampilkan statistik perpustakaan
2. **Kelola Kategori**: Buat kategori sebelum menambah buku
3. **Kelola Penulis**: Tambahkan data penulis
4. **Kelola Buku**: Tambahkan buku dengan memilih penulis dan kategori

## Data Sample

Aplikasi dilengkapi dengan data sample yang mencakup:
- 5 kategori (Fiksi, Non-Fiksi, Sejarah, Teknologi, Pendidikan)
- 4 penulis Indonesia terkenal
- 5 buku populer Indonesia

## Kontribusi

1. Fork repository
2. Buat branch fitur (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

## License

Aplikasi ini menggunakan [MIT License](https://opensource.org/licenses/MIT).
# manajemen-buku-paket
