@extends('layout')

@section('title', 'Inventory Management')

@section('content')
<div class="mb-4">
    <h2><i class="fas fa-warehouse"></i> Inventory Management</h2>
    <p class="text-muted">Track and manage your sales & purchases</p>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h6 class="card-title"><i class="fas fa-boxes"></i> Total Items</h6>
                <h2 class="mb-0">{{ $stats['total_items'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <h6 class="card-title"><i class="fas fa-exclamation-triangle"></i> Low Stock</h6>
                <h2 class="mb-0">{{ $stats['low_stock_items'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h6 class="card-title"><i class="fas fa-dollar-sign"></i> Inventory Value</h6>
                <h2 class="mb-0">₹{{ number_format($stats['total_inventory_value'], 2) }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h6 class="card-title"><i class="fas fa-chart-line"></i> Total Sales</h6>
                <h2 class="mb-0">₹{{ number_format($stats['total_sales_value'], 2) }}</h2>
            </div>
        </div>
    </div>
</div>

<!-- Search and Filter -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('inventory.index') }}" class="row g-3">
            <div class="col-md-6">
                <input type="text" name="search" class="form-control" 
                       placeholder="Search by item name or SKU..." 
                       value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="low_stock" class="form-control">
                    <option value="">All Items</option>
                    <option value="1" {{ request('low_stock') == '1' ? 'selected' : '' }}>Low Stock Only</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-search"></i> Search
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Current Inventory -->
<div class="card mb-4">
    <div class="card-header bg-white">
        <h5 class="mb-0"><i class="fas fa-list"></i> Current Inventory</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>SKU</th>
                        <th>Item Name</th>
                        <th>Purchase Price</th>
                        <th>Selling Price</th>
                        <th>Stock</th>
                        <th>Unit</th>
                        <th>Value</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                    <tr>
                        <td><span class="badge bg-secondary">{{ $item->sku }}</span></td>
                        <td><strong>{{ $item->name }}</strong></td>
                        <td>₹{{ number_format($item->purchase_price, 2) }}</td>
                        <td>₹{{ number_format($item->selling_price, 2) }}</td>
                        <td>
                            @if($item->quantity < 10)
                                <span class="badge bg-danger">{{ $item->quantity }}</span>
                            @elseif($item->quantity < 50)
                                <span class="badge bg-warning">{{ $item->quantity }}</span>
                            @else
                                <span class="badge bg-success">{{ $item->quantity }}</span>
                            @endif
                        </td>
                        <td>{{ $item->unit }}</td>
                        <td>₹{{ number_format($item->quantity * $item->purchase_price, 2) }}</td>
                        <td>
                            @if($item->quantity < 10)
                                <span class="badge bg-danger">Low Stock</span>
                            @elseif($item->quantity < 50)
                                <span class="badge bg-warning">Medium</span>
                            @else
                                <span class="badge bg-success">In Stock</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
                            <i class="fas fa-inbox fa-3x mb-3"></i>
                            <p>No items found</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $items->links() }}
        </div>
    </div>
</div>

<!-- Recent Transactions -->
<div class="row">
    <!-- Recent Purchases -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="fas fa-shopping-cart text-primary"></i> Recent Purchases</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Item</th>
                                <th>Vendor</th>
                                <th>Qty</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentPurchases as $purchase)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($purchase->purchase_date)->format('d/m/Y') }}</td>
                                <td>{{ $purchase->item->name }}</td>
                                <td>{{ $purchase->vendor->name }}</td>
                                <td>{{ $purchase->quantity }}</td>
                                <td>₹{{ number_format($purchase->amount, 2) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No recent purchases</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-3">
                    <a href="{{ route('purchases.index') }}" class="btn btn-sm btn-outline-primary">
                        View All Purchases <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Sales -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="fas fa-cash-register text-success"></i> Recent Sales</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Item</th>
                                <th>Customer</th>
                                <th>Qty</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentSales as $sale)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($sale->sale_date)->format('d/m/Y') }}</td>
                                <td>{{ $sale->item->name }}</td>
                                <td>{{ $sale->customer->name }}</td>
                                <td>{{ $sale->quantity }}</td>
                                <td>₹{{ number_format($sale->amount, 2) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No recent sales</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-3">
                    <a href="{{ route('sales.index') }}" class="btn btn-sm btn-outline-success">
                        View All Sales <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
