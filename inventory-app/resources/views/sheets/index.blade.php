@extends('layout')
@section('title', 'Daily Sheet')
@section('content')
<style>
/* ── Date Nav Bar ────────────────────────────────────── */
.date-nav {
    background: #fff;
    border: 1px solid #dee2e6;
    border-radius: 7px;
    padding: 8px 14px;
    margin-bottom: 14px;
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}
.date-nav .nav-date-btn {
    background: #34495e;
    color: #fff;
    border: none;
    padding: 5px 14px;
    border-radius: 5px;
    font-size: 13px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    transition: background .2s;
}
.date-nav .nav-date-btn:hover { background: #2c3e50; color:#fff; }
.date-nav .nav-date-btn.disabled {
    background: #bdc3c7;
    pointer-events: none;
}
.date-nav .current-date {
    font-size: 15px;
    font-weight: 700;
    color: #2c3e50;
    padding: 0 10px;
}
.date-nav input[type=date] {
    font-size: 13px;
    padding: 4px 8px;
    border: 1px solid #ced4da;
    border-radius: 5px;
    height: 32px;
}

/* ── Section Labels ──────────────────────────────────── */
.sec-label {
    display: block;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: .5px;
    text-transform: uppercase;
    padding: 4px 10px;
    border-radius: 4px 4px 0 0;
    margin-bottom: 0;
    color: #fff;
}
.sec-purchase { background: #2980b9; }
.sec-sale     { background: #27ae60; }
.sec-receipt  { background: #8e44ad; }
.sec-payment  { background: #e67e22; }
.sec-journal  { background: #455a64; }

/* ── Sheet Tables ────────────────────────────────────── */
.stbl {
    width: 100%;
    border-collapse: collapse;
    font-size: 12.5px;
    margin-bottom: 0;
}
.stbl th {
    background: #f0f3f4;
    border: 1px solid #c8d0d8;
    padding: 5px 7px;
    text-align: center;
    font-weight: 600;
    font-size: 11.5px;
    white-space: nowrap;
}
.stbl td {
    border: 1px solid #dde2e8;
    padding: 3px 5px;
    vertical-align: middle;
}
.stbl .form-control,
.stbl .form-select {
    border: none;
    border-radius: 0;
    padding: 2px 5px;
    font-size: 12px;
    height: 28px;
    background: transparent;
    box-shadow: none;
}
.stbl .form-control:focus,
.stbl .form-select:focus {
    background: #fffde7;
    border: 1px solid #3498db !important;
    box-shadow: none;
}
.stbl .amt-cell {
    text-align: right;
    background: #f8f9fa;
    font-weight: 500;
    padding-right: 7px;
    white-space: nowrap;
}
.stbl tfoot td {
    background: #eaf4fb;
    font-weight: 700;
    font-size: 12.5px;
    padding: 5px 7px;
}
.stbl tfoot .amt-cell { background: #d6eaf8; }

/* ── Rows ────────────────────────────────────────────── */
.stbl .saved-row td { background: #f9fffe; }
.stbl .saved-row:hover td { background: #f0faf8; }
/* checked = green highlight */
.stbl tr.row-checked td { background: #d5f5e3 !important; }
.stbl tr.row-checked:hover td { background: #abebc6 !important; }

/* ── Checkbox styling ────────────────────────────────── */
.row-check {
    width: 16px;
    height: 16px;
    cursor: pointer;
    accent-color: #27ae60;
}

/* ── Add / Remove btns ───────────────────────────────── */
.add-btn { font-size: 11.5px; padding: 3px 10px; margin-top: 4px; border-radius: 4px; }
.rm-btn {
    background: none; border: none; color: #e74c3c;
    cursor: pointer; font-size: 13px; padding: 0 3px; line-height: 1;
}
.rm-btn:hover { color: #c0392b; }

/* ── Save bar ────────────────────────────────────────── */
.save-bar {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    padding: 10px 16px;
    margin-top: 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 8px;
}
.save-bar .totals span { font-size: 12.5px; margin-right: 16px; }
.save-bar .totals strong { color: #2c3e50; }
.section-divider { border: none; border-top: 2px solid #ecf0f1; margin: 18px 0 14px; }
</style>

{{-- ══ DATE NAVIGATION ══════════════════════════════════════ --}}
<div class="date-nav">
    {{-- Previous --}}
    @if($prevDate)
        <a href="{{ route('sheets.index', ['date' => $prevDate]) }}" class="nav-date-btn">
            <i class="fas fa-chevron-left"></i> Previous
            <small style="opacity:.8;">({{ date('d M', strtotime($prevDate)) }})</small>
        </a>
    @else
        <span class="nav-date-btn disabled"><i class="fas fa-chevron-left"></i> Previous</span>
    @endif

    <span class="current-date">{{ date('d M Y', strtotime($date)) }}</span>

    {{-- Next --}}
    @if($nextDate)
        <a href="{{ route('sheets.index', ['date' => $nextDate]) }}" class="nav-date-btn">
            Next <small style="opacity:.8;">({{ date('d M', strtotime($nextDate)) }})</small>
            <i class="fas fa-chevron-right"></i>
        </a>
    @else
        <span class="nav-date-btn disabled">Next <i class="fas fa-chevron-right"></i></span>
    @endif

    {{-- Jump to date --}}
    <form action="{{ route('sheets.index') }}" method="GET" class="d-flex align-items-center gap-2 ms-auto">
        <input type="date" name="date" value="{{ $date }}">
        <button type="submit" class="nav-date-btn" style="background:#3498db;">
            <i class="fas fa-search"></i> Go
        </button>
    </form>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show py-2 mb-3" style="font-size:13px;">
    <i class="fas fa-check-circle"></i> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

{{-- ══ MAIN FORM ════════════════════════════════════════════ --}}
<form action="{{ route('sheets.store') }}" method="POST" id="sheetForm">
@csrf
<input type="hidden" name="date" value="{{ $date }}">

{{-- Datalists for vendor/customer autocomplete --}}
<datalist id="vendor-list">
    @foreach($vendors as $v)
        <option value="{{ $v->name }}">
    @endforeach
</datalist>
<datalist id="customer-list">
    @foreach($customers as $c)
        <option value="{{ $c->name }}">
    @endforeach
</datalist>

{{-- ── TOP: Purchase (left) + Sales (right) ─────────────── --}}
<div class="row g-3">

    {{-- PURCHASE --}}
    <div class="col-md-6">
        <span class="sec-label sec-purchase"><i class="fas fa-shopping-cart"></i> Purchase</span>
        <table class="stbl">
            <thead>
                <tr>
                    <th width="4%">#</th>
                    <th width="21%">Vendor</th>
                    <th width="25%">Item</th>
                    <th width="10%">Qty</th>
                    <th width="12%">Rate</th>
                    <th width="18%">Amount</th>
                    <th width="6%">✓</th>
                    <th width="4%"></th>
                </tr>
            </thead>

            {{-- Saved rows (read-only display) --}}
            <tbody id="savedPurchaseBody">
            @forelse($purchases as $i => $row)
                <tr class="saved-row" data-row-id="p_{{ $row->id }}">
                    <td class="text-center" style="color:#888;">{{ $i+1 }}</td>
                    <td>{{ $row->vendor_name ?? '-' }}</td>
                    <td>{{ $row->item_name ?? '-' }}</td>
                    <td class="text-center">{{ $row->quantity }}</td>
                    <td class="amt-cell">{{ number_format($row->rate,2) }}</td>
                    <td class="amt-cell">{{ number_format($row->amount,2) }}</td>
                    <td class="text-center">
                        <input type="checkbox" class="row-check" data-key="p_{{ $row->id }}"
                               style="width:15px;height:15px;cursor:pointer;">
                    </td>
                    <td></td>
                </tr>
            @empty
            @endforelse
            </tbody>

            {{-- New input rows --}}
            <tbody id="purchaseBody">
                <tr class="purchase-row">
                    <td class="text-center" style="font-size:11px;color:#aaa;">{{ $purchases->count()+1 }}</td>
                    <td>
                        <input type="text" name="purchase[0][vendor_name]" class="form-control p-vendor"
                               list="vendor-list" placeholder="Vendor name..." autocomplete="off">
                    </td>
                    <td>
                        <select name="purchase[0][item_id]" class="form-select p-item">
                            <option value="">-- Item --</option>
                            @foreach($items as $item)
                                <option value="{{ $item->id }}" data-price="{{ $item->purchase_price }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="number" name="purchase[0][quantity]" class="form-control p-qty text-center" min="1" value="1"></td>
                    <td><input type="number" name="purchase[0][rate]" class="form-control p-rate text-end" step="0.01" min="0" value="0"></td>
                    <td class="amt-cell p-amount">0</td>
                    <td class="text-center">
                        <input type="checkbox" class="new-row-check row-check" style="width:16px;height:16px;cursor:pointer;accent-color:#27ae60;">
                    </td>
                    <td><button type="button" class="rm-btn remove-purchase"><i class="fas fa-times"></i></button></td>
                </tr>
            </tbody>

            <tfoot>
                <tr>
                    <td colspan="5" class="text-end pe-2" style="font-size:12px;">Total:</td>
                    <td class="amt-cell" id="purchaseTotal">{{ number_format($purchases->sum('amount'),2) }}</td>
                    <td colspan="2"></td>
                </tr>
            </tfoot>
        </table>
        <button type="button" class="btn btn-outline-secondary add-btn" id="addPurchaseRow">
            <i class="fas fa-plus"></i> Add Row
        </button>
    </div>

    {{-- SALES --}}
    <div class="col-md-6">
        <span class="sec-label sec-sale"><i class="fas fa-cash-register"></i> Sales</span>
        <table class="stbl">
            <thead>
                <tr>
                    <th width="4%">#</th>
                    <th width="21%">Customer</th>
                    <th width="25%">Item</th>
                    <th width="10%">Qty</th>
                    <th width="12%">Rate</th>
                    <th width="18%">Amount</th>
                    <th width="6%">✓</th>
                    <th width="4%"></th>
                </tr>
            </thead>

            <tbody id="savedSalesBody">
            @forelse($sales as $i => $row)
                <tr class="saved-row" data-row-id="s_{{ $row->id }}">
                    <td class="text-center" style="color:#888;">{{ $i+1 }}</td>
                    <td>{{ $row->customer_name ?? '-' }}</td>
                    <td>{{ $row->item_name ?? '-' }}</td>
                    <td class="text-center">{{ $row->quantity }}</td>
                    <td class="amt-cell">{{ number_format($row->rate,2) }}</td>
                    <td class="amt-cell">{{ number_format($row->amount,2) }}</td>
                    <td class="text-center">
                        <input type="checkbox" class="row-check" data-key="s_{{ $row->id }}"
                               style="width:15px;height:15px;cursor:pointer;">
                    </td>
                    <td></td>
                </tr>
            @empty
            @endforelse
            </tbody>

            <tbody id="salesBody">
                <tr class="sale-row">
                    <td class="text-center" style="font-size:11px;color:#aaa;">{{ $sales->count()+1 }}</td>
                    <td>
                        <input type="text" name="sale[0][customer_name]" class="form-control s-customer"
                               list="customer-list" placeholder="Customer name..." autocomplete="off">
                    </td>
                    <td>
                        <select name="sale[0][item_id]" class="form-select s-item">
                            <option value="">-- Item --</option>
                            @foreach($items as $item)
                                <option value="{{ $item->id }}" data-price="{{ $item->selling_price }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="number" name="sale[0][quantity]" class="form-control s-qty text-center" min="1" value="1"></td>
                    <td><input type="number" name="sale[0][rate]" class="form-control s-rate text-end" step="0.01" min="0" value="0"></td>
                    <td class="amt-cell s-amount">0</td>
                    <td class="text-center">
                        <input type="checkbox" class="new-row-check row-check" style="width:16px;height:16px;cursor:pointer;accent-color:#27ae60;">
                    </td>
                    <td><button type="button" class="rm-btn remove-sale"><i class="fas fa-times"></i></button></td>
                </tr>
            </tbody>

            <tfoot>
                <tr>
                    <td colspan="5" class="text-end pe-2" style="font-size:12px;">Total:</td>
                    <td class="amt-cell" id="salesTotal">{{ number_format($sales->sum('amount'),2) }}</td>
                    <td colspan="2"></td>
                </tr>
            </tfoot>
        </table>
        <button type="button" class="btn btn-outline-secondary add-btn" id="addSaleRow">
            <i class="fas fa-plus"></i> Add Row
        </button>
    </div>
</div>

<hr class="section-divider">

{{-- ── BOTTOM: Cash Book Receipt (left) + Payments (right) ── --}}
<div class="row g-3">

    {{-- RECEIPT --}}
    <div class="col-md-6">
        <span class="sec-label sec-receipt"><i class="fas fa-book"></i> Cash Book - Receipt</span>
        <table class="stbl">
            <thead>
                <tr>
                    <th width="4%">#</th>
                    <th width="38%">From</th>
                    <th width="22%">Status</th>
                    <th width="22%">Amount</th>
                    <th width="6%">✓</th>
                    <th width="8%"></th>
                </tr>
            </thead>

            <tbody id="savedReceiptBody">
            @forelse($receipts as $i => $row)
                <tr class="saved-row">
                    <td class="text-center" style="color:#888;">{{ $i+1 }}</td>
                    <td>{{ $row->from_party }}</td>
                    <td class="text-center">
                        <span class="badge {{ $row->status=='received' ? 'bg-success' : 'bg-warning text-dark' }}" style="font-size:10px;">
                            {{ ucfirst($row->status) }}
                        </span>
                    </td>
                    <td class="amt-cell">{{ number_format($row->amount,2) }}</td>
                    <td class="text-center">
                        <input type="checkbox" class="row-check" data-key="r_{{ $row->id }}" style="width:16px;height:16px;cursor:pointer;accent-color:#8e44ad;">
                    </td>
                    <td></td>
                </tr>
            @empty
            @endforelse
            </tbody>

            <tbody id="receiptBody">
                <tr class="receipt-row">
                    <td class="text-center" style="font-size:11px;color:#aaa;">{{ $receipts->count()+1 }}</td>
                    <td><input type="text" name="receipt[0][from]" class="form-control" placeholder="From..."></td>
                    <td>
                        <select name="receipt[0][status]" class="form-select">
                            <option value="received">Received</option>
                            <option value="pending">Pending</option>
                        </select>
                    </td>
                    <td><input type="number" name="receipt[0][amount]" class="form-control r-amount text-end" step="0.01" min="0" value="0"></td>
                    <td class="text-center">
                        <input type="checkbox" class="new-row-check row-check" style="width:16px;height:16px;cursor:pointer;accent-color:#8e44ad;">
                    </td>
                    <td><button type="button" class="rm-btn remove-receipt"><i class="fas fa-times"></i></button></td>
                </tr>
            </tbody>

            <tfoot>
                <tr>
                    <td colspan="3" class="text-end pe-2" style="font-size:12px;">Total:</td>
                    <td class="amt-cell" id="receiptTotal">{{ number_format($receipts->sum('amount'),2) }}</td>
                    <td colspan="2"></td>
                </tr>
            </tfoot>
        </table>
        <button type="button" class="btn btn-outline-secondary add-btn" id="addReceiptRow">
            <i class="fas fa-plus"></i> Add Row
        </button>
    </div>

    {{-- PAYMENTS --}}
    <div class="col-md-6">
        <span class="sec-label sec-payment"><i class="fas fa-money-bill-wave"></i> Cash Book - Payments</span>
        <table class="stbl">
            <thead>
                <tr>
                    <th width="4%">#</th>
                    <th width="38%">To</th>
                    <th width="22%">Status</th>
                    <th width="22%">Amount</th>
                    <th width="6%">✓</th>
                    <th width="8%"></th>
                </tr>
            </thead>

            <tbody id="savedPaymentBody">
            @forelse($payments as $i => $row)
                <tr class="saved-row">
                    <td class="text-center" style="color:#888;">{{ $i+1 }}</td>
                    <td>{{ $row->to_party }}</td>
                    <td class="text-center">
                        <span class="badge {{ $row->status=='paid' ? 'bg-success' : 'bg-warning text-dark' }}" style="font-size:10px;">
                            {{ ucfirst($row->status) }}
                        </span>
                    </td>
                    <td class="amt-cell">{{ number_format($row->amount,2) }}</td>
                    <td class="text-center">
                        <input type="checkbox" class="row-check" data-key="py_{{ $row->id }}" style="width:16px;height:16px;cursor:pointer;accent-color:#e67e22;">
                    </td>
                    <td></td>
                </tr>
            @empty
            @endforelse
            </tbody>

            <tbody id="paymentBody">
                <tr class="payment-row">
                    <td class="text-center" style="font-size:11px;color:#aaa;">{{ $payments->count()+1 }}</td>
                    <td><input type="text" name="payment[0][to]" class="form-control" placeholder="To..."></td>
                    <td>
                        <select name="payment[0][status]" class="form-select">
                            <option value="paid">Paid</option>
                            <option value="pending">Pending</option>
                        </select>
                    </td>
                    <td><input type="number" name="payment[0][amount]" class="form-control py-amount text-end" step="0.01" min="0" value="0"></td>
                    <td class="text-center">
                        <input type="checkbox" class="new-row-check row-check" style="width:16px;height:16px;cursor:pointer;accent-color:#e67e22;">
                    </td>
                    <td><button type="button" class="rm-btn remove-payment"><i class="fas fa-times"></i></button></td>
                </tr>
            </tbody>

            <tfoot>
                <tr>
                    <td colspan="3" class="text-end pe-2" style="font-size:12px;">Total:</td>
                    <td class="amt-cell" id="paymentTotal">{{ number_format($payments->sum('amount'),2) }}</td>
                    <td colspan="2"></td>
                </tr>
            </tfoot>
        </table>
        <button type="button" class="btn btn-outline-secondary add-btn" id="addPaymentRow">
            <i class="fas fa-plus"></i> Add Row
        </button>
    </div>
</div>

{{-- ── JOURNAL ENTRY SECTION ────────────────────────────── --}}
<hr class="section-divider">
<div class="row g-3">
    <div class="col-md-12">
        <span class="sec-label sec-journal"><i class="fas fa-exchange-alt"></i> Journal Entry (Hawala)</span>
        <table class="stbl">
            <thead>
                <tr>
                    <th width="4%">#</th>
                    <th width="22%">Debit (Transfer To)</th>
                    <th width="22%">Credit (Transfer From)</th>
                    <th width="15%">Amount</th>
                    <th width="28%">Description</th>
                    <th width="5%">✓</th>
                    <th width="4%"></th>
                </tr>
            </thead>

            {{-- Saved journal rows --}}
            <tbody id="savedJournalBody">
            @forelse($journals as $i => $row)
                <tr class="saved-row">
                    <td class="text-center" style="color:#888;">{{ $i+1 }}</td>
                    <td>{{ $row->debit_party ?? '-' }}</td>
                    <td>{{ $row->credit_party ?? '-' }}</td>
                    <td class="amt-cell">{{ number_format($row->amount,2) }}</td>
                    <td style="font-size:11px; color:#555;">{{ $row->description }}</td>
                    <td class="text-center">
                        <input type="checkbox" class="row-check" data-key="j_{{ $row->id }}"
                               style="width:16px;height:16px;cursor:pointer;accent-color:#455a64;">
                    </td>
                    <td></td>
                </tr>
            @empty
            @endforelse
            </tbody>

            {{-- New input rows --}}
            <tbody id="journalBody">
                <tr class="journal-row">
                    <td class="text-center" style="font-size:11px;color:#aaa;">{{ $journals->count()+1 }}</td>
                    <td>
                        <input type="text" name="journal[0][debit_party]" class="form-control j-debit"
                               list="all-parties-list" placeholder="Debit party..." autocomplete="off">
                    </td>
                    <td>
                        <input type="text" name="journal[0][credit_party]" class="form-control j-credit"
                               list="all-parties-list" placeholder="Credit party..." autocomplete="off">
                    </td>
                    <td><input type="number" name="journal[0][amount]" class="form-control j-amount text-end" step="0.01" min="0" value="0"></td>
                    <td><input type="text" name="journal[0][description]" class="form-control" placeholder="Description..."></td>
                    <td class="text-center">
                        <input type="checkbox" class="new-row-check row-check" style="width:16px;height:16px;cursor:pointer;accent-color:#455a64;">
                    </td>
                    <td><button type="button" class="rm-btn remove-journal"><i class="fas fa-times"></i></button></td>
                </tr>
            </tbody>

            <tfoot>
                <tr>
                    <td colspan="3" class="text-end pe-2" style="font-size:12px;">Total:</td>
                    <td class="amt-cell" id="journalTotal">{{ number_format($journals->sum('amount'),2) }}</td>
                    <td colspan="3"></td>
                </tr>
            </tfoot>
        </table>
        <button type="button" class="btn btn-outline-secondary add-btn" id="addJournalRow">
            <i class="fas fa-plus"></i> Add Row
        </button>
    </div>
</div>

{{-- Datalist: all vendors + customers combined for journal --}}
<datalist id="all-parties-list">
    @foreach($vendors as $v)
        <option value="{{ $v->name }}">
    @endforeach
    @foreach($customers as $c)
        <option value="{{ $c->name }}">
    @endforeach
</datalist>

{{-- ── Save Bar ──────────────────────────────────────────── --}}
<div class="save-bar">
    <div class="totals">
        <span>Purchase: <strong id="sumPurchase">Rs {{ number_format($purchases->sum('amount'),2) }}</strong></span>
        <span>Sales: <strong id="sumSales">Rs {{ number_format($sales->sum('amount'),2) }}</strong></span>
        <span>Receipt: <strong id="sumReceipt">Rs {{ number_format($receipts->sum('amount'),2) }}</strong></span>
        <span>Payment: <strong id="sumPayment">Rs {{ number_format($payments->sum('amount'),2) }}</strong></span>
        <span>Journal: <strong id="sumJournal">Rs {{ number_format($journals->sum('amount'),2) }}</strong></span>
    </div>
    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary btn-sm px-4">
            <i class="fas fa-save"></i> Save Entries
        </button>
        @if($prevDate)
        <a href="{{ route('sheets.index', ['date' => $prevDate]) }}" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-chevron-left"></i> Previous Day
        </a>
        @endif
        @if($nextDate)
        <a href="{{ route('sheets.index', ['date' => $nextDate]) }}" class="btn btn-outline-secondary btn-sm">
            Next Day <i class="fas fa-chevron-right"></i>
        </a>
        @endif
    </div>
</div>

</form>

<script>
let pCount = 1, sCount = 1, rCount = 1, pyCount = 1, jCount = 1;
const savedP  = {{ $purchases->count() }};
const savedS  = {{ $sales->count() }};
const savedR  = {{ $receipts->count() }};
const savedPy = {{ $payments->count() }};
const savedJ  = {{ $journals->count() }};

function fmt(n) {
    return Number(n).toLocaleString('en-PK', {minimumFractionDigits:2, maximumFractionDigits:2});
}
function reIndex(tbody, offset) {
    tbody.querySelectorAll('tr').forEach((tr, i) => {
        tr.querySelector('td:first-child').textContent = offset + i + 1;
    });
}

// ── Calculations ──────────────────────────────────────────────
function calcP(row) {
    const q = parseFloat(row.querySelector('.p-qty').value) || 0;
    const r = parseFloat(row.querySelector('.p-rate').value) || 0;
    row.querySelector('.p-amount').textContent = fmt(q * r);
    totalP();
}
function totalP() {
    let t = {{ $purchases->sum('amount') }};
    document.querySelectorAll('#purchaseBody .p-amount').forEach(c => t += parseFloat(c.textContent.replace(/,/g,'')) || 0);
    document.getElementById('purchaseTotal').textContent = fmt(t);
    document.getElementById('sumPurchase').textContent = 'Rs ' + fmt(t);
}
function calcS(row) {
    const q = parseFloat(row.querySelector('.s-qty').value) || 0;
    const r = parseFloat(row.querySelector('.s-rate').value) || 0;
    row.querySelector('.s-amount').textContent = fmt(q * r);
    totalS();
}
function totalS() {
    let t = {{ $sales->sum('amount') }};
    document.querySelectorAll('#salesBody .s-amount').forEach(c => t += parseFloat(c.textContent.replace(/,/g,'')) || 0);
    document.getElementById('salesTotal').textContent = fmt(t);
    document.getElementById('sumSales').textContent = 'Rs ' + fmt(t);
}
function totalR() {
    let t = {{ $receipts->sum('amount') }};
    document.querySelectorAll('#receiptBody .r-amount').forEach(i => t += parseFloat(i.value) || 0);
    document.getElementById('receiptTotal').textContent = fmt(t);
    document.getElementById('sumReceipt').textContent = 'Rs ' + fmt(t);
}
function totalPy() {
    let t = {{ $payments->sum('amount') }};
    document.querySelectorAll('#paymentBody .py-amount').forEach(i => t += parseFloat(i.value) || 0);
    document.getElementById('paymentTotal').textContent = fmt(t);
    document.getElementById('sumPayment').textContent = 'Rs ' + fmt(t);
}

function totalJ() {
    let t = {{ $journals->sum('amount') }};
    document.querySelectorAll('#journalBody .j-amount').forEach(i => t += parseFloat(i.value) || 0);
    document.getElementById('journalTotal').textContent = fmt(t);
    document.getElementById('sumJournal').textContent = 'Rs ' + fmt(t);
}

// ── Auto price fill ───────────────────────────────────────────
document.addEventListener('change', function(e) {
    if (e.target.classList.contains('p-item')) {
        const row = e.target.closest('tr');
        const opt = e.target.options[e.target.selectedIndex];
        if (opt.value) row.querySelector('.p-rate').value = opt.dataset.price || 0;
        calcP(row);
    }
    if (e.target.classList.contains('s-item')) {
        const row = e.target.closest('tr');
        const opt = e.target.options[e.target.selectedIndex];
        if (opt.value) row.querySelector('.s-rate').value = opt.dataset.price || 0;
        calcS(row);
    }
});

document.addEventListener('input', function(e) {
    if (e.target.classList.contains('p-qty') || e.target.classList.contains('p-rate')) calcP(e.target.closest('tr'));
    if (e.target.classList.contains('s-qty') || e.target.classList.contains('s-rate')) calcS(e.target.closest('tr'));
    if (e.target.classList.contains('r-amount'))  totalR();
    if (e.target.classList.contains('py-amount')) totalPy();
    if (e.target.classList.contains('j-amount'))  totalJ();
});

// ── Add rows ──────────────────────────────────────────────────
function addRow(tbodyId, prefix, counter, savedCount) {
    const tbody = document.getElementById(tbodyId);
    const tmpl  = tbody.querySelector('tr').cloneNode(true);
    tmpl.querySelectorAll('select').forEach(s => s.selectedIndex = 0);
    tmpl.querySelectorAll('input[type=number]').forEach(i => i.value = i.classList.contains('p-qty') || i.classList.contains('s-qty') ? 1 : 0);
    tmpl.querySelectorAll('input[type=text]').forEach(i => i.value = '');
    if (tmpl.querySelector('.p-amount')) tmpl.querySelector('.p-amount').textContent = '0.00';
    if (tmpl.querySelector('.s-amount')) tmpl.querySelector('.s-amount').textContent = '0.00';
    // Always uncheck checkbox in cloned row and remove data-key
    const clonedCb = tmpl.querySelector('.new-row-check');
    if (clonedCb) {
        clonedCb.checked = false;
        clonedCb.removeAttribute('data-key');
    }
    tmpl.querySelectorAll('[name]').forEach(el => {
        el.name = el.name.replace(new RegExp(prefix + '\\[\\d+\\]'), prefix + '[' + counter + ']');
    });
    tbody.appendChild(tmpl);
    reIndex(tbody, savedCount);
    return counter + 1;
}

document.getElementById('addPurchaseRow').addEventListener('click', () => { pCount  = addRow('purchaseBody','purchase',pCount,savedP); });
document.getElementById('addSaleRow').addEventListener('click',     () => { sCount  = addRow('salesBody','sale',sCount,savedS); });
document.getElementById('addReceiptRow').addEventListener('click',  () => { rCount  = addRow('receiptBody','receipt',rCount,savedR); });
document.getElementById('addPaymentRow').addEventListener('click',  () => { pyCount = addRow('paymentBody','payment',pyCount,savedPy); });
document.getElementById('addJournalRow').addEventListener('click',  () => { jCount  = addRow('journalBody','journal',jCount,savedJ); });

// ── Auto-add 4 more rows on load (total 5 empty rows) ─────────
for (let i = 0; i < 4; i++) { pCount  = addRow('purchaseBody', 'purchase', pCount,  savedP);  }
for (let i = 0; i < 4; i++) { sCount  = addRow('salesBody',    'sale',     sCount,  savedS);  }
for (let i = 0; i < 4; i++) { rCount  = addRow('receiptBody',  'receipt',  rCount,  savedR);  }
for (let i = 0; i < 4; i++) { pyCount = addRow('paymentBody',  'payment',  pyCount, savedPy); }
for (let i = 0; i < 4; i++) { jCount  = addRow('journalBody',  'journal',  jCount,  savedJ);  }

// ── Remove rows ───────────────────────────────────────────────
document.addEventListener('click', function(e) {
    const btn = e.target.closest('.rm-btn');
    if (!btn) return;
    const map = {
        'remove-purchase': ['purchaseBody', savedP,  totalP],
        'remove-sale':     ['salesBody',    savedS,  totalS],
        'remove-receipt':  ['receiptBody',  savedR,  totalR],
        'remove-payment':  ['paymentBody',  savedPy, totalPy],
        'remove-journal':  ['journalBody',  savedJ,  totalJ],
    };
    for (const [cls, [tbodyId, offset, calcFn]] of Object.entries(map)) {
        if (btn.classList.contains(cls)) {
            const tbody = document.getElementById(tbodyId);
            if (tbody.querySelectorAll('tr').length > 1) {
                btn.closest('tr').remove();
                reIndex(tbody, offset);
                calcFn();
            }
            break;
        }
    }
});
// ── On Submit: disable unchecked new rows so they don't save ──
document.getElementById('sheetForm').addEventListener('submit', function() {
    // For each new input tbody, disable all inputs in UNCHECKED rows
    ['purchaseBody','salesBody','receiptBody','paymentBody','journalBody'].forEach(function(tbodyId) {
        const tbody = document.getElementById(tbodyId);
        if (!tbody) return;
        tbody.querySelectorAll('tr').forEach(function(tr) {
            const cb = tr.querySelector('.new-row-check');
            if (cb && !cb.checked) {
                // Disable all inputs/selects in this row so they won't be submitted
                tr.querySelectorAll('input, select').forEach(function(el) {
                    el.disabled = true;
                });
            }
        });
    });
});
// ── Checkbox: localStorage persist ───────────────────────────
// Saved rows use data-key (e.g. p_5, s_3)
// New input rows have no data-key - they are always unchecked by default
function initCheckboxes() {
    document.querySelectorAll('.row-check[data-key]').forEach(function(cb) {
        const storageKey = 'chk_' + cb.dataset.key;
        // Restore state on page load
        if (localStorage.getItem(storageKey) === '1') {
            cb.checked = true;
            cb.closest('tr').classList.add('row-checked');
        } else {
            cb.checked = false;
            cb.closest('tr').classList.remove('row-checked');
        }
        // Save state on change
        cb.addEventListener('change', function() {
            if (this.checked) {
                localStorage.setItem(storageKey, '1');
                this.closest('tr').classList.add('row-checked');
            } else {
                localStorage.removeItem(storageKey);
                this.closest('tr').classList.remove('row-checked');
            }
        });
    });

    // New input rows - always unchecked, just handle visual highlight
    document.querySelectorAll('.new-row-check').forEach(function(cb) {
        cb.checked = false;
        cb.addEventListener('change', function() {
            if (this.checked) {
                this.closest('tr').classList.add('row-checked');
            } else {
                this.closest('tr').classList.remove('row-checked');
            }
        });
    });
}
initCheckboxes();
</script>
@endsection
