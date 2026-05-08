@extends('layout')

@section('title', 'Vendor Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-truck"></i> Vendor Details</h2>
    <div>
        <a href="{{ route('vendors.edit', $vendor) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Edit
        </a>
        <a href="{{ route('vendors.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
</div>

<div class="row">
    <!-- Vendor Information -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-info-circle"></i> Vendor Information</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="30%">Name:</th>
                        <td><strong>{{ $vendor->name }}</strong></td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td>{{ $vendor->email ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Phone:</th>
                        <td>{{ $vendor->phone }}</td>
                    </tr>
                    <tr>
                        <th>Address:</th>
                        <td>{{ $vendor->address ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Total Purchases:</th>
                        <td><span class="badge bg-info">{{ $vendor->purchases->count() }}</span></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- Purchase Statistics -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="fas fa-chart-bar"></i> Purchase Statistics</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <h6>Total Purchases</h6>
                    <h3 class="text-primary">{{ $vendor->purchases->count() }}</h3>
                </div>
                <div class="mb-3">
                    <h6>Total Amount</h6>
                    <h3 class="text-success">Rs {{  number_format($vendor->purchases->sum('amount'), 2) }}</h3>
                </div>
                <div>
                    <h6>Average Purchase</h6>
                    <h3 class="text-info">
                        Rs {{  $vendor->purchases->count() > 0 ? number_format($vendor->purchases->avg('amount'), 2) : '0.00' }}
                    </h3>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Purchases -->
<div class="card mt-4">
    <div class="card-header bg-white">
        <h5 class="mb-0"><i class="fas fa-shopping-cart"></i> Recent Purchases</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Date</th>
                        <th>Item</th>
                        <th>Item No</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total Amount</th>
                        <th>Payment Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($vendor->purchases as $purchase)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($purchase->purchase_date)->format('d/m/Y') }}</td>
                        <td>{{ $purchase->item->name }}</td>
                        <td>
                            @if($purchase->item->sku)
                                <span class="badge bg-secondary">{{ $purchase->item->sku }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>{{ $purchase->quantity }} {{ $purchase->item->unit }}</td>
                        <td>Rs {{  number_format($purchase->rate, 2) }}</td>
                        <td>Rs {{  number_format($purchase->amount, 2) }}</td>
                        <td>
                            @if($purchase->status == 'completed')
                                <span class="badge bg-success">Completed</span>
                            @elseif($purchase->status == 'pending')
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
                            <p>No purchases yet from this vendor</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
