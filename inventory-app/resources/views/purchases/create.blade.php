@extends('layout')

@section('title', 'Add Purchase')

@section('content')
<h1 class="mb-4">Add New Purchase</h1>

<div class="card">
    <div class="card-body">
        <form action="{{ route('purchases.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="purchase_date" class="form-label">Purchase Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('purchase_date') is-invalid @enderror" 
                           id="purchase_date" name="purchase_date" value="{{ old('purchase_date', date('Y-m-d')) }}" required>
                    @error('purchase_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="vendor_id" class="form-label">Vendor <span class="text-danger">*</span></label>
                    <select class="form-control @error('vendor_id') is-invalid @enderror" 
                            id="vendor_id" name="vendor_id" required>
                        <option value="">Select Vendor</option>
                        @foreach($vendors as $vendor)
                            <option value="{{ $vendor->id }}" @selected(old('vendor_id') == $vendor->id)>
                                {{ $vendor->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('vendor_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="item_name" class="form-label">Item Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('item_name') is-invalid @enderror" 
                           id="item_name" name="item_name" value="{{ old('item_name') }}" 
                           placeholder="Enter item name" required>
                    @error('item_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="item_sku" class="form-label">SKU (Optional)</label>
                    <input type="text" class="form-control @error('item_sku') is-invalid @enderror" 
                           id="item_sku" name="item_sku" value="{{ old('item_sku') }}" 
                           placeholder="Enter SKU code">
                    @error('item_sku')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="purchase_price" class="form-label">Purchase Price (Rs.) <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" class="form-control @error('purchase_price') is-invalid @enderror" 
                           id="purchase_price" name="purchase_price" value="{{ old('purchase_price') }}" 
                           min="0" placeholder="Enter purchase price" required>
                    @error('purchase_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="sale_price" class="form-label">Sale Price (Rs.) <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" class="form-control @error('sale_price') is-invalid @enderror" 
                           id="sale_price" name="sale_price" value="{{ old('sale_price') }}" 
                           min="0" placeholder="Enter sale price" required>
                    @error('sale_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="quantity" class="form-label">Quantity <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('quantity') is-invalid @enderror" 
                           id="quantity" name="quantity" value="{{ old('quantity', 1) }}" min="1" required>
                    @error('quantity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="rate" class="form-label">Rate (Rs.) <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" class="form-control @error('rate') is-invalid @enderror" 
                           id="rate" name="rate" value="{{ old('rate') }}" min="0" placeholder="Purchase rate" required>
                    @error('rate')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">This will be used for this purchase only</small>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="total_amount" class="form-label">Total Amount (Rs.)</label>
                    <input type="text" class="form-control bg-light" id="total_amount" readonly value="0.00">
                </div>
            </div>

            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> <strong>Note:</strong> When you save this purchase, the item will be automatically added to the Items page if it doesn't exist, or the quantity will be updated if it already exists.
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Purchase
                </button>
                <a href="{{ route('purchases.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    // Auto-fill rate from purchase price
    document.getElementById('purchase_price').addEventListener('input', function() {
        const purchasePrice = this.value;
        if (purchasePrice) {
            document.getElementById('rate').value = purchasePrice;
            calculateTotal();
        }
    });

    // Calculate total amount
    function calculateTotal() {
        const quantity = parseFloat(document.getElementById('quantity').value) || 0;
        const rate = parseFloat(document.getElementById('rate').value) || 0;
        const total = quantity * rate;
        document.getElementById('total_amount').value = total.toFixed(2);
    }

    document.getElementById('quantity').addEventListener('input', calculateTotal);
    document.getElementById('rate').addEventListener('input', calculateTotal);
</script>
@endsection
