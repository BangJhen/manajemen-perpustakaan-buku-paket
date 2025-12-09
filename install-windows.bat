@echo off
echo ========================================
echo Instalasi Aplikasi Buku Paket Sekolah
echo ========================================
echo.

REM Check if composer is installed
where composer >nul 2>nul
if %errorlevel% neq 0 (
    echo [ERROR] Composer tidak ditemukan!
    echo Silakan install Composer terlebih dahulu dari: https://getcomposer.org/download/
    pause
    exit /b 1
)

REM Check if php is installed
where php >nul 2>nul
if %errorlevel% neq 0 (
    echo [ERROR] PHP tidak ditemukan!
    echo Silakan install PHP terlebih dahulu dari: https://windows.php.net/download/
    pause
    exit /b 1
)

echo [1/6] Memeriksa versi PHP...
php -v
echo.

echo [2/6] Menginstall dependencies...
call composer install
if %errorlevel% neq 0 (
    echo [ERROR] Gagal menginstall dependencies!
    pause
    exit /b 1
)
echo.

echo [3/6] Menyalin file .env...
if not exist .env (
    copy .env.example .env
    echo File .env berhasil dibuat!
) else (
    echo File .env sudah ada, skip...
)
echo.

echo [4/6] Generate application key...
php artisan key:generate
echo.

echo [5/6] PENTING: Konfigurasi Database
echo.
echo Silakan edit file .env dan sesuaikan konfigurasi database MySQL Anda:
echo   DB_CONNECTION=mysql
echo   DB_HOST=127.0.0.1
echo   DB_PORT=3306
echo   DB_DATABASE=library_management
echo   DB_USERNAME=root
echo   DB_PASSWORD=
echo.
echo Pastikan database 'library_management' sudah dibuat di MySQL!
echo.
set /p continue="Tekan ENTER setelah konfigurasi database selesai..."
echo.

echo [6/6] Menjalankan migrasi database...
php artisan migrate
if %errorlevel% neq 0 (
    echo [ERROR] Gagal menjalankan migrasi!
    echo Pastikan:
    echo   1. MySQL Server sudah running
    echo   2. Database sudah dibuat
    echo   3. Konfigurasi .env sudah benar
    pause
    exit /b 1
)
echo.

echo ========================================
echo Instalasi Selesai!
echo ========================================
echo.
echo Untuk menjalankan aplikasi:
echo   1. Jalankan: start-server.bat
echo   2. Atau manual: php artisan serve
echo   3. Buka browser: http://localhost:8000
echo.
echo Untuk mengisi data sample:
echo   php artisan db:seed --class=SchoolPackageNoAuthorSeeder
echo.
pause
