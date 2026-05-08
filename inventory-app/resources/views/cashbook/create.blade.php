@extends('layout')

@section('title', 'Add Transaction')

@section('content')
<h1 class="mb-4">Add New Transaction</h1>

<div class="card">
    <div class="card-body">
        <form action="{{ route('cashbook.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="transaction_date" class="form-label">Transaction Date</label>
                    <input type="date" class="form-control @error('transaction_date') is-invalid @enderror" 
                           id="transaction_date" name="transaction_date" value="{{ old('transaction_date') }}" required>
                    @error('transaction_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="type" class="form-label">Type</label>
                    <select class="form-control @error('type') is-invalid @enderror" 
                            id="type" name="type" required>
                        <option value="">Select Type</option>
                        <option value="receipt" @selected(old('type') == 'receipt')>Receipt</option>
                        <option value="payment" @selected(old('type') == 'payment')>Payment</option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="payee_type" class="form-label">Payee Type <span class="text-danger">*</span></label>
                    <select class="form-control @error('payee_type') is-invalid @enderror" 
                            id="payee_type" name="payee_type" required>
                        <option value="">Select Payee Type</option>
                        <option value="customer" @selected(old('payee_type') == 'customer')>Customer</option>
                        <option value="vendor" @selected(old('payee_type') == 'vendor')>Vendor</option>
                    </select>
                    @error('payee_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3" id="customer_dropdown" style="display: none;">
                    <label for="customer_id" class="form-label">Customer <span class="text-danger">*</span></label>
                    <select class="form-control @error('customer_id') is-invalid @enderror" 
                            id="customer_id" name="customer_id">
                        <option value="">Select Customer</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}" @selected(old('customer_id') == $customer->id)>
                                {{ $customer->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('customer_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3" id="vendor_dropdown" style="display: none;">
                    <label for="vendor_id" class="form-label">Vendor <span class="text-danger">*</span></label>
                    <select class="form-control @error('vendor_id') is-invalid @enderror" 
                            id="vendor_id" name="vendor_id">
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
                    <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('description') is-invalid @enderror" 
                           id="description" name="description" value="{{ old('description') }}" required>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="item_id" class="form-label">Item (Optional)</label>
                    <select class="form-control @error('item_id') is-invalid @enderror" 
                            id="item_id" name="item_id">
                        <option value="">Select Item (Optional)</option>
                        @foreach($items as $item)
                            <option value="{{ $item->id }}" @selected(old('item_id') == $item->id)>
                                {{ $item->name }}@if($item->sku) [{{ $item->sku }}]@endif
                            </option>
                        @endforeach
                    </select>
                    @error('item_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="amount" class="form-label">Amount (Rs.) <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror" 
                           id="amount" name="amount" value="{{ old('amount') }}" required>
                    @error('amount')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="notes" class="form-label">Notes</label>
                    <input type="text" class="form-control" id="notes" name="notes" value="{{ old('notes') }}">
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-info">
                    <i class="fas fa-save"></i> Save Transaction
                </button>
                <a href="{{ route('cashbook.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    // Show/hide customer or vendor dropdown based on payee type
    document.getElementById('payee_type').addEventListener('change', function() {
        const payeeType = this.value;
        const customerDropdown = document.getElementById('customer_dropdown');
        const vendorDropdown = document.getElementById('vendor_dropdown');
        const customerSelect = document.getElementById('customer_id');
        const vendorSelect = document.getElementById('vendor_id');

        if (payeeType === 'customer') {
            customerDropdown.style.display = 'block';
            vendorDropdown.style.display = 'none';
            customerSelect.required = true;
            vendorSelect.required = false;
            vendorSelect.value = '';
        } else if (payeeType === 'vendor') {
            customerDropdown.style.display = 'none';
            vendorDropdown.style.display = 'block';
            customerSelect.required = false;
            vendorSelect.required = true;
            customerSelect.value = '';
        } else {
            customerDropdown.style.display = 'none';
            vendorDropdown.style.display = 'none';
            customerSelect.required = false;
            vendorSelect.required = false;
        }
    });

    // Trigger on page load if old value exists
    if (document.getElementById('payee_type').value) {
        document.getElementById('payee_type').dispatchEvent(new Event('change'));
    }
</script>
@endsection
