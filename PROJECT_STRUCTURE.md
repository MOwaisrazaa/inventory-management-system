# Project Structure - Inventory Management System

## 📁 Directory Layout

```
inventory-app/
│
├── app/
│   ├── Models/
│   │   ├── Vendor.php          # Vendor model
│   │   ├── Customer.php        # Customer model
│   │   ├── Item.php            # Item/Product model
│   │   ├── Purchase.php        # Purchase transaction
│   │   ├── Sale.php            # Sale transaction
│   │   └── CashBook.php        # Cash book entries
│   │
│   └── Http/Controllers/
│       ├── DashboardController.php    # Dashboard logic
│       ├── PurchaseController.php     # Purchase CRUD
│       ├── SaleController.php         # Sale CRUD
│       └── CashBookController.php     # Cash book CRUD
│
├── database/
│   └── migrations/
│       ├── 2024_01_01_000001_create_vendors_table.php
│       ├── 2024_01_01_000002_create_customers_table.php
│       ├── 2024_01_01_000003_create_items_table.php
│       ├── 2024_01_01_000004_create_purchases_table.php
│       ├── 2024_01_01_000005_create_sales_table.php
│       └── 2024_01_01_000006_create_cash_book_table.php
│
├── resources/
│   └── views/
│       ├── layout.blade.php           # Main layout template
│       ├── dashboard.blade.php        # Dashboard view
│       │
│       ├── purchases/
│       │   ├── index.blade.php        # List purchases
│       │   ├── create.blade.php       # Add purchase form
│       │   └── edit.blade.php         # Edit purchase form
│       │
│       ├── sales/
│       │   ├── index.blade.php        # List sales
│       │   ├── create.blade.php       # Add sale form
│       │   └── edit.blade.php         # Edit sale form
│       │
│       └── cashbook/
│           ├── index.blade.php        # Cash book view
│           ├── create.blade.php       # Add transaction form
│           └── edit.blade.php         # Edit transaction form
│
├── routes/
│   └── web.php                 # All URL routes
│
├── config/
│   ├── app.php                 # App configuration
│   └── database.php            # Database configuration
│
├── bootstrap/
│   └── app.php                 # Application bootstrap
│
├── public/
│   └── index.php               # Entry point
│
├── .env.example                # Environment template
├── composer.json               # PHP dependencies
├── artisan                     # Laravel CLI
├── README.md                   # Full documentation
├── QUICKSTART.md               # Quick setup guide
└── PROJECT_STRUCTURE.md        # This file
```

---

## 🗄️ Database Schema

### vendors
- id (Primary Key)
- name
- email
- phone
- address
- timestamps

### customers
- id (Primary Key)
- name
- email
- phone
- address
- timestamps

### items
- id (Primary Key)
- name
- sku (Unique)
- description
- purchase_price
- selling_price
- quantity (Current stock)
- unit
- timestamps

### purchases
- id (Primary Key)
- purchase_date
- vendor_id (Foreign Key)
- item_id (Foreign Key)
- quantity
- rate
- amount
- status
- notes
- timestamps

### sales
- id (Primary Key)
- sale_date
- customer_id (Foreign Key)
- item_id (Foreign Key)
- quantity
- rate
- amount
- status
- notes
- timestamps

### cash_book
- id (Primary Key)
- transaction_date
- type (receipt/payment)
- from_to
- description
- amount
- status
- notes
- timestamps

---

## 🔄 Data Flow

### Purchase Flow
1. User adds purchase → PurchaseController@store
2. Validates data
3. Creates Purchase record
4. Updates Item quantity (+)
5. Redirects to purchases list

### Sale Flow
1. User adds sale → SaleController@store
2. Validates data
3. Creates Sale record
4. Updates Item quantity (-)
5. Redirects to sales list

### Cash Book Flow
1. User adds transaction → CashBookController@store
2. Validates data
3. Creates CashBook record
4. Dashboard calculates balance
5. Redirects to cash book

---

## 🎨 Frontend Stack

- **Bootstrap 5.3** - Responsive UI
- **Font Awesome 6.4** - Icons
- **Blade Templates** - Laravel templating
- **HTML5 Forms** - Data input

---

## 🔐 Security Features

- CSRF Protection (Laravel built-in)
- SQL Injection Prevention (Eloquent ORM)
- Input Validation (Form requests)
- XSS Protection (Blade escaping)

---

## 📊 Key Relationships

```
Vendor (1) ──→ (Many) Purchase
Customer (1) ──→ (Many) Sale
Item (1) ──→ (Many) Purchase
Item (1) ──→ (Many) Sale
```

---

## 🚀 Scalability Features

- Pagination on all list views
- Indexed database queries
- Relationship eager loading
- Efficient calculations

---

## 📝 Notes

- All amounts are stored as DECIMAL(12,2)
- Dates are stored as DATE type
- Inventory updates automatically
- All transactions are timestamped
- Soft deletes can be added if needed

