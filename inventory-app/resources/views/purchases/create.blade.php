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
                <div class="col-md-12 mb-3">
                    <label for="item_id" class="form-label">Item <span class="text-danger">*</span></label>
                    <select class="form-control @error('item_id') is-invalid @enderror" 
                            id="item_id" name="item_id" required>
                        <option value="">Select Item</option>
                        @foreach($items as $item)
                            <option value="{{ $item->id }}" 
                                    data-price="{{ $item->purchase_price }}"
                                    data-sku="{{ $item->sku }}"
                                    @selected(old('item_id') == $item->id)>
                                {{ $item->name }} [{{ $item->sku }}] (Stock: {{ $item->quantity }})
                            </option>
                        @endforeach
                    </select>
                    @error('item_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mb-3" id="selected_item_info" style="display: none;">
                    <div class="alert alert-info">
                        <strong>Selected Item:</strong> <span id="item_name_display"></span>
                        <span id="item_sku_display"> | <strong>Item No:</strong> <span id="sku_value"></span></span>
                    </div>
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
                           id="rate" name="rate" value="{{ old('rate') }}" min="0" required>
                    @error('rate')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="total_amount" class="form-label">Total Amount (Rs.)</label>
                    <input type="text" class="form-control bg-light" id="total_amount" readonly value="0.00">
                </div>
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
    // Auto-fill rate when item is selected
    document.getElementById('item_id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const price = selectedOption.getAttribute('data-price');
        const sku = selectedOption.getAttribute('data-sku');
        const itemName = selectedOption.text;
        
        if (price) {
            document.getElementById('rate').value = price;
            calculateTotal();
        }
        
        // Show selected item info
        if (this.value) {
            document.getElementById('selected_item_info').style.display = 'block';
            document.getElementById('item_name_display').textContent = itemName;
            
            if (sku) {
                document.getElementById('item_sku_display').style.display = 'inline';
                document.getElementById('sku_value').textContent = sku;
            } else {
                document.getElementById('item_sku_display').style.display = 'none';
            }
        } else {
            document.getElementById('selected_item_info').style.display = 'none';
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
