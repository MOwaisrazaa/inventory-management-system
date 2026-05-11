@extends('layout')

@section('title', 'Sheets List')

@section('content')

<style>
    .page-header {
        background: #2c3e50;
        color: white;
        padding: 12px 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .page-header h4 { margin: 0; font-size: 18px; }
    .page-header .nav-btns a {
        color: white;
        text-decoration: none;
        padding: 6px 16px;
        border-radius: 5px;
        font-size: 14px;
        margin-left: 8px;
        border: 1px solid rgba(255,255,255,0.4);
        transition: all 0.2s;
    }
    .page-header .nav-btns a:hover { background: rgba(255,255,255,0.15); }
    .page-header .nav-btns a.active-btn { background: #3498db; border-color: #3498db; }

    .date-filter-bar {
        background: white;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 12px 16px;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }
    .date-filter-bar label { font-size: 13px; font-weight: 600; margin: 0; white-space: nowrap; }
    .quick-dates { display: flex; flex-wrap: wrap; gap: 6px; }
    .quick-dates a {
        font-size: 11px;
        padding: 3px 10px;
        border-radius: 20px;
        border: 1px solid #bdc3c7;
        color: #555;
        text-decoration: none;
        transition: all 0.2s;
    }
    .quick-dates a:hover { background: #3498db; color: white; border-color: #3498db; }
    .quick-dates a.active { background: #2c3e50; color: white; border-color: #2c3e50; }

    .section-title {
        background: #34495e;
        color: white;
        padding: 6px 14px;
        font-size: 13px;
        font-weight: 600;
        border-radius: 4px;
        margin-bottom: 10px;
        display: inline-block;
    }

    .list-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }
    .list-table th {
        background: #ecf0f1;
        border: 1px solid #bdc3c7;
        padding: 7px 8px;
        text-align: center;
        font-weight: 600;
        font-size: 12px;
    }
    .list-table td {
        border: 1px solid #dde;
        padding: 6px 8px;
        vertical-align: middle;
    }
    .list-table tbody tr:hover { background: #f0f7ff; }
    .list-table .amount-col { text-align: right; font-weight: 500; }
    .list-table tfoot td {
        background: #eaf4fb;
        font-weight: 700;
        font-size: 13px;
    }

    .cashbook-section { margin-top: 24px; }
    .cashbook-section .list-table th { background: #d5e8d4; }

    .no-data {
        text-align: center;
        color: #999;
        padding: 20px;
        font-size: 13px;
        font-style: italic;
    }

    .badge-sale    { background: #27ae60; color: white; padding: 2px 8px; border-radius: 10px; font-size: 11px; }
    .badge-purchase{ background: #2980b9; color: white; padding: 2px 8px; border-radius: 10px; font-size: 11px; }
</style>

<!-- Page Header with Navigation -->
<div class="page-header">
    <h4><i class="fas fa-list"></i> Sheets List</h4>
    <div class="nav-btns">
        <a href="{{ route('sheets.create') }}">
            <i class="fas fa-plus-circle"></i> Create Sheet
        </a>
        <a href="{{ route('sheets.list') }}" class="active-btn">
            <i class="fas fa-list"></i> View List
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show py-2">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<!-- Date Filter Bar -->
<div class="date-filter-bar">
    <label><i class="fas fa-calendar-alt"></i> Date:</label>
    <form action="{{ route('sheets.list') }}" method="GET" class="d-flex align-items-center gap-2">
        <input type="date" name="date" class="form-control form-control-sm" value="{{ $date }}" style="width:160px;">
        <button type="submit" class="btn btn-primary btn-sm px-3">
            <i class="fas fa-filter"></i> Filter
        </button>
        <a href="{{ route('sheets.list') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-redo"></i> Today
        </a>
    </form>

    @if($dates->count() > 0)
    <div class="ms-3">
        <span style="font-size:12px; color:#888; margin-right:6px;">Quick:</span>
        <div class="quick-dates d-inline-flex">
            @foreach($dates->take(8) as $d)
                <a href="{{ route('sheets.list', ['date' => $d]) }}"
                   class="{{ $d == $date ? 'active' : '' }}">
                    {{ date('d M', strtotime($d)) }}
                </a>
            @endforeach
        </div>
    </div>
    @endif
</div>

<div class="mb-2" style="font-size:13px; color:#666;">
    <i class="fas fa-info-circle text-primary"></i>
    Showing records for: <strong>{{ date('d F Y', strtotime($date)) }}</strong>
</div>

<!-- Purchase + Sales Side by Side -->
<div class="row g-3">

    <!-- PURCHASE LIST -->
    <div class="col-md-6">
        <span class="section-title"><i class="fas fa-shopping-cart"></i> Purchase</span>
        <table class="list-table">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th width="22%">Vendor</th>
                    <th width="28%">Item</th>
                    <th width="12%">Qty</th>
                    <th width="15%">Rate</th>
                    <th width="18%">Amount</th>
                </tr>
            </thead>
            <tbody>
                @forelse($purchases as $i => $row)
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td>{{ $row->vendor_name ?? '-' }}</td>
                    <td>{{ $row->item_name ?? '-' }}</td>
                    <td class="text-center">{{ $row->quantity }}</td>
                    <td class="amount-col">{{ number_format($row->rate, 2) }}</td>
                    <td class="amount-col">{{ number_format($row->amount, 2) }}</td>
                </tr>
                @empty
                <tr><td colspan="6" class="no-data">No purchase records for this date</td></tr>
                @endforelse
            </tbody>
            @if($purchases->count() > 0)
            <tfoot>
                <tr>
                    <td colspan="5" class="text-end pe-2">Total:</td>
                    <td class="amount-col">{{ number_format($purchases->sum('amount'), 2) }}</td>
                </tr>
            </tfoot>
            @endif
        </table>
    </div>

    <!-- SALES LIST -->
    <div class="col-md-6">
        <span class="section-title" style="background:#27ae60;"><i class="fas fa-cash-register"></i> Sales</span>
        <table class="list-table">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th width="22%">Customer</th>
                    <th width="28%">Item</th>
                    <th width="12%">Qty</th>
                    <th width="15%">Rate</th>
                    <th width="18%">Amount</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sales as $i => $row)
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td>{{ $row->customer_name ?? '-' }}</td>
                    <td>{{ $row->item_name ?? '-' }}</td>
                    <td class="text-center">{{ $row->quantity }}</td>
                    <td class="amount-col">{{ number_format($row->rate, 2) }}</td>
                    <td class="amount-col">{{ number_format($row->amount, 2) }}</td>
                </tr>
                @empty
                <tr><td colspan="6" class="no-data">No sales records for this date</td></tr>
                @endforelse
            </tbody>
            @if($sales->count() > 0)
            <tfoot>
                <tr>
                    <td colspan="5" class="text-end pe-2">Total:</td>
                    <td class="amount-col">{{ number_format($sales->sum('amount'), 2) }}</td>
                </tr>
            </tfoot>
            @endif
        </table>
    </div>
</div>

<!-- Cash Book Section -->
<div class="cashbook-section">
    <div class="row g-3">

        <!-- RECEIPT LIST -->
        <div class="col-md-6">
            <span class="section-title" style="background:#8e44ad;"><i class="fas fa-book"></i> Cash Book - Receipt</span>
            <table class="list-table">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="45%">From</th>
                        <th width="25%">Status</th>
                        <th width="25%">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($receipts as $i => $row)
                    <tr>
                        <td class="text-center">{{ $i + 1 }}</td>
                        <td>{{ $row->from_party }}</td>
                        <td class="text-center">
                            <span class="badge {{ $row->status == 'received' ? 'bg-success' : 'bg-warning text-dark' }}">
                                {{ ucfirst($row->status) }}
                            </span>
                        </td>
                        <td class="amount-col">{{ number_format($row->amount, 2) }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="no-data">No receipt records for this date</td></tr>
                    @endforelse
                </tbody>
                @if($receipts->count() > 0)
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-end pe-2">Total:</td>
                        <td class="amount-col">{{ number_format($receipts->sum('amount'), 2) }}</td>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>

        <!-- PAYMENT LIST -->
        <div class="col-md-6">
            <span class="section-title" style="background:#e67e22;"><i class="fas fa-money-bill-wave"></i> Cash Book - Payments</span>
            <table class="list-table">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="45%">To</th>
                        <th width="25%">Status</th>
                        <th width="25%">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $i => $row)
                    <tr>
                        <td class="text-center">{{ $i + 1 }}</td>
                        <td>{{ $row->to_party }}</td>
                        <td class="text-center">
                            <span class="badge {{ $row->status == 'paid' ? 'bg-success' : 'bg-warning text-dark' }}">
                                {{ ucfirst($row->status) }}
                            </span>
                        </td>
                        <td class="amount-col">{{ number_format($row->amount, 2) }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="no-data">No payment records for this date</td></tr>
                    @endforelse
                </tbody>
                @if($payments->count() > 0)
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-end pe-2">Total:</td>
                        <td class="amount-col">{{ number_format($payments->sum('amount'), 2) }}</td>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>
    </div>
</div>

@endsection
