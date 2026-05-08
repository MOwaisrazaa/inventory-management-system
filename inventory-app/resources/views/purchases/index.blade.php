@extends('layout')

@section('title', 'Purchases')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Purchases</h1>
    <a href="{{ route('purchases.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Purchase
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>Date</th>
                    <th>Vendor</th>
                    <th>Item</th>
                    <th>SKU</th>
                    <th>Qty</th>
                    <th>Rate</th>
                    <th>Amount</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($purchases as $purchase)
                    <tr>
                        <td>{{ $purchase->purchase_date->format('d-m-Y') }}</td>
                        <td>{{ $purchase->vendor->name }}</td>
                        <td>{{ $purchase->item->name }}</td>
                        <td>
                            @if($purchase->item->sku)
                                <span class="badge bg-secondary">{{ $purchase->item->sku }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>{{ $purchase->quantity }}</td>
                        <td>Rs {{  number_format($purchase->rate, 2) }}</td>
                        <td><strong>Rs {{  number_format($purchase->amount, 2) }}</strong></td>
                        <td>
                            <a href="{{ route('purchases.edit', $purchase) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('purchases.destroy', $purchase) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">No purchases found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4">
    {{ $purchases->links() }}
</div>
@endsection
