@echo off
REM Inventory Management System - Setup Script for Windows

echo.
echo ========================================
echo Inventory Management System Setup
echo ========================================
echo.

REM Check if composer is installed
composer --version >nul 2>&1
if errorlevel 1 (
    echo ERROR: Composer is not installed!
    echo Please install Composer from: https://getcomposer.org/download/
    pause
    exit /b 1
)

REM Check if PHP is installed
php --version >nul 2>&1
if errorlevel 1 (
    echo ERROR: PHP is not installed!
    echo Please install PHP 8.2+ from: https://www.php.net/downloads.php
    pause
    exit /b 1
)

echo [1/5] Installing PHP dependencies...
composer install
if errorlevel 1 (
    echo ERROR: Composer install failed!
    pause
    exit /b 1
)

echo.
echo [2/5] Creating .env file...
if not exist .env (
    copy .env.example .env
    echo .env file created!
) else (
    echo .env file already exists!
)

echo.
echo [3/5] Generating application key...
php artisan key:generate

echo.
echo [4/5] Running database migrations...
echo Make sure MySQL is running and database credentials are correct in .env
pause
php artisan migrate

echo.
echo [5/5] Setup complete!
echo.
echo ========================================
echo Next Steps:
echo ========================================
echo 1. Open .env file and verify database settings
echo 2. Run: php artisan serve
echo 3. Open browser: http://localhost:8000
echo.
pause
