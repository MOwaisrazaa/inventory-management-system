@extends('layout')

@section('title', 'Edit Item')

@section('content')
<div class="mb-4">
    <h2><i class="fas fa-edit"></i> Edit Item</h2>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('items.update', $item) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Item Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ old('name', $item->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="Item No" class="form-label">Item No (Auto-generated if empty)</label>
                    <input type="text" class="form-control @error('Item No') is-invalid @enderror" 
                           id="Item No" name="Item No" value="{{ old('Item No', $item->sku) }}" 
                           placeholder="e.g., PROD-001, RED-SM">
                    <small class="text-muted">Unique code for product identification (color, size, variant)</small>
                    @error('Item No')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                          id="description" name="description" rows="3">{{ old('description', $item->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="purchase_price" class="form-label">Purchase Price (Rs.) <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" class="form-control @error('purchase_price') is-invalid @enderror" 
                           id="purchase_price" name="purchase_price" value="{{ old('purchase_price', $item->purchase_price) }}" required>
                    @error('purchase_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="selling_price" class="form-label">Selling Price (Rs.) <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" class="form-control @error('selling_price') is-invalid @enderror" 
                           id="selling_price" name="selling_price" value="{{ old('selling_price', $item->selling_price) }}" required>
                    @error('selling_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="quantity" class="form-label">Quantity <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('quantity') is-invalid @enderror" 
                           id="quantity" name="quantity" value="{{ old('quantity', $item->quantity) }}" required>
                    @error('quantity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="unit" class="form-label">Unit <span class="text-danger">*</span></label>
                <select class="form-control @error('unit') is-invalid @enderror" id="unit" name="unit" required>
                    <option value="">Select Unit</option>
                    <option value="Piece" {{ old('unit', $item->unit) == 'Piece' ? 'selected' : '' }}>Piece</option>
                    <option value="Kg" {{ old('unit', $item->unit) == 'Kg' ? 'selected' : '' }}>Kg</option>
                    <option value="Liter" {{ old('unit', $item->unit) == 'Liter' ? 'selected' : '' }}>Liter</option>
                    <option value="Box" {{ old('unit', $item->unit) == 'Box' ? 'selected' : '' }}>Box</option>
                    <option value="Dozen" {{ old('unit', $item->unit) == 'Dozen' ? 'selected' : '' }}>Dozen</option>
                    <option value="Meter" {{ old('unit', $item->unit) == 'Meter' ? 'selected' : '' }}>Meter</option>
                </select>
                @error('unit')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Item
                </button>
                <a href="{{ route('items.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
