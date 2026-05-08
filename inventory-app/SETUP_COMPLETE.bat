@echo off
REM Complete Laravel Setup Script

echo.
echo ========================================
echo Laravel Inventory App - Complete Setup
echo ========================================
echo.

REM Set paths
set XAMPP_PATH=E:\xampp
set PROJECT_PATH=%XAMPP_PATH%\htdocs\inventory-app
set PHP=%XAMPP_PATH%\php\php.exe
set COMPOSER=%PROJECT_PATH%\composer.phar

echo [1/5] Installing Composer Dependencies...
echo.
cd /d %PROJECT_PATH%
%PHP% %COMPOSER% install --no-progress
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
echo [3/5] Generating Application Key...
%PHP% artisan key:generate
if errorlevel 1 (
    echo ERROR: Key generation failed!
    pause
    exit /b 1
)

echo.
echo [4/5] Creating Database...
echo.
echo Please create database manually:
echo 1. Open: http://localhost/phpmyadmin
echo 2. Login: root (no password)
echo 3. Create database: inventory_db
echo.
pause

echo.
echo [5/5] Running Migrations...
%PHP% artisan migrate
if errorlevel 1 (
    echo ERROR: Migrations failed!
    pause
    exit /b 1
)

echo.
echo ========================================
echo Setup Complete!
echo ========================================
echo.
echo Next Steps:
echo 1. Start Laravel Server:
echo    %PHP% artisan serve
echo.
echo 2. Open Browser:
echo    http://localhost:8000
echo.
echo 3. Dashboard should load!
echo.
pause
