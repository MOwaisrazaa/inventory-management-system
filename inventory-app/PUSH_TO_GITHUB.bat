@echo off
echo ========================================
echo GitHub Pe Push Karne Ki Script
echo ========================================
echo.

REM Change to project directory
cd /d E:\xampp\htdocs\inventory-app

echo Step 1: Git status check kar rahe hain...
git status

echo.
echo Step 2: Sari files add kar rahe hain...
git add .

echo.
echo Step 3: Commit bana rahe hain...
git commit -m "Initial commit: Laravel Inventory Management System with Sales, Purchases, Items, Vendors, Customers"

echo.
echo ========================================
echo Ab aapko ye karna hai:
echo ========================================
echo.
echo 1. GitHub pe jao aur new repository banao
echo 2. Repository URL copy karo (example: https://github.com/username/repo-name.git)
echo 3. Neeche wali command mein apna URL paste karo:
echo.
echo    git remote add origin YOUR_GITHUB_REPO_URL
echo    git branch -M main
echo    git push -u origin main
echo.
echo Example:
echo    git remote add origin https://github.com/hashain/inventory-app.git
echo    git branch -M main
echo    git push -u origin main
echo.
echo ========================================
pause
