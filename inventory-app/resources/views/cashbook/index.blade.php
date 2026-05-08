@extends('layout')

@section('title', 'Cash Book')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Cash Book</h1>
    <a href="{{ route('cashbook.create') }}" class="btn btn-info">
        <i class="fas fa-plus"></i> Add Transaction
    </a>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
            <h5>Total Receipts</h5>
            <div class="value">Rs {{  number_format($totalReceipts, 2) }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
            <h5>Total Payments</h5>
            <div class="value">Rs {{  number_format($totalPayments, 2) }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg, #30cfd0 0%, #330867 100%);">
            <h5>Balance</h5>
            <div class="value">Rs {{  number_format($balance, 2) }}</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-success text-white">
                <i class="fas fa-arrow-down"></i> Receipts
            </div>
            <div class="card-body">
                <table class="table table-sm table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>From</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($receipts as $receipt)
                            <tr>
                                <td>{{ $receipt->transaction_date->format('d-m-Y') }}</td>
                                <td>{{ $receipt->from_to }}</td>
                                <td>{{ $receipt->description }}</td>
                                <td><strong>Rs {{  number_format($receipt->amount, 2) }}</strong></td>
                                <td>
                                    <a href="{{ route('cashbook.edit', $receipt) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('cashbook.destroy', $receipt) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No receipts found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-danger text-white">
                <i class="fas fa-arrow-up"></i> Payments
            </div>
            <div class="card-body">
                <table class="table table-sm table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>To</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($payments as $payment)
                            <tr>
                                <td>{{ $payment->transaction_date->format('d-m-Y') }}</td>
                                <td>{{ $payment->from_to }}</td>
                                <td>{{ $payment->description }}</td>
                                <td><strong>Rs {{  number_format($payment->amount, 2) }}</strong></td>
                                <td>
                                    <a href="{{ route('cashbook.edit', $payment) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('cashbook.destroy', $payment) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No payments found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
