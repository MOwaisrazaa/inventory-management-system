@extends('layout')

@section('title', 'Edit Purchase')

@section('content')
<h1 class="mb-4">Edit Purchase</h1>

<div class="card">
    <div class="card-body">
        <form action="{{ route('purchases.update', $purchase) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="purchase_date" class="form-label">Purchase Date</label>
                    <input type="date" class="form-control @error('purchase_date') is-invalid @enderror" 
                           id="purchase_date" name="purchase_date" value="{{ $purchase->purchase_date->format('Y-m-d') }}" required>
                    @error('purchase_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="vendor_id" class="form-label">Vendor</label>
                    <select class="form-control @error('vendor_id') is-invalid @enderror" 
                            id="vendor_id" name="vendor_id" required>
                        @foreach($vendors as $vendor)
                            <option value="{{ $vendor->id }}" @selected($purchase->vendor_id == $vendor->id)>
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
                    <label for="item_id" class="form-label">Item</label>
                    <select class="form-control @error('item_id') is-invalid @enderror" 
                            id="item_id" name="item_id" required>
                        @foreach($items as $item)
                            <option value="{{ $item->id }}" @selected($purchase->item_id == $item->id)>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('item_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" class="form-control @error('quantity') is-invalid @enderror" 
                           id="quantity" name="quantity" value="{{ $purchase->quantity }}" required>
                    @error('quantity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="rate" class="form-label">Rate</label>
                    <input type="number" step="0.01" class="form-control @error('rate') is-invalid @enderror" 
                           id="rate" name="rate" value="{{ $purchase->rate }}" required>
                    @error('rate')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="notes" class="form-label">Notes</label>
                    <input type="text" class="form-control" id="notes" name="notes" value="{{ $purchase->notes }}">
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Purchase
                </button>
                <a href="{{ route('purchases.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
