# 📦 Inventory Management System

A comprehensive **Laravel-based Inventory Management System** designed for small to medium businesses to efficiently manage their inventory, sales, purchases, vendors, and customers.

![Laravel](https://img.shields.io/badge/Laravel-10.x-red)
![PHP](https://img.shields.io/badge/PHP-8.1+-blue)
![MySQL](https://img.shields.io/badge/MySQL-5.7+-orange)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-purple)

---

## 🌟 Features

### 📊 **Dashboard**
- Real-time statistics display
  - Total Purchases Amount
  - Total Sales Amount
  - Total Items Count
  - Cash Balance
- Recent Purchases table with Date, Vendor, Item, Qty, Rate, Amount
- Recent Sales table with Date, Customer, Item, Qty, Rate, Amount
- Beautiful gradient cards with visual appeal

### 📦 **Items Management**
- Complete CRUD operations (Create, Read, Update, Delete)
- **SKU Support** (Optional) - Perfect for tracking product variants
  - Colors (e.g., T-Shirt Red [TSH-RED-M])
  - Sizes (e.g., Shoes Size 8 [SHO-08])
  - Models (e.g., iPhone 13 128GB [IPH13-128])
- Purchase Price and Selling Price tracking
- Stock Quantity management with units (Piece, Kg, Liter, Box, Dozen, Meter)
- Low stock alerts with color-coded badges
  - 🔴 Red: Stock < 10
  - 🟡 Yellow: Stock 10-50
  - 🟢 Green: Stock > 50

### 🚚 **Vendors Management**
- Vendor contact information (Name, Email, Phone, Address)
- Complete purchase history per vendor
- Vendor statistics dashboard
  - Total Purchases count
  - Total Amount spent
  - Average Purchase value
- Recent 10 purchases from each vendor with SKU display
- Edit and delete vendor records

### 👥 **Customers Management**
- **Auto-save feature** - Customers are automatically created when making sales
- No need to pre-create customers
- Customer contact information (Name, Email, Phone, Address)
- Complete sales history per customer
- Customer statistics dashboard
  - Total Sales count
  - Total Amount
  - Average Sale value
- Recent 10 sales to each customer with SKU display
- Manual customer creation also available

### 🏭 **Inventory Tracking**
- Real-time stock level monitoring
- Search and filter functionality
  - Search by item name or SKU
  - Filter by low stock items
- Color-coded stock status indicators
- Total inventory value calculation
- Recent transactions overview
- Statistics cards
  - Total Items
  - Low Stock Items count
  - Total Inventory Value
  - Total Sales Value

### 🛒 **Purchases Management**
- Record purchases from vendors
- **Auto-fill purchase price** when item is selected
- **Auto-calculate total amount** (Quantity × Rate)
- SKU display in dropdown: `Item Name [SKU] (Current Stock: X)`
- Alert box showing selected item details with SKU
- Current stock display to prevent over-ordering
- Purchase history tracking with SKU column
- Edit and delete purchase records

### 💰 **Sales Management**
- Record sales to customers
- **Auto-create customers** directly from sales form
  - Just enter customer name and phone
  - Customer automatically saved to database
- **Auto-fill selling price** when item is selected
- **Auto-calculate total amount** (Quantity × Rate)
- SKU display in dropdown: `Item Name [SKU] (Stock: X)`
- Alert box showing selected item details with SKU
- **Automatic inventory deduction** on sale
- Sales history tracking with SKU column
- Edit and delete sale records

### 📖 **Cash Book**
- Track all cash transactions
- Income and expense management
- Transaction history

---

## 🎯 Key Highlights

✅ **SKU Support** - Track product variants (colors, sizes, models) with optional SKU codes  
✅ **Auto-save Customers** - No need to create customers separately, they're auto-saved during sales  
✅ **Auto-fill Prices** - Automatic price population based on item selection  
✅ **Auto-calculate Totals** - Real-time calculation of total amounts  
✅ **Stock Alerts** - Visual low stock notifications with color coding  
✅ **Responsive Design** - Bootstrap 5 based mobile-friendly UI  
✅ **Clean Interface** - User-friendly dashboard with intuitive navigation  
✅ **Real-time Updates** - Inventory automatically updates on sales/purchases  

---

## 🛠️ Technology Stack

| Technology | Version | Purpose |
|------------|---------|---------|
| **Laravel** | 10.x | Backend Framework |
| **PHP** | 8.1+ | Server-side Language |
| **MySQL** | 5.7+ | Database |
| **Bootstrap** | 5.3 | Frontend Framework |
| **Font Awesome** | 6.4 | Icons |
| **Blade** | - | Templating Engine |

---

## 📋 System Requirements

- **PHP:** 8.1 or higher
- **MySQL:** 5.7 or higher
- **Composer:** Latest version
- **Web Server:** Apache (XAMPP recommended) or Nginx
- **Extensions:** 
  - OpenSSL
  - PDO
  - Mbstring
  - Tokenizer
  - XML
  - Ctype
  - JSON

---

## 🚀 Installation Guide

### Step 1: Clone Repository
```bash
git clone https://github.com/MOwaisrazaa/inventory-management-system.git
cd inventory-management-system
```

### Step 2: Install Dependencies
```bash
composer install
```

### Step 3: Environment Configuration
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### Step 4: Database Setup

Edit `.env` file with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventory_db
DB_USERNAME=root
DB_PASSWORD=
```

Create database in MySQL:
```sql
CREATE DATABASE inventory_db;
```

Or use phpMyAdmin:
1. Open http://localhost/phpmyadmin
2. Click "New" to create database
3. Name it `inventory_db`
4. Click "Create"

### Step 5: Run Migrations
```bash
php artisan migrate
```

This will create all necessary tables:
- vendors
- customers
- items
- purchases
- sales
- cash_book

### Step 6: Start Development Server
```bash
php artisan serve
```

### Step 7: Access Application
Open your browser and visit:
```
http://localhost:8000
```

---

## 📊 Database Schema

### **Items Table**
| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary key |
| name | varchar(255) | Item name |
| sku | varchar(255) | Stock Keeping Unit (optional) |
| description | text | Item description |
| purchase_price | decimal(10,2) | Purchase price per unit |
| selling_price | decimal(10,2) | Selling price per unit |
| quantity | integer | Current stock quantity |
| unit | varchar(50) | Unit of measurement |
| created_at | timestamp | Creation timestamp |
| updated_at | timestamp | Last update timestamp |

### **Vendors Table**
| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary key |
| name | varchar(255) | Vendor name |
| email | varchar(255) | Email address |
| phone | varchar(20) | Phone number |
| address | text | Physical address |
| created_at | timestamp | Creation timestamp |
| updated_at | timestamp | Last update timestamp |

### **Customers Table**
| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary key |
| name | varchar(255) | Customer name |
| email | varchar(255) | Email address |
| phone | varchar(20) | Phone number |
| address | text | Physical address |
| created_at | timestamp | Creation timestamp |
| updated_at | timestamp | Last update timestamp |

### **Purchases Table**
| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary key |
| purchase_date | date | Date of purchase |
| vendor_id | bigint | Foreign key to vendors |
| item_id | bigint | Foreign key to items |
| quantity | integer | Quantity purchased |
| rate | decimal(10,2) | Price per unit |
| amount | decimal(12,2) | Total amount (qty × rate) |
| status | varchar(50) | Status (completed/pending) |
| notes | text | Additional notes |
| created_at | timestamp | Creation timestamp |
| updated_at | timestamp | Last update timestamp |

### **Sales Table**
| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary key |
| sale_date | date | Date of sale |
| customer_id | bigint | Foreign key to customers |
| item_id | bigint | Foreign key to items |
| quantity | integer | Quantity sold |
| rate | decimal(10,2) | Price per unit |
| amount | decimal(12,2) | Total amount (qty × rate) |
| status | varchar(50) | Status (completed/pending) |
| notes | text | Additional notes |
| created_at | timestamp | Creation timestamp |
| updated_at | timestamp | Last update timestamp |

### **Cash Book Table**
| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary key |
| date | date | Transaction date |
| type | varchar(50) | Type (income/expense) |
| amount | decimal(12,2) | Transaction amount |
| description | text | Transaction description |
| created_at | timestamp | Creation timestamp |
| updated_at | timestamp | Last update timestamp |

---

## 💡 Usage Guide

### Adding Items with SKU

**Example 1: Clothing Store**
```
Item Name: T-Shirt Red
SKU: TSH-RED-S (Small size)
SKU: TSH-RED-M (Medium size)
SKU: TSH-RED-L (Large size)
```

**Example 2: Electronics**
```
Item Name: iPhone 13
SKU: IPH13-128-BLK (128GB Black)
SKU: IPH13-256-BLK (256GB Black)
```

**Example 3: Grocery**
```
Item Name: Rice
SKU: RICE-1KG (1 Kg pack)
SKU: RICE-5KG (5 Kg pack)
```

### Creating Sales (Auto-save Customer)

1. Navigate to **Sales** → **Add New Sale**
2. Enter **Customer Name** (e.g., "John Doe")
3. Enter **Customer Phone** (optional, e.g., "1234567890")
4. Select **Item** from dropdown (SKU will show: `Item Name [SKU] (Stock: X)`)
5. Alert box displays: "Selected Item: Item Name | SKU: XXX"
6. Enter **Quantity**
7. **Rate auto-fills** with selling price
8. **Total auto-calculates**
9. Click **Save Sale**
10. ✅ Customer automatically saved to database!
11. ✅ Inventory automatically reduced!

### Creating Purchases

1. Navigate to **Purchases** → **Add New Purchase**
2. Select **Vendor**
3. Select **Item** from dropdown (SKU will show: `Item Name [SKU] (Current Stock: X)`)
4. Alert box displays: "Selected Item: Item Name | SKU: XXX"
5. Enter **Quantity**
6. **Rate auto-fills** with purchase price
7. **Total auto-calculates**
8. Click **Save Purchase**
9. ✅ Inventory automatically increased!

### Tracking Inventory

- **Green Badge (>50):** Good stock level
- **Yellow Badge (10-50):** Medium stock, consider reordering
- **Red Badge (<10):** Low stock, reorder immediately!

Use search to find items by name or SKU
Use filter to show only low stock items

---

## 📸 Screenshots

### Dashboard
- Statistics cards showing total purchases, sales, items, and cash balance
- Recent purchases and sales tables with complete details

### Items Management
- List view with SKU, prices, stock levels, and color-coded status
- Add/Edit forms with optional SKU field

### Sales Page
- Customer name input field (auto-saves customer)
- Item dropdown with SKU display
- Auto-fill prices and auto-calculate totals
- Alert box showing selected item details

### Purchase Page
- Vendor selection dropdown
- Item dropdown with SKU display
- Auto-fill prices and auto-calculate totals
- Current stock display

### Customer Details
- Customer information card
- Sales statistics (total sales, amount, average)
- Recent sales history with SKU column

### Vendor Details
- Vendor information card
- Purchase statistics (total purchases, amount, average)
- Recent purchase history with SKU column

---

## 🔐 Security Features

- CSRF Protection on all forms
- SQL Injection prevention through Eloquent ORM
- XSS Protection through Blade templating
- Password hashing (if authentication added)
- Input validation on all forms
- Secure database queries

---

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a new branch (`git checkout -b feature/YourFeature`)
3. Commit your changes (`git commit -m 'Add some feature'`)
4. Push to the branch (`git push origin feature/YourFeature`)
5. Open a Pull Request

---

## 📝 License

This project is open-source and available under the [MIT License](LICENSE).

---

## 👨‍💻 Author

**Muhammad Owais Raza**

- GitHub: [@MOwaisrazaa](https://github.com/MOwaisrazaa)
- Repository: [inventory-management-system](https://github.com/MOwaisrazaa/inventory-management-system)

---

## 📞 Support

For issues, questions, or suggestions:
- Open an issue on [GitHub Issues](https://github.com/MOwaisrazaa/inventory-management-system/issues)
- Contact via GitHub profile

---

## 🙏 Acknowledgments

- Laravel Framework
- Bootstrap Team
- Font Awesome
- Open Source Community

---

## 📈 Future Enhancements

- [ ] User authentication and roles
- [ ] Reports generation (PDF/Excel)
- [ ] Barcode scanning support
- [ ] Multi-currency support
- [ ] Email notifications
- [ ] Advanced analytics dashboard
- [ ] Mobile app integration
- [ ] API for third-party integrations

---

## ⭐ Star This Repository

If you find this project useful, please consider giving it a star! ⭐

---

**Built with ❤️ for efficient inventory management**

**Happy Inventory Management! 🚀**
