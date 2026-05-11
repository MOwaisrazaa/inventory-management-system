<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Inventory Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }

        /* ── Sidebar (kept in code but hidden) ── */
        /*
        .sidebar { background-color: #2c3e50; min-height: 100vh; padding: 20px 0; }
        .sidebar a { color: #ecf0f1; text-decoration: none; display: block; padding: 12px 20px; }
        .sidebar a.active { background-color: #3498db; }
        */

        .card {
            border: none;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .btn-primary { background-color: #3498db; border: none; }
        .btn-primary:hover { background-color: #2980b9; }
        .stat-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white; padding: 20px; border-radius: 10px; margin-bottom: 20px;
        }
        .stat-card h5 { font-size: 14px; opacity: 0.9; }
        .stat-card .value { font-size: 28px; font-weight: bold; }

        /* ── Top Navigation Bar ── */
        .top-navbar {
            background: #2c3e50;
            padding: 0 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        }
        .top-navbar .brand {
            color: #fff;
            font-weight: 700;
            font-size: 16px;
            text-decoration: none;
            padding: 12px 0;
            white-space: nowrap;
        }
        .top-navbar .brand:hover { color: #3498db; }
        .top-navbar .nav-links {
            display: flex;
            align-items: center;
            gap: 2px;
            flex-wrap: nowrap;
            overflow-x: auto;
        }
        .top-navbar .nav-links a {
            color: #bdc3c7;
            text-decoration: none;
            padding: 14px 11px;
            font-size: 12.5px;
            white-space: nowrap;
            border-bottom: 3px solid transparent;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .top-navbar .nav-links a:hover {
            color: #fff;
            background: rgba(255,255,255,0.07);
        }
        .top-navbar .nav-links a.active {
            color: #fff;
            border-bottom-color: #3498db;
            background: rgba(52,152,219,0.12);
        }
        .top-navbar .user-area {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 0;
            white-space: nowrap;
        }
        .top-navbar .user-area span {
            color: #ecf0f1;
            font-size: 12.5px;
        }
        .top-navbar .user-area .logout-btn {
            background: #e74c3c;
            color: #fff;
            border: none;
            padding: 5px 12px;
            border-radius: 4px;
            font-size: 12px;
            cursor: pointer;
            transition: background .2s;
        }
        .top-navbar .user-area .logout-btn:hover { background: #c0392b; }
    </style>
</head>
<body>

<!-- ══ TOP NAVIGATION BAR ══════════════════════════════════ -->
<nav class="top-navbar">
    <a href="{{ route('dashboard') }}" class="brand">
        <i class="fas fa-boxes"></i> Inventory
    </a>

    <div class="nav-links">
        <a href="{{ route('items.index') }}"
           class="@if(str_contains(Route::currentRouteName(), 'items')) active @endif">
            <i class="fas fa-box"></i> Items
        </a>
        <a href="{{ route('sheets.index') }}"
           class="@if(str_contains(Route::currentRouteName(), 'sheets')) active @endif">
            <i class="fas fa-table"></i> Daily Sheet
        </a>

        {{-- Hidden links (kept in code) --}}
        {{--
        <a href="{{ route('dashboard') }}" class="@if(Route::currentRouteName() == 'dashboard') active @endif">
            <i class="fas fa-home"></i> Dashboard
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
        <a href="{{ route('users.index') }}" class="@if(str_contains(Route::currentRouteName(), 'users')) active @endif">
            <i class="fas fa-users-cog"></i> Users
        </a>
        @endif
        --}}
    </div>

    <div class="user-area">
        <span>
            <i class="fas fa-user-circle"></i>
            {{ auth()->user()->name }}
            <span class="badge {{ auth()->user()->isAdmin() ? 'bg-danger' : 'bg-primary' }} ms-1" style="font-size:10px;">
                {{ auth()->user()->isAdmin() ? 'Admin' : 'User' }}
            </span>
        </span>
        <form action="{{ route('logout') }}" method="POST" class="mb-0">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>
</nav>
<!-- ══════════════════════════════════════════════════════════ -->

<div class="container-fluid p-4">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
