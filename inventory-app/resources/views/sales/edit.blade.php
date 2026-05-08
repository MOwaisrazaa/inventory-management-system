@extends('layout')

@section('title', 'Edit Sale')

@section('content')
<h1 class="mb-4">Edit Sale</h1>

<div class="card">
    <div class="card-body">
        <form action="{{ route('sales.update', $sale) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="sale_date" class="form-label">Sale Date</label>
                    <input type="date" class="form-control @error('sale_date') is-invalid @enderror" 
                           id="sale_date" name="sale_date" value="{{ $sale->sale_date->format('Y-m-d') }}" required>
                    @error('sale_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="customer_id" class="form-label">Customer</label>
                    <select class="form-control @error('customer_id') is-invalid @enderror" 
                            id="customer_id" name="customer_id" required>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}" @selected($sale->customer_id == $customer->id)>
                                {{ $customer->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('customer_id')
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
                            <option value="{{ $item->id }}" @selected($sale->item_id == $item->id)>
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
                           id="quantity" name="quantity" value="{{ $sale->quantity }}" required>
                    @error('quantity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="rate" class="form-label">Rate</label>
                    <input type="number" step="0.01" class="form-control @error('rate') is-invalid @enderror" 
                           id="rate" name="rate" value="{{ $sale->rate }}" required>
                    @error('rate')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="notes" class="form-label">Notes</label>
                    <input type="text" class="form-control" id="notes" name="notes" value="{{ $sale->notes }}">
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Update Sale
                </button>
                <a href="{{ route('sales.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
