# Composer Installation - Complete Guide

## 🎯 Composer Kya Hai?

Composer ek **PHP Package Manager** hai jo Laravel ke dependencies (libraries) ko manage karta hai.

**Analogy:** 
- npm = Node.js ke liye
- pip = Python ke liye
- **Composer = PHP ke liye** ✓

---

## ⚠️ Important: PHP Pehle Install Karo!

Composer install karne se pehle **PHP install hona chahiye** kyunki Composer ko PHP chahiye.

### PHP Installation Order:
1. ✅ PHP install karo
2. ✅ PHP ko PATH mein add karo
3. ✅ Verify: `php --version`
4. ✅ Phir Composer install karo

---

## 📥 Composer Download Karo

### Step 1: Website Kholo
```
https://getcomposer.org/download/
```

### Step 2: Windows Users ke liye

**Option A: Installer (Easiest)**

```
Composer-Setup.exe download karo
Size: ~5-10 MB
```

**Option B: Manual Installation**

```
composer.phar download karo
Size: ~2-3 MB
```

### Step 3: Download Link

**Direct Link (Installer):**
```
https://getcomposer.org/Composer-Setup.exe
```

**Direct Link (Manual):**
```
https://getcomposer.org/composer.phar
```

---

## 🚀 Installation Method 1: Installer (EASY)

### Step 1: Installer Download Karo

```
https://getcomposer.org/Composer-Setup.exe
```

### Step 2: Installer Run Karo

1. Downloaded file ko double-click karo
2. "Yes" button click karo (UAC prompt)
3. Installation wizard khul jayega

### Step 3: Installation Wizard Follow Karo

**Screen 1: Welcome**
- "Next" button click karo

**Screen 2: PHP Executable**
```
PHP path select karo:
- Agar XAMPP use kar rahe ho: C:\xampp\php\php.exe
- Agar manual install kiya: C:\php\php.exe
```
- "Next" button click karo

**Screen 3: Settings**
```
Default settings theek hain
```
- "Next" button click karo

**Screen 4: Ready to Install**
- "Install" button click karo
- Installation complete hone ka wait karo (1-2 minute)

**Screen 5: Installation Complete**
- "Finish" button click karo

### Step 4: Verify Karo

Command Prompt kholo:
```bash
composer --version
```

Output:
```
Composer version 2.x.x
```

✓ Success!

---

## 🚀 Installation Method 2: Manual (ADVANCED)

### Step 1: composer.phar Download Karo

```
https://getcomposer.org/composer.phar
```

### Step 2: File Ko Move Karo

```
Downloaded: composer.phar
Move to: C:\composer\
```

### Step 3: Batch File Create Karo

`C:\composer\composer.bat` file create karo:

```batch
@echo off
php "%~dp0composer.phar" %*
```

### Step 4: PATH Mein Add Karo

1. Windows key + X → "System"
2. "Advanced system settings"
3. "Environment Variables"
4. "Path" select → "Edit"
5. "New" → `C:\composer`
6. "OK" (3 baar)

### Step 5: Verify Karo

Command Prompt kholo:
```bash
composer --version
```

Output:
```
Composer version 2.x.x
```

✓ Success!

---

## 🎯 XAMPP ke saath Composer

### Agar XAMPP use kar rahe ho:

**Step 1: XAMPP Control Panel kholo**
```
Start Menu → XAMPP → XAMPP Control Panel
```

**Step 2: Apache start karo**
- "Apache" → "Start" button

**Step 3: MySQL start karo**
- "MySQL" → "Start" button

**Step 4: Command Prompt kholo**
```
Start Menu → cmd
```

**Step 5: Project folder mein jao**
```bash
cd C:\xampp\htdocs\inventory-app
```

**Step 6: Composer install karo**
```bash
composer install
```

---

## 🎯 Manual Installation ke saath Composer

### Agar manual install kiya hai:

**Step 1: Command Prompt kholo**
```
Start Menu → cmd
```

**Step 2: Project folder mein jao**
```bash
cd inventory-app
```

**Step 3: Composer install karo**
```bash
composer install
```

---

## 📋 Composer Commands

### Basic Commands:

```bash
# Version check karo
composer --version

# Help dekho
composer help

# Project dependencies install karo
composer install

# New package add karo
composer require package-name

# Update packages
composer update

# Dump autoloader
composer dump-autoload
```

### Laravel Specific:

```bash
# Laravel project create karo
composer create-project laravel/laravel project-name

# Laravel dependencies install karo
composer install

# Update Laravel
composer update
```

---

## 🐛 Common Issues

### Issue 1: "php is not recognized"

**Solution:**
- PHP install nahi hai
- PHP PATH mein add nahi hai
- Command Prompt restart karo

### Issue 2: "Composer not found"

**Solution:**
- Composer install nahi hua
- Composer PATH mein add nahi hai
- Command Prompt restart karo

### Issue 3: "Failed to download"

**Solution:**
```bash
# Cache clear karo
composer clear-cache

# Dobara try karo
composer install
```

### Issue 4: "Memory limit exceeded"

**Solution:**
```bash
# Memory limit increase karo
php -d memory_limit=-1 composer.phar install
```

### Issue 5: "SSL certificate problem"

**Solution:**
```bash
# Disable SSL verification (temporary)
composer config -g disable-tls true

# Dobara try karo
composer install

# Enable SSL back
composer config -g disable-tls false
```

---

## ✅ Composer Installation Checklist

- [ ] PHP installed aur working
- [ ] `php --version` command works
- [ ] Composer downloaded
- [ ] Composer installed
- [ ] `composer --version` command works
- [ ] Project folder mein jao
- [ ] `composer install` run karo
- [ ] Dependencies install ho gaye
- [ ] `vendor/` folder create ho gaya

---

## 🚀 After Composer Installation

### Step 1: Laravel Project Setup

```bash
cd inventory-app
composer install
```

### Step 2: Environment File

```bash
copy .env.example .env
```

### Step 3: Application Key

```bash
php artisan key:generate
```

### Step 4: Database Configuration

Edit `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventory_db
DB_USERNAME=root
DB_PASSWORD=
```

### Step 5: Database Create

```bash
mysql -u root -p
CREATE DATABASE inventory_db;
EXIT;
```

### Step 6: Migrations

```bash
php artisan migrate
```

### Step 7: Server Start

```bash
php artisan serve
```

### Step 8: Browser

```
http://localhost:8000
```

---

## 📊 Composer File Structure

After `composer install`, yeh files create hoti hain:

```
inventory-app/
├── vendor/              (All dependencies)
├── composer.json        (Project dependencies list)
├── composer.lock        (Locked versions)
└── ...
```

**Important:** `vendor/` folder ko git mein commit mat karo!

---

## 💡 Tips

✓ Composer install karne se pehle PHP verify karo
✓ Internet connection stable hona chahiye
✓ `composer install` slow ho sakta hai (2-5 minute)
✓ Antivirus Composer ko block kar sakta hai
✓ Regular `composer update` karo

---

## 📞 Help Resources

- **Composer Official:** https://getcomposer.org/
- **Composer Documentation:** https://getcomposer.org/doc/
- **Laravel Documentation:** https://laravel.com/docs

---

## 🎯 Quick Summary

```
1. PHP install karo
2. Composer download karo
3. Composer install karo
4. Verify: composer --version
5. Project folder mein jao
6. composer install run karo
7. Done!
```

---

## ✅ Success Indicators

✓ `composer --version` shows version
✓ `composer install` completes without errors
✓ `vendor/` folder created
✓ `composer.lock` file created
✓ No error messages

---

**Happy Composer Installation! 🚀**

