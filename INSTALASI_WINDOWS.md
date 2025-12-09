# 🪟 Panduan Instalasi di Windows dengan MySQL

## 📋 Prasyarat

### 1. Software yang Dibutuhkan
- **PHP 8.1 atau lebih tinggi** ([Download PHP](https://windows.php.net/download/))
- **Composer** ([Download Composer](https://getcomposer.org/download/))
- **MySQL Server** (XAMPP, WAMP, atau MySQL standalone)
- **Git** (opsional, untuk clone project)

---

## 🚀 Langkah-Langkah Instalasi

### Step 1: Install PHP di Windows

1. **Download PHP**
   - Kunjungi: https://windows.php.net/download/
   - Download versi **PHP 8.1+ Thread Safe (x64)**
   - Extract ke folder, misalnya: `C:\php`

2. **Konfigurasi PHP**
   - Copy file `php.ini-development` menjadi `php.ini`
   - Edit `php.ini`, aktifkan extension berikut (hapus tanda `;`):
   ```ini
   extension=curl
   extension=fileinfo
   extension=gd
   extension=mbstring
   extension=openssl
   extension=pdo_mysql
   extension=mysqli
   extension=zip
   ```

3. **Tambahkan PHP ke PATH**
   - Buka **System Properties** → **Environment Variables**
   - Edit variable **Path**
   - Tambahkan: `C:\php`
   - Klik **OK**

4. **Verifikasi Instalasi**
   ```bash
   php -v
   ```

### Step 2: Install Composer

1. **Download Composer**
   - Kunjungi: https://getcomposer.org/download/
   - Download **Composer-Setup.exe**
   - Jalankan installer dan ikuti instruksi

2. **Verifikasi Instalasi**
   ```bash
   composer --version
   ```

### Step 3: Setup MySQL Database

#### Jika Menggunakan XAMPP:

1. **Install XAMPP**
   - Download dari: https://www.apachefriends.org/
   - Install dan jalankan **XAMPP Control Panel**
   - Start **Apache** dan **MySQL**

2. **Buat Database**
   - Buka browser: `http://localhost/phpmyadmin`
   - Klik **New** untuk membuat database baru
   - Nama database: `library_management`
   - Collation: `utf8mb4_unicode_ci`
   - Klik **Create**

#### Jika Menggunakan MySQL Standalone:

1. **Buka MySQL Command Line** atau **MySQL Workbench**

2. **Buat Database**
   ```sql
   CREATE DATABASE library_management CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

3. **Buat User (opsional)**
   ```sql
   CREATE USER 'library_user'@'localhost' IDENTIFIED BY 'password_anda';
   GRANT ALL PRIVILEGES ON library_management.* TO 'library_user'@'localhost';
   FLUSH PRIVILEGES;
   ```

### Step 4: Transfer Project ke Windows

#### Opsi A: Copy Manual

1. **Copy folder project** dari Mac ke Windows
   - Gunakan USB drive, cloud storage, atau network sharing
   - Letakkan di folder, misalnya: `C:\xampp\htdocs\library-management`

#### Opsi B: Clone dari Git (jika sudah di repository)

```bash
cd C:\xampp\htdocs
git clone [URL_REPOSITORY] library-management
cd library-management
```

### Step 5: Install Dependencies

1. **Buka Command Prompt atau PowerShell**
   ```bash
   cd C:\xampp\htdocs\library-management
   ```

2. **Install Composer Dependencies**
   ```bash
   composer install
   ```

### Step 6: Konfigurasi Environment

1. **Copy file .env**
   ```bash
   copy .env.example .env
   ```
   
   Atau jika `.env` sudah ada dari Mac, edit file tersebut.

2. **Edit file `.env`** dengan Notepad atau text editor:
   ```env
   APP_NAME="Sistem Manajemen Buku Paket Sekolah"
   APP_ENV=local
   APP_KEY=
   APP_DEBUG=true
   APP_URL=http://localhost:8000

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=library_management
   DB_USERNAME=root
   DB_PASSWORD=
   ```

   **Catatan:**
   - Jika menggunakan XAMPP, `DB_PASSWORD` biasanya kosong
   - Jika menggunakan MySQL standalone, sesuaikan username dan password

3. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

### Step 7: Migrasi Database

1. **Jalankan Migrasi**
   ```bash
   php artisan migrate
   ```

2. **Seed Data Sample** (opsional)
   ```bash
   php artisan db:seed --class=SchoolPackageNoAuthorSeeder
   ```

### Step 8: Jalankan Aplikasi

1. **Start Laravel Development Server**
   ```bash
   php artisan serve
   ```

2. **Akses Aplikasi**
   - Buka browser: `http://localhost:8000`
   - Atau: `http://127.0.0.1:8000`

---

## 🔧 Troubleshooting

### Error: "could not find driver"
**Solusi:**
- Pastikan extension `pdo_mysql` dan `mysqli` sudah diaktifkan di `php.ini`
- Restart Command Prompt setelah edit `php.ini`

### Error: "Access denied for user"
**Solusi:**
- Periksa username dan password MySQL di file `.env`
- Pastikan MySQL service sudah running

### Error: "Port 8000 already in use"
**Solusi:**
- Gunakan port lain:
  ```bash
  php artisan serve --port=8080
  ```

### Error: Composer command not found
**Solusi:**
- Pastikan Composer sudah ditambahkan ke PATH
- Restart Command Prompt
- Atau gunakan full path: `C:\ProgramData\ComposerSetup\bin\composer`

### Error: PHP command not found
**Solusi:**
- Pastikan PHP sudah ditambahkan ke PATH
- Restart Command Prompt
- Atau gunakan full path: `C:\php\php.exe`

---

## 📦 Struktur Database

Setelah migrasi, database akan memiliki tabel:

- **books** - Data buku paket sekolah
  - Fields: id, title, subject, grade_level, semester, curriculum_type, book_type, publisher, curriculum_year, isbn, description, published_date, pages, language, stock, category_id, timestamps

- **categories** - Mata pelajaran
  - Fields: id, name, description, timestamps

- **migrations** - Tracking migrasi database

---

## 🎯 Akses Aplikasi

Setelah instalasi berhasil:

1. **Dashboard**: `http://localhost:8000`
2. **Kelola Buku Paket**: `http://localhost:8000/books`
3. **Kelola Mata Pelajaran**: `http://localhost:8000/categories`

---

## 📝 Catatan Penting

### Untuk Development:
- Gunakan `php artisan serve` untuk testing lokal
- Database akan di-reset jika menjalankan seeder lagi

### Untuk Production:
- Ubah `APP_ENV=production` di `.env`
- Ubah `APP_DEBUG=false` di `.env`
- Setup web server (Apache/Nginx)
- Gunakan database production yang terpisah

### Backup Database:
```bash
# Export database
mysqldump -u root -p library_management > backup.sql

# Import database
mysql -u root -p library_management < backup.sql
```

---

## 🆘 Butuh Bantuan?

Jika mengalami masalah:

1. Cek log error Laravel: `storage/logs/laravel.log`
2. Cek PHP error: `php -i | findstr error`
3. Cek MySQL connection: 
   ```bash
   php artisan tinker
   DB::connection()->getPdo();
   ```

---

## ✅ Checklist Instalasi

- [ ] PHP 8.1+ terinstall
- [ ] Composer terinstall
- [ ] MySQL Server running
- [ ] Database `library_management` sudah dibuat
- [ ] File `.env` sudah dikonfigurasi
- [ ] Dependencies sudah diinstall (`composer install`)
- [ ] Application key sudah digenerate
- [ ] Migrasi database berhasil
- [ ] Data sample sudah di-seed (opsional)
- [ ] Aplikasi bisa diakses di browser

---

**Selamat! Aplikasi Manajemen Buku Paket Sekolah siap digunakan di Windows! 🎉**
