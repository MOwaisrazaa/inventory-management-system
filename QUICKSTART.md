# Quick Start Guide - Inventory Management System

## 🚀 Fast Setup (5 minutes)

### Prerequisites
- PHP 8.2+
- MySQL 5.7+
- Composer

### Step 1: Install Dependencies
```bash
cd inventory-app
composer install
```

### Step 2: Setup Environment
```bash
copy .env.example .env
php artisan key:generate
```

### Step 3: Database Configuration
Edit `.env` file:
```
DB_DATABASE=inventory_db
DB_USERNAME=root
DB_PASSWORD=
```

### Step 4: Run Migrations
```bash
php artisan migrate
```

### Step 5: Start Server
```bash
php artisan serve
```

Open browser: **http://localhost:8000**

---

## 📊 Features Overview

### Dashboard
- Total Purchases & Sales
- Cash Balance
- Recent Transactions
- Inventory Summary

### Purchases Module
- Add/Edit/Delete purchases
- Track vendor information
- Automatic inventory updates
- Amount calculation

### Sales Module
- Add/Edit/Delete sales
- Customer management
- Inventory deduction
- Sales tracking

### Cash Book
- Receipt tracking
- Payment tracking
- Balance calculation
- Transaction history

---

## 🗂️ Project Structure

```
inventory-app/
├── app/
│   ├── Models/          # Database models
│   └── Http/Controllers/ # Business logic
├── database/
│   └── migrations/      # Database schema
├── resources/
│   └── views/           # Blade templates
├── routes/
│   └── web.php          # URL routes
├── config/              # Configuration files
└── public/              # Entry point
```

---

## 🔧 Common Commands

```bash
# Create new model
php artisan make:model ModelName

# Create new controller
php artisan make:controller ControllerName

# Run migrations
php artisan migrate

# Rollback migrations
php artisan migrate:rollback

# Fresh database
php artisan migrate:fresh

# Tinker (interactive shell)
php artisan tinker
```

---

## 📝 Sample Data Entry

### Add Vendor
1. Go to Purchases → Add Purchase
2. Create new vendor if needed
3. Fill vendor details

### Add Item
1. Go to Purchases → Add Purchase
2. Select item or create new
3. Set purchase price

### Record Purchase
1. Select date, vendor, item
2. Enter quantity and rate
3. Amount auto-calculates
4. Save

### Record Sale
1. Go to Sales → Add Sale
2. Select customer, item
3. Enter quantity and rate
4. Inventory auto-updates

### Cash Transactions
1. Go to Cash Book → Add Transaction
2. Select Receipt or Payment
3. Enter amount and details
4. Save

---

## 🐛 Troubleshooting

**Error: "No application encryption key has been specified"**
```bash
php artisan key:generate
```

**Error: "SQLSTATE[HY000]: General error: 1030"**
- Check MySQL is running
- Verify database credentials in .env

**Error: "Class not found"**
```bash
composer dump-autoload
```

**Port 8000 already in use**
```bash
php artisan serve --port=8001
```

---

## 📞 Support

For issues or questions, check the README.md file for detailed documentation.

Happy Inventory Management! 📦
