@extends('layout')

@section('title', 'Items')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-box"></i> Items Management</h2>
    <a href="{{ route('items.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New Item
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Item No</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Purchase Price</th>
                        <th>Selling Price</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                    <tr>
                        <td><span class="badge bg-secondary">{{ $item->sku }}</span></td>
                        <td><strong>{{ $item->name }}</strong></td>
                        <td>{{ Str::limit($item->description, 50) }}</td>
                        <td>Rs {{  number_format($item->purchase_price, 2) }}</td>
                        <td>Rs {{  number_format($item->selling_price, 2) }}</td>
                        <td>
                            @if($item->quantity < 10)
                                <span class="badge bg-danger">{{ $item->quantity }}</span>
                            @else
                                <span class="badge bg-success">{{ $item->quantity }}</span>
                            @endif
                        </td>
                        <td>{{ $item->unit }}</td>
                        <td>
                            <a href="{{ route('items.edit', $item) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('items.destroy', $item) }}" method="POST" class="d-inline" 
                                  onsubmit="return confirm('Are you sure you want to delete this item?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
                            <i class="fas fa-inbox fa-3x mb-3"></i>
                            <p>No items found. Add your first item!</p>
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
@endsection
