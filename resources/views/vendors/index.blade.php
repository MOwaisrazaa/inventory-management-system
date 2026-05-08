@extends('layout')

@section('title', 'Vendors')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-truck"></i> Vendors Management</h2>
    <a href="{{ route('vendors.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New Vendor
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
                        <th>Total Purchases</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($vendors as $vendor)
                    <tr>
                        <td><strong>{{ $vendor->name }}</strong></td>
                        <td>{{ $vendor->email ?? '-' }}</td>
                        <td>{{ $vendor->phone }}</td>
                        <td>{{ Str::limit($vendor->address, 40) ?? '-' }}</td>
                        <td>
                            <span class="badge bg-info">{{ $vendor->purchases_count }} purchases</span>
                        </td>
                        <td>
                            <a href="{{ route('vendors.show', $vendor) }}" class="btn btn-sm btn-info" title="View Details">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('vendors.edit', $vendor) }}" class="btn btn-sm btn-warning" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('vendors.destroy', $vendor) }}" method="POST" class="d-inline" 
                                  onsubmit="return confirm('Are you sure you want to delete this vendor?')">
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
                            <p>No vendors found. Add your first vendor!</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $vendors->links() }}
        </div>
    </div>
</div>
@endsection
