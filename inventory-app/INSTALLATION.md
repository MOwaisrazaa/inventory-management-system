# Complete Installation Guide

## 🖥️ System Requirements

- **PHP**: 8.2 or higher
- **MySQL**: 5.7 or higher
- **Composer**: Latest version
- **RAM**: 512MB minimum
- **Disk Space**: 500MB minimum

---

## 🪟 Windows Installation

### Step 1: Install PHP

1. Download PHP 8.2+ (Thread Safe) from https://www.php.net/downloads.php
2. Extract to `C:\php`
3. Rename `php.ini-development` to `php.ini`
4. Add to System Environment Variables:
   - Variable: `PATH`
   - Value: `C:\php`
5. Verify installation:
   ```bash
   php --version
   ```

### Step 2: Install MySQL

1. Download MySQL from https://dev.mysql.com/downloads/mysql/
2. Run installer and follow setup wizard
3. Default credentials:
   - Username: `root`
   - Password: (leave blank or set your own)
4. Start MySQL service

### Step 3: Install Composer

1. Download from https://getcomposer.org/download/
2. Run installer (Composer-Setup.exe)
3. Select PHP executable path: `C:\php\php.exe`
4. Verify installation:
   ```bash
   composer --version
   ```

### Step 4: Setup Project

1. Open Command Prompt in project directory
2. Run setup script:
   ```bash
   setup.bat
   ```
   
   OR manually:
   ```bash
   composer install
   copy .env.example .env
   php artisan key:generate
   php artisan migrate
   ```

### Step 5: Start Server

```bash
php artisan serve
```

Open browser: **http://localhost:8000**

---

## 🍎 macOS Installation

### Step 1: Install Homebrew (if not installed)

```bash
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
```

### Step 2: Install PHP

```bash
brew install php@8.2
brew link php@8.2
php --version
```

### Step 3: Install MySQL

```bash
brew install mysql
brew services start mysql
mysql -u root
```

### Step 4: Install Composer

```bash
brew install composer
composer --version
```

### Step 5: Setup Project

```bash
chmod +x setup.sh
./setup.sh
```

### Step 6: Start Server

```bash
php artisan serve
```

---

## 🐧 Linux Installation (Ubuntu/Debian)

### Step 1: Update System

```bash
sudo apt update
sudo apt upgrade -y
```

### Step 2: Install PHP

```bash
sudo apt install php8.2 php8.2-mysql php8.2-xml php8.2-curl -y
php --version
```

### Step 3: Install MySQL

```bash
sudo apt install mysql-server -y
sudo mysql_secure_installation
```

### Step 4: Install Composer

```bash
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
composer --version
```

### Step 5: Setup Project

```bash
chmod +x setup.sh
./setup.sh
```

### Step 6: Start Server

```bash
php artisan serve
```

---

## ⚙️ Manual Setup (All Platforms)

If automated scripts don't work:

### 1. Install Dependencies
```bash
composer install
```

### 2. Create Environment File
```bash
# Windows
copy .env.example .env

# Linux/Mac
cp .env.example .env
```

### 3. Generate Application Key
```bash
php artisan key:generate
```

### 4. Configure Database

Edit `.env` file:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventory_db
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Create Database

```bash
# Using MySQL command line
mysql -u root -p
CREATE DATABASE inventory_db;
EXIT;
```

### 6. Run Migrations
```bash
php artisan migrate
```

### 7. Start Development Server
```bash
php artisan serve
```

---

## 🔍 Verification Checklist

After installation, verify:

- [ ] PHP version is 8.2+
- [ ] Composer is installed
- [ ] MySQL is running
- [ ] Database `inventory_db` exists
- [ ] `.env` file is configured
- [ ] Application key is generated
- [ ] Migrations completed successfully
- [ ] Server starts without errors
- [ ] Dashboard loads at http://localhost:8000

---

## 🐛 Troubleshooting

### Error: "No application encryption key has been specified"
```bash
php artisan key:generate
```

### Error: "SQLSTATE[HY000]: General error: 1030"
- Ensure MySQL is running
- Check database credentials in `.env`
- Verify database exists

### Error: "Class not found"
```bash
composer dump-autoload
```

### Error: "Port 8000 already in use"
```bash
php artisan serve --port=8001
```

### Error: "Permission denied" (Linux/Mac)
```bash
chmod +x setup.sh
chmod +x artisan
```

### Error: "PHP extension missing"
```bash
# Ubuntu/Debian
sudo apt install php8.2-{mysql,xml,curl,mbstring}

# macOS
brew install php@8.2
```

### MySQL Connection Failed
1. Verify MySQL is running:
   ```bash
   # Windows: Check Services
   # Linux: sudo systemctl status mysql
   # Mac: brew services list
   ```
2. Test connection:
   ```bash
   mysql -u root -p
   ```
3. Check `.env` credentials

---

## 📱 Access Application

Once server is running:

- **URL**: http://localhost:8000
- **Dashboard**: Shows overview
- **Purchases**: Manage vendor purchases
- **Sales**: Manage customer sales
- **Cash Book**: Track receipts & payments

---

## 🔐 Security Notes

1. Change default database password
2. Update `.env` file permissions (not readable by web)
3. Use strong passwords for production
4. Enable HTTPS in production
5. Keep Laravel and dependencies updated

---

## 📚 Next Steps

1. Read [QUICKSTART.md](QUICKSTART.md) for quick reference
2. Check [PROJECT_STRUCTURE.md](PROJECT_STRUCTURE.md) for code organization
3. Review [README.md](README.md) for full documentation
4. Start adding vendors, customers, and items

---

## 💡 Tips

- Use `php artisan tinker` for interactive shell
- Check `storage/logs/laravel.log` for errors
- Use `php artisan migrate:fresh` to reset database
- Enable debug mode in `.env` for development: `APP_DEBUG=true`

---

## 📞 Support

For issues:
1. Check error logs in `storage/logs/`
2. Review troubleshooting section above
3. Verify all requirements are met
4. Check Laravel documentation: https://laravel.com/docs

Happy coding! 🚀
