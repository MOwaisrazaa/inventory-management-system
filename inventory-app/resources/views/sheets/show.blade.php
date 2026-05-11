@extends('layout')

@section('title', 'View Sheet')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-file-alt"></i> Sheet Details</h5>
            <div>
                <a href="{{ route('sheets.list', ['date' => $sheet->date]) }}" class="btn btn-light btn-sm">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
                <button onclick="window.print()" class="btn btn-success btn-sm">
                    <i class="fas fa-print"></i> Print
                </button>
            </div>
        </div>
        <div class="card-body">
            <!-- Sheet Header Info -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <th width="40%">Sheet ID:</th>
                            <td><strong>#{{ $sheet->id }}</strong></td>
                        </tr>
                        <tr>
                            <th>Date:</th>
                            <td>{{ date('d M Y', strtotime($sheet->date)) }}</td>
                        </tr>
                        <tr>
                            <th>Type:</th>
                            <td>
                                @if($sheet->type == 'sale')
                                    <span class="badge bg-success">Sale</span>
                                @else
                                    <span class="badge bg-info">Purchase</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <th width="40%">Party Name:</th>
                            <td><strong>{{ $sheet->party_name }}</strong></td>
                        </tr>
                        <tr>
                            <th>Created At:</th>
                            <td>{{ date('d M Y h:i A', strtotime($sheet->created_at)) }}</td>
                        </tr>
                        <tr>
                            <th>Total Amount:</th>
                            <td><strong class="text-success">Rs {{ number_format($sheet->total_amount, 2) }}</strong></td>
                        </tr>
                    </table>
                </div>
            </div>

            <hr>

            <!-- Items Table -->
            <h6 class="mb-3"><i class="fas fa-boxes"></i> Items</h6>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">#</th>
                            <th width="15%">Item No</th>
                            <th width="35%">Item Name</th>
                            <th width="15%">Quantity</th>
                            <th width="15%">Rate (Rs.)</th>
                            <th width="15%">Amount (Rs.)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->sku }}</td>
                            <td>{{ $item->name }}</td>
                            <td class="text-center">{{ $item->quantity }}</td>
                            <td class="text-end">{{ number_format($item->rate, 2) }}</td>
                            <td class="text-end"><strong>{{ number_format($item->amount, 2) }}</strong></td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <th colspan="5" class="text-end">Grand Total:</th>
                            <th class="text-end">Rs {{ number_format($sheet->total_amount, 2) }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    .btn, .card-header .btn-group {
        display: none !important;
    }
    .card {
        box-shadow: none !important;
        border: 1px solid #000 !important;
    }
}
</style>
@endsection
