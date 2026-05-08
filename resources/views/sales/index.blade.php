@extends('layout')

@section('title', 'Sales')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Sales</h1>
    <a href="{{ route('sales.create') }}" class="btn btn-success">
        <i class="fas fa-plus"></i> Add Sale
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Item</th>
                    <th>SKU</th>
                    <th>Qty</th>
                    <th>Rate</th>
                    <th>Amount</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sales as $sale)
                    <tr>
                        <td>{{ $sale->sale_date->format('d-m-Y') }}</td>
                        <td>{{ $sale->customer->name }}</td>
                        <td>{{ $sale->item->name }}</td>
                        <td>
                            @if($sale->item->sku)
                                <span class="badge bg-secondary">{{ $sale->item->sku }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>{{ $sale->quantity }}</td>
                        <td>₹{{ number_format($sale->rate, 2) }}</td>
                        <td><strong>₹{{ number_format($sale->amount, 2) }}</strong></td>
                        <td>
                            <a href="{{ route('sales.edit', $sale) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('sales.destroy', $sale) }}" method="POST" style="display:inline;">
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
                        <td colspan="8" class="text-center text-muted">No sales found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4">
    {{ $sales->links() }}
</div>
@endsection
