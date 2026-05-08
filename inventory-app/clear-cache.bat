@echo off
echo ========================================
echo Clearing Laravel Cache...
echo ========================================

cd /d "%~dp0"

echo.
echo [1/4] Clearing route cache...
php artisan route:clear

echo.
echo [2/4] Clearing view cache...
php artisan view:clear

echo.
echo [3/4] Clearing config cache...
php artisan config:clear

echo.
echo [4/4] Clearing application cache...
php artisan cache:clear

echo.
echo ========================================
echo Cache cleared successfully!
echo ========================================
echo.
echo Now restart your server:
echo 1. Stop the server (Ctrl+C in the terminal)
echo 2. Run: php artisan serve
echo.
pause
