@echo off
echo ========================================
echo Copying Updated Files to XAMPP
echo ========================================
echo.

REM Check if XAMPP inventory-app exists
if not exist "E:\xampp\htdocs\inventory-app" (
    echo ERROR: E:\xampp\htdocs\inventory-app folder not found!
    echo.
    echo Please tell me the correct location where your app is running.
    echo.
    pause
    exit /b 1
)

echo Copying files...
echo.

REM Copy layout file
echo [1/6] Copying layout.blade.php...
copy "E:\inventery-app\inventory-app\resources\views\layout.blade.php" "E:\xampp\htdocs\inventory-app\resources\views\layout.blade.php" /Y

REM Copy routes
echo [2/6] Copying web.php...
copy "E:\inventery-app\inventory-app\routes\web.php" "E:\xampp\htdocs\inventory-app\routes\web.php" /Y

REM Copy controllers
echo [3/6] Copying ItemController.php...
copy "E:\inventery-app\inventory-app\app\Http\Controllers\ItemController.php" "E:\xampp\htdocs\inventory-app\app\Http\Controllers\ItemController.php" /Y

echo [4/6] Copying InventoryController.php...
copy "E:\inventery-app\inventory-app\app\Http\Controllers\InventoryController.php" "E:\xampp\htdocs\inventory-app\app\Http\Controllers\InventoryController.php" /Y

REM Copy views folders
echo [5/6] Copying items views...
xcopy "E:\inventery-app\inventory-app\resources\views\items" "E:\xampp\htdocs\inventory-app\resources\views\items" /E /I /Y

echo [6/6] Copying inventory views...
xcopy "E:\inventery-app\inventory-app\resources\views\inventory" "E:\xampp\htdocs\inventory-app\resources\views\inventory" /E /I /Y

echo.
echo ========================================
echo Files copied successfully!
echo ========================================
echo.
echo Now do this:
echo 1. Go to terminal where server is running
echo 2. Press Ctrl+C to stop server
echo 3. Run: E:\xampp\php\php.exe artisan serve
echo 4. Refresh browser with Ctrl+Shift+R
echo.
echo You should see Items and Inventory in sidebar!
echo.
pause
