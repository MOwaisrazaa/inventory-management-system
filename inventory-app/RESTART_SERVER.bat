@echo off
echo ========================================
echo Restarting Laravel Server
echo ========================================
echo.
echo Step 1: Clearing all caches...
echo.

cd /d E:\xampp\htdocs\inventory-app

E:\xampp\php\php.exe artisan route:clear
E:\xampp\php\php.exe artisan view:clear
E:\xampp\php\php.exe artisan config:clear
E:\xampp\php\php.exe artisan cache:clear

echo.
echo ========================================
echo Cache cleared successfully!
echo ========================================
echo.
echo Step 2: Now MANUALLY do this:
echo.
echo 1. Go to the terminal where server is running
echo 2. Press Ctrl+C to stop the server
echo 3. Run this command again:
echo    E:\xampp\php\php.exe artisan serve
echo.
echo 4. Then refresh browser with Ctrl+Shift+R
echo.
echo ========================================
pause
