@extends('layout')

@section('title', 'Customers')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-users"></i> Customers Management</h2>
    <a href="{{ route('customers.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New Customer
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Total Sales</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $customer)
                    <tr>
                        <td><strong>{{ $customer->name }}</strong></td>
                        <td>{{ $customer->email ?? '-' }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ Str::limit($customer->address, 40) ?? '-' }}</td>
                        <td>
                            <span class="badge bg-success">{{ $customer->sales_count }} sales</span>
                        </td>
                        <td>
                            <a href="{{ route('customers.show', $customer) }}" class="btn btn-sm btn-info" title="View Details">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('customers.edit', $customer) }}" class="btn btn-sm btn-warning" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('customers.destroy', $customer) }}" method="POST" class="d-inline" 
                                  onsubmit="return confirm('Are you sure you want to delete this customer?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            <i class="fas fa-inbox fa-3x mb-3"></i>
                            <p>No customers found. Customers will be automatically added when you make sales!</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $customers->links() }}
        </div>
    </div>
</div>
@endsection
