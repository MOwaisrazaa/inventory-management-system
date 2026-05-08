# PHP, Composer aur Laravel Installation Guide (Hindi)

## 🪟 Windows par Installation

### Step 1: PHP Install Karo

#### Option A: Direct Download (Recommended)

1. **PHP Download Karo**
   - Website: https://www.php.net/downloads.php
   - "Windows downloads" section mein jao
   - "VS16 x64 Non Thread Safe" download karo (PHP 8.2 ya 8.3)
   - File name: `php-8.x.x-nts-Win32-vs16-x64.zip`

2. **Extract Karo**
   - Downloaded zip file ko extract karo
   - `C:\php` folder mein extract karo
   - Example: `C:\php\php.exe`

3. **Environment Variable Add Karo**
   - Windows key + X dabao → "System" select karo
   - "Advanced system settings" click karo
   - "Environment Variables" button click karo
   - "Path" variable select karo → "Edit" click karo
   - "New" button click karo
   - Type karo: `C:\php`
   - "OK" click karo (3 baar)

4. **Verify Karo**
   - Command Prompt kholo (Win + R → cmd → Enter)
   - Type karo: `php --version`
   - Output: `PHP 8.x.x` dikhna chahiye

---

### Step 2: Composer Install Karo

#### Option A: Installer (Easiest)

1. **Composer Installer Download Karo**
   - Website: https://getcomposer.org/download/
   - "Composer-Setup.exe" download karo

2. **Installer Run Karo**
   - Downloaded file ko double-click karo
   - "Next" click karo
   - PHP path select karo: `C:\php\php.exe`
   - "Next" click karo
   - "Install" click karo
   - Installation complete hone ka wait karo

3. **Verify Karo**
   - Command Prompt kholo
   - Type karo: `composer --version`
   - Output: `Composer version x.x.x` dikhna chahiye

#### Option B: Manual Download

1. Website: https://getcomposer.org/download/
2. "Command-line installation" section follow karo
3. Commands copy-paste karo Command Prompt mein

---

### Step 3: MySQL Install Karo

1. **MySQL Download Karo**
   - Website: https://dev.mysql.com/downloads/mysql/
   - "MySQL Community Server" download karo
   - Latest version select karo

2. **Installer Run Karo**
   - Downloaded file ko double-click karo
   - "Setup Type" → "Developer Default" select karo
   - "Next" click karo
   - Installation complete hone ka wait karo

3. **MySQL Configure Karo**
   - "MySQL Server 8.0.x" select karo
   - "Next" click karo
   - "Standalone MySQL Server" select karo
   - "Next" click karo
   - Port: `3306` (default)
   - "Next" click karo
   - "MySQL Server as a Windows Service" check karo
   - Service name: `MySQL80` (default)
   - "Next" click karo
   - "Execute" click karo
   - Configuration complete hone ka wait karo

4. **MySQL Start Karo**
   - Services app kholo (Win + R → services.msc)
   - "MySQL80" find karo
   - Right-click → "Start" karo

---

### Step 4: Laravel Project Setup Karo

1. **Project Folder Mein Jao**
   ```bash
   cd inventory-app
   ```

2. **Dependencies Install Karo**
   ```bash
   composer install
   ```
   - Yeh 2-3 minute le sakta hai
   - Wait karo jab tak complete na ho jaye

3. **Environment File Create Karo**
   ```bash
   copy .env.example .env
   ```

4. **Application Key Generate Karo**
   ```bash
   php artisan key:generate
   ```

5. **Database Configure Karo**
   - `.env` file kholo (Notepad mein)
   - Yeh lines find karo:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=inventory_db
   DB_USERNAME=root
   DB_PASSWORD=
   ```
   - Agar MySQL password set kiya hai toh `DB_PASSWORD=` mein password likho
   - File save karo

6. **Database Create Karo**
   - Command Prompt kholo
   - Type karo:
   ```bash
   mysql -u root -p
   ```
   - Password enter karo (agar set kiya hai)
   - Yeh command type karo:
   ```sql
   CREATE DATABASE inventory_db;
   EXIT;
   ```

7. **Migrations Run Karo**
   ```bash
   php artisan migrate
   ```
   - Yeh database tables create karega

8. **Server Start Karo**
   ```bash
   php artisan serve
   ```
   - Output: `Server running at http://127.0.0.1:8000`

9. **Browser Mein Open Karo**
   - Browser kholo
   - URL: `http://localhost:8000`
   - Dashboard dikhna chahiye!

---

## 🍎 macOS par Installation

### Step 1: Homebrew Install Karo (agar nahi hai)

```bash
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
```

### Step 2: PHP Install Karo

```bash
brew install php@8.2
brew link php@8.2
php --version
```

### Step 3: Composer Install Karo

```bash
brew install composer
composer --version
```

### Step 4: MySQL Install Karo

```bash
brew install mysql
brew services start mysql
```

### Step 5: Laravel Setup Karo

```bash
cd inventory-app
composer install
cp .env.example .env
php artisan key:generate
```

Edit `.env` file:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventory_db
DB_USERNAME=root
DB_PASSWORD=
```

```bash
mysql -u root
CREATE DATABASE inventory_db;
EXIT;

php artisan migrate
php artisan serve
```

Browser mein: `http://localhost:8000`

---

## 🐧 Linux (Ubuntu/Debian) par Installation

### Step 1: System Update Karo

```bash
sudo apt update
sudo apt upgrade -y
```

### Step 2: PHP Install Karo

```bash
sudo apt install php8.2 php8.2-mysql php8.2-xml php8.2-curl php8.2-mbstring -y
php --version
```

### Step 3: Composer Install Karo

```bash
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
composer --version
```

### Step 4: MySQL Install Karo

```bash
sudo apt install mysql-server -y
sudo mysql_secure_installation
```

### Step 5: Laravel Setup Karo

```bash
cd inventory-app
composer install
cp .env.example .env
php artisan key:generate
```

Edit `.env` file:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventory_db
DB_USERNAME=root
DB_PASSWORD=
```

```bash
mysql -u root -p
CREATE DATABASE inventory_db;
EXIT;

php artisan migrate
php artisan serve
```

Browser mein: `http://localhost:8000`

---

## ✅ Verification Checklist

Installation ke baad check karo:

- [ ] `php --version` command karo → PHP version dikhna chahiye
- [ ] `composer --version` command karo → Composer version dikhna chahiye
- [ ] MySQL running hai (Services mein check karo)
- [ ] `inventory_db` database create ho gaya
- [ ] `php artisan migrate` successfully run hua
- [ ] `php artisan serve` server start hua
- [ ] Browser mein `http://localhost:8000` open hua
- [ ] Dashboard page load hua

---

## 🐛 Common Issues aur Solutions

### Issue 1: "php is not recognized"
**Solution:**
- PHP path Environment Variables mein add nahi hua
- Dobara add karo: `C:\php`
- Command Prompt restart karo

### Issue 2: "composer is not recognized"
**Solution:**
- Composer installer properly install nahi hua
- Dobara install karo: https://getcomposer.org/download/
- Command Prompt restart karo

### Issue 3: "SQLSTATE[HY000]: General error: 1030"
**Solution:**
- MySQL running nahi hai
- MySQL service start karo (Services app mein)
- `.env` mein database credentials check karo

### Issue 4: "No application encryption key has been specified"
**Solution:**
```bash
php artisan key:generate
```

### Issue 5: "Port 8000 already in use"
**Solution:**
```bash
php artisan serve --port=8001
```

### Issue 6: "Class not found"
**Solution:**
```bash
composer dump-autoload
```

---

## 📞 Help Resources

- PHP Docs: https://www.php.net/docs.php
- Composer Docs: https://getcomposer.org/doc/
- Laravel Docs: https://laravel.com/docs
- MySQL Docs: https://dev.mysql.com/doc/

---

## 🎯 Installation Order (Important!)

**Yeh order follow karo:**

1. ✅ PHP install karo
2. ✅ Composer install karo
3. ✅ MySQL install karo
4. ✅ Laravel project setup karo
5. ✅ Database create karo
6. ✅ Migrations run karo
7. ✅ Server start karo

---

## 💡 Tips

- Installation ke baad har step verify karo
- Error aaye toh Google mein search karo
- Patience rakho, installation 10-15 minute le sakta hai
- Agar stuck ho jao toh documentation files padho

---

**Happy Installation! 🚀**

Agar koi problem ho toh documentation files check karo ya Google search karo.

