@extends('layout')

@section('title', 'Edit Transaction')

@section('content')
<h1 class="mb-4">Edit Transaction</h1>

<div class="card">
    <div class="card-body">
        <form action="{{ route('cashbook.update', $cashBook) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="transaction_date" class="form-label">Transaction Date</label>
                    <input type="date" class="form-control @error('transaction_date') is-invalid @enderror" 
                           id="transaction_date" name="transaction_date" value="{{ $cashBook->transaction_date->format('Y-m-d') }}" required>
                    @error('transaction_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="type" class="form-label">Type</label>
                    <select class="form-control @error('type') is-invalid @enderror" 
                            id="type" name="type" required>
                        <option value="receipt" @selected($cashBook->type == 'receipt')>Receipt (Income)</option>
                        <option value="payment" @selected($cashBook->type == 'payment')>Payment (Expense)</option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="from_to" class="form-label">From/To</label>
                    <input type="text" class="form-control @error('from_to') is-invalid @enderror" 
                           id="from_to" name="from_to" value="{{ $cashBook->from_to }}" required>
                    @error('from_to')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control @error('description') is-invalid @enderror" 
                           id="description" name="description" value="{{ $cashBook->description }}" required>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror" 
                           id="amount" name="amount" value="{{ $cashBook->amount }}" required>
                    @error('amount')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="notes" class="form-label">Notes</label>
                    <input type="text" class="form-control" id="notes" name="notes" value="{{ $cashBook->notes }}">
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-info">
                    <i class="fas fa-save"></i> Update Transaction
                </button>
                <a href="{{ route('cashbook.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
