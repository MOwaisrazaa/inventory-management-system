#!/bin/bash

# Inventory Management System - Setup Script for Linux/Mac

echo ""
echo "========================================"
echo "Inventory Management System Setup"
echo "========================================"
echo ""

# Check if composer is installed
if ! command -v composer &> /dev/null; then
    echo "ERROR: Composer is not installed!"
    echo "Please install Composer from: https://getcomposer.org/download/"
    exit 1
fi

# Check if PHP is installed
if ! command -v php &> /dev/null; then
    echo "ERROR: PHP is not installed!"
    echo "Please install PHP 8.2+ from: https://www.php.net/downloads.php"
    exit 1
fi

echo "[1/5] Installing PHP dependencies..."
composer install
if [ $? -ne 0 ]; then
    echo "ERROR: Composer install failed!"
    exit 1
fi

echo ""
echo "[2/5] Creating .env file..."
if [ ! -f .env ]; then
    cp .env.example .env
    echo ".env file created!"
else
    echo ".env file already exists!"
fi

echo ""
echo "[3/5] Generating application key..."
php artisan key:generate

echo ""
echo "[4/5] Running database migrations..."
echo "Make sure MySQL is running and database credentials are correct in .env"
read -p "Press Enter to continue..."
php artisan migrate

echo ""
echo "[5/5] Setup complete!"
echo ""
echo "========================================"
echo "Next Steps:"
echo "========================================"
echo "1. Open .env file and verify database settings"
echo "2. Run: php artisan serve"
echo "3. Open browser: http://localhost:8000"
echo ""
