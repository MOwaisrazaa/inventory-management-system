<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title'); ?> - Inventory Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            background-color: #2c3e50;
            min-height: 100vh;
            padding: 20px 0;
        }
        .sidebar a {
            color: #ecf0f1;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
            margin: 5px 0;
            border-radius: 5px;
            transition: all 0.3s;
        }
        .sidebar a:hover {
            background-color: #34495e;
            color: #fff;
        }
        .sidebar a.active {
            background-color: #3498db;
            color: #fff;
        }
        .navbar-brand {
            color: #fff !important;
            font-weight: bold;
            font-size: 20px;
        }
        .card {
            border: none;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #3498db;
            border: none;
        }
        .btn-primary:hover {
            background-color: #2980b9;
        }
        .stat-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .stat-card h5 {
            font-size: 14px;
            opacity: 0.9;
        }
        .stat-card .value {
            font-size: 28px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar">
                <div class="navbar-brand mb-4">
                    <i class="fas fa-boxes"></i> Inventory
                </div>
                <a href="<?php echo e(route('dashboard')); ?>" class="<?php if(Route::currentRouteName() == 'dashboard'): ?> active <?php endif; ?>">
                    <i class="fas fa-home"></i> Dashboard
                </a>
                <a href="<?php echo e(route('items.index')); ?>" class="<?php if(str_contains(Route::currentRouteName(), 'items')): ?> active <?php endif; ?>">
                    <i class="fas fa-box"></i> Items
                </a>
                <a href="<?php echo e(route('vendors.index')); ?>" class="<?php if(str_contains(Route::currentRouteName(), 'vendors')): ?> active <?php endif; ?>">
                    <i class="fas fa-truck"></i> Vendors
                </a>
                <a href="<?php echo e(route('customers.index')); ?>" class="<?php if(str_contains(Route::currentRouteName(), 'customers')): ?> active <?php endif; ?>">
                    <i class="fas fa-users"></i> Customers
                </a>
                <a href="<?php echo e(route('inventory.index')); ?>" class="<?php if(str_contains(Route::currentRouteName(), 'inventory')): ?> active <?php endif; ?>">
                    <i class="fas fa-warehouse"></i> Inventory
                </a>
                <a href="<?php echo e(route('purchases.index')); ?>" class="<?php if(str_contains(Route::currentRouteName(), 'purchases')): ?> active <?php endif; ?>">
                    <i class="fas fa-shopping-cart"></i> Purchases
                </a>
                <a href="<?php echo e(route('sales.index')); ?>" class="<?php if(str_contains(Route::currentRouteName(), 'sales')): ?> active <?php endif; ?>">
                    <i class="fas fa-cash-register"></i> Sales
                </a>
                <a href="<?php echo e(route('cashbook.index')); ?>" class="<?php if(str_contains(Route::currentRouteName(), 'cashbook')): ?> active <?php endif; ?>">
                    <i class="fas fa-book"></i> Cash Book
                </a>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 p-4">
                <?php if($message = Session::get('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle"></i> <?php echo e($message); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if($errors->any()): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle"></i> Please fix the errors below
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH E:\xampp\htdocs\inventory-app\resources\views/layout.blade.php ENDPATH**/ ?>