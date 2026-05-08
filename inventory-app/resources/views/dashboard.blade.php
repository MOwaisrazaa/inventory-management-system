@extends('layout')

@section('title', 'Dashboard')

@section('content')
<h1 class="mb-4">Dashboard</h1>

<div class="row">
    <div class="col-md-3">
        <div class="stat-card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <h5>Total Purchases</h5>
            <div class="value">Rs {{  number_format($totalPurchases, 2) }}</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
            <h5>Total Sales</h5>
            <div class="value">Rs {{  number_format($totalSales, 2) }}</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
            <h5>Total Items</h5>
            <div class="value">{{ $totalItems }}</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
            <h5>Cash Balance</h5>
            <div class="value">Rs {{  number_format($cashBalance, 2) }}</div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <i class="fas fa-shopping-cart"></i> Recent Purchases
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Vendor</th>
                            <th>Item</th>
                            <th>Qty</th>
                            <th>Rate</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentPurchases as $purchase)
                            <tr>
                                <td>{{ $purchase->purchase_date->format('d-m-Y') }}</td>
                                <td>{{ $purchase->vendor->name }}</td>
                                <td>{{ $purchase->item->name }}</td>
                                <td>{{ $purchase->quantity }}</td>
                                <td>Rs {{  number_format($purchase->rate, 2) }}</td>
                                <td><strong>Rs {{  number_format($purchase->amount, 2) }}</strong></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No purchases yet</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-success text-white">
                <i class="fas fa-cash-register"></i> Recent Sales
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Item</th>
                            <th>Qty</th>
                            <th>Rate</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentSales as $sale)
                            <tr>
                                <td>{{ $sale->sale_date->format('d-m-Y') }}</td>
                                <td>{{ $sale->customer->name }}</td>
                                <td>{{ $sale->item->name }}</td>
                                <td>{{ $sale->quantity }}</td>
                                <td>Rs {{  number_format($sale->rate, 2) }}</td>
                                <td><strong>Rs {{  number_format($sale->amount, 2) }}</strong></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No sales yet</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
