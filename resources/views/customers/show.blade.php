@extends('layout')

@section('title', 'Customer Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-user"></i> Customer Details</h2>
    <div>
        <a href="{{ route('customers.edit', $customer) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Edit
        </a>
        <a href="{{ route('customers.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
</div>

<div class="row">
    <!-- Customer Information -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-info-circle"></i> Customer Information</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="30%">Name:</th>
                        <td><strong>{{ $customer->name }}</strong></td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td>{{ $customer->email ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Phone:</th>
                        <td>{{ $customer->phone }}</td>
                    </tr>
                    <tr>
                        <th>Address:</th>
                        <td>{{ $customer->address ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Total Sales:</th>
                        <td><span class="badge bg-success">{{ $customer->sales->count() }}</span></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- Sales Statistics -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="fas fa-chart-bar"></i> Sales Statistics</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <h6>Total Sales</h6>
                    <h3 class="text-primary">{{ $customer->sales->count() }}</h3>
                </div>
                <div class="mb-3">
                    <h6>Total Amount</h6>
                    <h3 class="text-success">₹{{ number_format($customer->sales->sum('amount'), 2) }}</h3>
                </div>
                <div>
                    <h6>Average Sale</h6>
                    <h3 class="text-info">
                        ₹{{ $customer->sales->count() > 0 ? number_format($customer->sales->avg('amount'), 2) : '0.00' }}
                    </h3>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Sales -->
<div class="card mt-4">
    <div class="card-header bg-white">
        <h5 class="mb-0"><i class="fas fa-shopping-bag"></i> Recent Sales</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Date</th>
                        <th>Item</th>
                        <th>SKU</th>
                        <th>Quantity</th>
                        <th>Rate</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customer->sales as $sale)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($sale->sale_date)->format('d/m/Y') }}</td>
                        <td>{{ $sale->item->name }}</td>
                        <td>
                            @if($sale->item->sku)
                                <span class="badge bg-secondary">{{ $sale->item->sku }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>{{ $sale->quantity }} {{ $sale->item->unit }}</td>
                        <td>₹{{ number_format($sale->rate, 2) }}</td>
                        <td>₹{{ number_format($sale->amount, 2) }}</td>
                        <td>
                            @if($sale->status == 'completed')
                                <span class="badge bg-success">Completed</span>
                            @elseif($sale->status == 'pending')
                                <span class="badge bg-warning">Pending</span>
                            @else
                                <span class="badge bg-danger">Cancelled</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            <i class="fas fa-inbox fa-2x mb-2"></i>
                            <p>No sales yet from this customer</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
