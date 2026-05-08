# 📦 Inventory Management System

A complete **Laravel-based Inventory Management System** with Sales, Purchases, Items, Vendors, and Customers management.

## ✨ Features

### 📊 Dashboard
- Total Purchases, Sales, Items, Cash Balance statistics
- Recent Purchases and Sales with Qty, Rate, Amount
- Visual cards with gradient colors

### 📦 Items Management
- Add, Edit, Delete items
- SKU support (optional) for variants/colors/sizes
- Purchase price and Selling price tracking
- Stock quantity management
- Unit-based inventory (Piece, Kg, Liter, Box, etc.)

### 🚚 Vendors Management
- Vendor contact information (Name, Email, Phone, Address)
- Purchase history per vendor
- Statistics: Total purchases, Total amount, Average purchase
- Recent 10 purchases from each vendor

### 👥 Customers Management
- **Auto-save customers** when creating sales
- Customer contact information
- Sales history per customer
- Statistics: Total sales, Total amount, Average sale
- Recent 10 sales to each customer

### 🏭 Inventory Tracking
- Real-time stock levels
- Low stock alerts (< 10 items)
- Color-coded stock status (Green, Yellow, Red)
- Search and filter functionality
- Total inventory value calculation
- Recent transactions overview

### 🛒 Purchases Management
- Record purchases from vendors
- Auto-fill purchase price when item selected
- Auto-calculate total amount
- SKU display in dropdown and purchase list
- Current stock display
- Purchase history tracking

### 💰 Sales Management
- Record sales to customers
- **Auto-create customers** from sales form
- Auto-fill selling price when item selected
- Auto-calculate total amount
- SKU display in dropdown and sales list
- Automatic inventory deduction
- Sales history tracking

### 📖 Cash Book
- Track all cash transactions
- Income and expense management

## 🎯 Key Highlights

- ✅ **SKU Support** - Track product variants (colors, sizes, models)
- ✅ **Auto-save Customers** - No need to create customers separately
- ✅ **Auto-fill Prices** - Automatic price population
- ✅ **Auto-calculate Totals** - Real-time calculation
- ✅ **Stock Alerts** - Low stock notifications
- ✅ **Responsive Design** - Bootstrap 5 based UI
- ✅ **Clean Interface** - User-friendly dashboard

## 🛠️ Tech Stack

- **Backend:** Laravel 10.x
- **Frontend:** Blade Templates, Bootstrap 5
- **Database:** MySQL
- **Icons:** Font Awesome 6
- **Server:** XAMPP (Apache + MySQL)

## 📋 Requirements

- PHP 8.1 or higher
- MySQL 5.7 or higher
- Composer
- XAMPP (or any LAMP/WAMP stack)

## 🚀 Installation

### 1. Clone Repository
```bash
git clone https://github.com/YOUR_USERNAME/inventory-management-system.git
cd inventory-management-system
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Environment Setup
```bash
copy .env.example .env
php artisan key:generate
```

### 4. Database Configuration
Edit `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventory_db
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Create Database
- Open phpMyAdmin: http://localhost/phpmyadmin
- Create database: `inventory_db`

### 6. Run Migrations
```bash
php artisan migrate
```

### 7. Start Server
```bash
php artisan serve
```

### 8. Access Application
Open browser: http://localhost:8000

## 📊 Database Schema

### Items Table
- name, sku (optional), description
- purchase_price, selling_price
- quantity, unit

### Vendors Table
- name, email, phone, address

### Customers Table
- name, email, phone, address

### Purchases Table
- purchase_date, vendor_id, item_id
- quantity, rate, amount
- status, notes

### Sales Table
- sale_date, customer_id, item_id
- quantity, rate, amount
- status, notes

### Cash Book Table
- date, type (income/expense)
- amount, description

## 🎨 Screenshots

### Dashboard
- Statistics cards with total purchases, sales, items, cash balance
- Recent purchases and sales tables

### Items Management
- List all items with SKU, prices, stock levels
- Add/Edit items with optional SKU

### Sales Page
- Customer name input (auto-saves customer)
- Item dropdown with SKU display
- Auto-fill prices and calculate totals

### Purchase Page
- Vendor selection
- Item dropdown with SKU display
- Auto-fill prices and calculate totals

## 💡 Usage Tips

### Adding Items with SKU
```
Item: T-Shirt Red
SKU: TSH-RED-M (for Medium size)
SKU: TSH-RED-L (for Large size)
```

### Creating Sales
1. Enter customer name (will auto-save)
2. Select item (SKU shows in dropdown)
3. Enter quantity
4. Price auto-fills, total auto-calculates
5. Save - Customer automatically created!

### Tracking Inventory
- Green badge: Stock > 50
- Yellow badge: Stock 10-50
- Red badge: Stock < 10

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## 📝 License

This project is open-source and available under the MIT License.

## 👨‍💻 Author

Created with ❤️ for efficient inventory management

## 📞 Support

For issues or questions, please open an issue on GitHub.

---

**Happy Inventory Management! 🚀**
