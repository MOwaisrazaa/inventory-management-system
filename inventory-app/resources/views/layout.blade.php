<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Inventory Management System</title>
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

                <!-- User Info -->
                <div class="text-center mb-3" style="padding: 15px; background: rgba(255,255,255,0.1); border-radius: 10px;">
                    <i class="fas fa-user-circle" style="font-size: 40px; color: #ecf0f1;"></i>
                    <p class="mb-0 mt-2" style="color: #ecf0f1; font-size: 14px;">
                        <strong>{{ auth()->user()->name }}</strong>
                    </p>
                    <span class="badge {{ auth()->user()->isAdmin() ? 'bg-danger' : 'bg-primary' }}">
                        {{ auth()->user()->isAdmin() ? 'Admin' : 'User' }}
                    </span>
                </div>

                <a href="{{ route('dashboard') }}" class="@if(Route::currentRouteName() == 'dashboard') active @endif">
                    <i class="fas fa-home"></i> Dashboard
                </a>
                <a href="{{ route('items.index') }}" class="@if(str_contains(Route::currentRouteName(), 'items')) active @endif">
                    <i class="fas fa-box"></i> Items
                </a>
                <a href="{{ route('vendors.index') }}" class="@if(str_contains(Route::currentRouteName(), 'vendors')) active @endif">
                    <i class="fas fa-truck"></i> Vendors
                </a>
                <a href="{{ route('customers.index') }}" class="@if(str_contains(Route::currentRouteName(), 'customers')) active @endif">
                    <i class="fas fa-users"></i> Customers
                </a>
                <a href="{{ route('inventory.index') }}" class="@if(str_contains(Route::currentRouteName(), 'inventory')) active @endif">
                    <i class="fas fa-warehouse"></i> Inventory
                </a>
                <a href="{{ route('purchases.index') }}" class="@if(str_contains(Route::currentRouteName(), 'purchases')) active @endif">
                    <i class="fas fa-shopping-cart"></i> Purchases
                </a>
                <a href="{{ route('sales.index') }}" class="@if(str_contains(Route::currentRouteName(), 'sales')) active @endif">
                    <i class="fas fa-cash-register"></i> Sales
                </a>
                <a href="{{ route('cashbook.index') }}" class="@if(str_contains(Route::currentRouteName(), 'cashbook')) active @endif">
                    <i class="fas fa-book"></i> Cash Book
                </a>

                @if(auth()->user()->isAdmin())
                <hr style="border-color: rgba(255,255,255,0.2);">
                <a href="{{ route('users.index') }}" class="@if(str_contains(Route::currentRouteName(), 'users')) active @endif">
                    <i class="fas fa-users-cog"></i> Users Management
                </a>
                @endif

                <hr style="border-color: rgba(255,255,255,0.2);">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100" style="margin: 5px 0;">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 p-4">
                @if($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle"></i> {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle"></i> Please fix the errors below
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
