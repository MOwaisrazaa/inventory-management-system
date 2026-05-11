@extends('layout')

@section('title', 'Create Sheet')

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
    .page-header h4 {
        margin: 0;
        font-size: 18px;
    }
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
    .page-header .nav-btns a:hover {
        background: rgba(255,255,255,0.15);
    }
    .page-header .nav-btns a.active-btn {
        background: #3498db;
        border-color: #3498db;
    }

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

    .sheet-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }
    .sheet-table th {
        background: #ecf0f1;
        border: 1px solid #bdc3c7;
        padding: 6px 8px;
        text-align: center;
        font-weight: 600;
        font-size: 12px;
    }
    .sheet-table td {
        border: 1px solid #dde;
        padding: 4px 5px;
        vertical-align: middle;
    }
    .sheet-table .form-control,
    .sheet-table .form-select {
        border: none;
        border-radius: 0;
        padding: 3px 5px;
        font-size: 12px;
        height: 30px;
        background: transparent;
    }
    .sheet-table .form-control:focus,
    .sheet-table .form-select:focus {
        background: #fffde7;
        box-shadow: none;
        border: 1px solid #3498db;
    }
    .sheet-table .amount-cell {
        background: #f8f9fa;
        text-align: right;
        font-weight: 500;
        padding-right: 8px;
    }
    .total-row td {
        background: #eaf4fb;
        font-weight: 700;
        font-size: 13px;
    }
    .add-row-btn {
        font-size: 12px;
        padding: 3px 10px;
        margin-top: 6px;
    }
    .remove-btn {
        background: none;
        border: none;
        color: #e74c3c;
        cursor: pointer;
        font-size: 14px;
        padding: 0 4px;
    }
    .remove-btn:hover { color: #c0392b; }

    .divider-col {
        width: 20px;
        background: #f8f9fa;
    }

    .cashbook-section {
        margin-top: 24px;
    }
    .cashbook-section .sheet-table th {
        background: #d5e8d4;
    }

    .save-bar {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 6px;
        padding: 12px 16px;
        margin-top: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .totals-summary span {
        font-size: 13px;
        margin-right: 20px;
    }
    .totals-summary strong {
        color: #2c3e50;
    }
</style>

<!-- Page Header with Navigation -->
<div class="page-header">
    <h4><i class="fas fa-file-alt"></i> Sale / Purchase Sheet</h4>
    <div class="nav-btns">
        <a href="{{ route('sheets.create') }}" class="active-btn">
            <i class="fas fa-plus-circle"></i> Create Sheet
        </a>
        <a href="{{ route('sheets.list') }}">
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

<form action="{{ route('sheets.store') }}" method="POST" id="sheetForm">
@csrf

<!-- Date Row -->
<div class="row mb-3">
    <div class="col-md-3">
        <div class="d-flex align-items-center gap-2">
            <label class="fw-semibold mb-0" style="white-space:nowrap; font-size:13px;">Date:</label>
            <input type="date" name="date" class="form-control form-control-sm @error('date') is-invalid @enderror"
                   value="{{ old('date', date('Y-m-d')) }}" required>
        </div>
        @error('date')<div class="text-danger" style="font-size:11px;">{{ $message }}</div>@enderror
    </div>
</div>

<!-- Main Sheet: Purchase (left) + Sales (right) -->
<div class="row g-2">

    <!-- PURCHASE SECTION -->
    <div class="col-md-6">
        <span class="section-title"><i class="fas fa-shopping-cart"></i> Purchase</span>
        <table class="sheet-table" id="purchaseTable">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th width="28%">Vendor</th>
                    <th width="28%">Item</th>
                    <th width="12%">Qty</th>
                    <th width="12%">Rate</th>
                    <th width="12%">Amount</th>
                    <th width="3%"></th>
                </tr>
            </thead>
            <tbody id="purchaseBody">
                <tr class="purchase-row">
                    <td class="text-center" style="font-size:11px; color:#999;">1</td>
                    <td>
                        <select name="purchase[0][vendor_id]" class="form-select p-vendor">
                            <option value="">-- Vendor --</option>
                            @foreach($vendors as $v)
                                <option value="{{ $v->id }}">{{ $v->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select name="purchase[0][item_id]" class="form-select p-item"
                                data-purchase-prices="{{ json_encode($items->pluck('purchase_price','id')) }}">
                            <option value="">-- Item --</option>
                            @foreach($items as $item)
                                <option value="{{ $item->id }}" data-price="{{ $item->purchase_price }}">
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="number" name="purchase[0][quantity]" class="form-control p-qty text-center" min="1" value="1"></td>
                    <td><input type="number" name="purchase[0][rate]" class="form-control p-rate text-end" step="0.01" min="0" value="0"></td>
                    <td class="amount-cell p-amount">0</td>
                    <td><button type="button" class="remove-btn remove-purchase" title="Remove"><i class="fas fa-times"></i></button></td>
                </tr>
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="5" class="text-end pe-2">Total Purchase:</td>
                    <td class="amount-cell" id="purchaseTotal">0</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
        <button type="button" class="btn btn-outline-secondary add-row-btn" id="addPurchaseRow">
            <i class="fas fa-plus"></i> Add Row
        </button>
    </div>

    <!-- SALES SECTION -->
    <div class="col-md-6">
        <span class="section-title" style="background:#27ae60;"><i class="fas fa-cash-register"></i> Sales</span>
        <table class="sheet-table" id="salesTable">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th width="28%">Customer</th>
                    <th width="28%">Item</th>
                    <th width="12%">Qty</th>
                    <th width="12%">Rate</th>
                    <th width="12%">Amount</th>
                    <th width="3%"></th>
                </tr>
            </thead>
            <tbody id="salesBody">
                <tr class="sale-row">
                    <td class="text-center" style="font-size:11px; color:#999;">1</td>
                    <td>
                        <select name="sale[0][customer_id]" class="form-select s-customer">
                            <option value="">-- Customer --</option>
                            @foreach($customers as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select name="sale[0][item_id]" class="form-select s-item">
                            <option value="">-- Item --</option>
                            @foreach($items as $item)
                                <option value="{{ $item->id }}" data-price="{{ $item->sale_price }}">
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="number" name="sale[0][quantity]" class="form-control s-qty text-center" min="1" value="1"></td>
                    <td><input type="number" name="sale[0][rate]" class="form-control s-rate text-end" step="0.01" min="0" value="0"></td>
                    <td class="amount-cell s-amount">0</td>
                    <td><button type="button" class="remove-btn remove-sale" title="Remove"><i class="fas fa-times"></i></button></td>
                </tr>
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="5" class="text-end pe-2">Total Sales:</td>
                    <td class="amount-cell" id="salesTotal">0</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
        <button type="button" class="btn btn-outline-secondary add-row-btn" id="addSaleRow">
            <i class="fas fa-plus"></i> Add Row
        </button>
    </div>
</div>

<!-- CASH BOOK SECTION -->
<div class="cashbook-section">
    <div class="row g-2">

        <!-- Receipt -->
        <div class="col-md-6">
            <span class="section-title" style="background:#8e44ad;"><i class="fas fa-book"></i> Cash Book - Receipt</span>
            <table class="sheet-table" id="receiptTable">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="40%">From</th>
                        <th width="25%">Status</th>
                        <th width="25%">Amount</th>
                        <th width="5%"></th>
                    </tr>
                </thead>
                <tbody id="receiptBody">
                    <tr class="receipt-row">
                        <td class="text-center" style="font-size:11px; color:#999;">1</td>
                        <td><input type="text" name="receipt[0][from]" class="form-control" placeholder="From..."></td>
                        <td>
                            <select name="receipt[0][status]" class="form-select">
                                <option value="received">Received</option>
                                <option value="pending">Pending</option>
                            </select>
                        </td>
                        <td><input type="number" name="receipt[0][amount]" class="form-control r-amount text-end" step="0.01" min="0" value="0"></td>
                        <td><button type="button" class="remove-btn remove-receipt"><i class="fas fa-times"></i></button></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="total-row">
                        <td colspan="3" class="text-end pe-2">Total Receipt:</td>
                        <td class="amount-cell" id="receiptTotal">0</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
            <button type="button" class="btn btn-outline-secondary add-row-btn" id="addReceiptRow">
                <i class="fas fa-plus"></i> Add Row
            </button>
        </div>

        <!-- Payments -->
        <div class="col-md-6">
            <span class="section-title" style="background:#e67e22;"><i class="fas fa-money-bill-wave"></i> Cash Book - Payments</span>
            <table class="sheet-table" id="paymentTable">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="40%">To</th>
                        <th width="25%">Status</th>
                        <th width="25%">Amount</th>
                        <th width="5%"></th>
                    </tr>
                </thead>
                <tbody id="paymentBody">
                    <tr class="payment-row">
                        <td class="text-center" style="font-size:11px; color:#999;">1</td>
                        <td><input type="text" name="payment[0][to]" class="form-control" placeholder="To..."></td>
                        <td>
                            <select name="payment[0][status]" class="form-select">
                                <option value="paid">Paid</option>
                                <option value="pending">Pending</option>
                            </select>
                        </td>
                        <td><input type="number" name="payment[0][amount]" class="form-control py-amount text-end" step="0.01" min="0" value="0"></td>
                        <td><button type="button" class="remove-btn remove-payment"><i class="fas fa-times"></i></button></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="total-row">
                        <td colspan="3" class="text-end pe-2">Total Payment:</td>
                        <td class="amount-cell" id="paymentTotal">0</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
            <button type="button" class="btn btn-outline-secondary add-row-btn" id="addPaymentRow">
                <i class="fas fa-plus"></i> Add Row
            </button>
        </div>
    </div>
</div>

<!-- Save Bar -->
<div class="save-bar">
    <div class="totals-summary">
        <span>Purchase: <strong id="summaryPurchase">Rs 0</strong></span>
        <span>Sales: <strong id="summarySales">Rs 0</strong></span>
        <span>Receipt: <strong id="summaryReceipt">Rs 0</strong></span>
        <span>Payment: <strong id="summaryPayment">Rs 0</strong></span>
    </div>
    <div>
        <button type="submit" class="btn btn-primary btn-sm px-4">
            <i class="fas fa-save"></i> Save Sheet
        </button>
        <a href="{{ route('sheets.list') }}" class="btn btn-secondary btn-sm px-3 ms-2">
            <i class="fas fa-times"></i> Cancel
        </a>
    </div>
</div>

</form>

<script>
// ─── Row counters ───────────────────────────────────────────────
let pCount = 1, sCount = 1, rCount = 1, pyCount = 1;

// ─── Helpers ────────────────────────────────────────────────────
function fmt(n) {
    return Number(n).toLocaleString('en-PK', { minimumFractionDigits: 0, maximumFractionDigits: 2 });
}

function rowIndex(tbody, cls) {
    tbody.querySelectorAll('tr').forEach((tr, i) => {
        tr.querySelector('td:first-child').textContent = i + 1;
    });
}

// ─── Purchase calculations ───────────────────────────────────────
function calcPurchaseRow(row) {
    const qty  = parseFloat(row.querySelector('.p-qty').value)  || 0;
    const rate = parseFloat(row.querySelector('.p-rate').value) || 0;
    row.querySelector('.p-amount').textContent = fmt(qty * rate);
    calcPurchaseTotal();
}

function calcPurchaseTotal() {
    let t = 0;
    document.querySelectorAll('#purchaseBody .p-amount').forEach(c => t += parseFloat(c.textContent.replace(/,/g,'')) || 0);
    document.getElementById('purchaseTotal').textContent = fmt(t);
    document.getElementById('summaryPurchase').textContent = 'Rs ' + fmt(t);
}

// ─── Sales calculations ──────────────────────────────────────────
function calcSaleRow(row) {
    const qty  = parseFloat(row.querySelector('.s-qty').value)  || 0;
    const rate = parseFloat(row.querySelector('.s-rate').value) || 0;
    row.querySelector('.s-amount').textContent = fmt(qty * rate);
    calcSaleTotal();
}

function calcSaleTotal() {
    let t = 0;
    document.querySelectorAll('#salesBody .s-amount').forEach(c => t += parseFloat(c.textContent.replace(/,/g,'')) || 0);
    document.getElementById('salesTotal').textContent = fmt(t);
    document.getElementById('summarySales').textContent = 'Rs ' + fmt(t);
}

// ─── Receipt / Payment totals ────────────────────────────────────
function calcReceiptTotal() {
    let t = 0;
    document.querySelectorAll('#receiptBody .r-amount').forEach(i => t += parseFloat(i.value) || 0);
    document.getElementById('receiptTotal').textContent = fmt(t);
    document.getElementById('summaryReceipt').textContent = 'Rs ' + fmt(t);
}

function calcPaymentTotal() {
    let t = 0;
    document.querySelectorAll('#paymentBody .py-amount').forEach(i => t += parseFloat(i.value) || 0);
    document.getElementById('paymentTotal').textContent = fmt(t);
    document.getElementById('summaryPayment').textContent = 'Rs ' + fmt(t);
}

// ─── Auto-fill price on item select ─────────────────────────────
document.addEventListener('change', function(e) {
    // Purchase item
    if (e.target.classList.contains('p-item')) {
        const row = e.target.closest('tr');
        const opt = e.target.options[e.target.selectedIndex];
        if (opt.value) row.querySelector('.p-rate').value = opt.dataset.price || 0;
        calcPurchaseRow(row);
    }
    // Sale item
    if (e.target.classList.contains('s-item')) {
        const row = e.target.closest('tr');
        const opt = e.target.options[e.target.selectedIndex];
        if (opt.value) row.querySelector('.s-rate').value = opt.dataset.price || 0;
        calcSaleRow(row);
    }
});

// ─── Input listeners ─────────────────────────────────────────────
document.addEventListener('input', function(e) {
    if (e.target.classList.contains('p-qty') || e.target.classList.contains('p-rate'))
        calcPurchaseRow(e.target.closest('tr'));
    if (e.target.classList.contains('s-qty') || e.target.classList.contains('s-rate'))
        calcSaleRow(e.target.closest('tr'));
    if (e.target.classList.contains('r-amount'))  calcReceiptTotal();
    if (e.target.classList.contains('py-amount')) calcPaymentTotal();
});

// ─── Add Purchase Row ────────────────────────────────────────────
document.getElementById('addPurchaseRow').addEventListener('click', function() {
    const tbody = document.getElementById('purchaseBody');
    const tmpl  = tbody.querySelector('tr').cloneNode(true);
    tmpl.querySelectorAll('select').forEach(s => { s.selectedIndex = 0; });
    tmpl.querySelector('.p-qty').value  = 1;
    tmpl.querySelector('.p-rate').value = 0;
    tmpl.querySelector('.p-amount').textContent = '0';
    // rename fields
    tmpl.querySelectorAll('[name]').forEach(el => {
        el.name = el.name.replace(/purchase\[\d+\]/, 'purchase[' + pCount + ']');
    });
    tbody.appendChild(tmpl);
    rowIndex(tbody);
    pCount++;
});

// ─── Add Sale Row ────────────────────────────────────────────────
document.getElementById('addSaleRow').addEventListener('click', function() {
    const tbody = document.getElementById('salesBody');
    const tmpl  = tbody.querySelector('tr').cloneNode(true);
    tmpl.querySelectorAll('select').forEach(s => { s.selectedIndex = 0; });
    tmpl.querySelector('.s-qty').value  = 1;
    tmpl.querySelector('.s-rate').value = 0;
    tmpl.querySelector('.s-amount').textContent = '0';
    tmpl.querySelectorAll('[name]').forEach(el => {
        el.name = el.name.replace(/sale\[\d+\]/, 'sale[' + sCount + ']');
    });
    tbody.appendChild(tmpl);
    rowIndex(tbody);
    sCount++;
});

// ─── Add Receipt Row ─────────────────────────────────────────────
document.getElementById('addReceiptRow').addEventListener('click', function() {
    const tbody = document.getElementById('receiptBody');
    const tmpl  = tbody.querySelector('tr').cloneNode(true);
    tmpl.querySelectorAll('input[type=text]').forEach(i => i.value = '');
    tmpl.querySelector('.r-amount').value = 0;
    tmpl.querySelectorAll('[name]').forEach(el => {
        el.name = el.name.replace(/receipt\[\d+\]/, 'receipt[' + rCount + ']');
    });
    tbody.appendChild(tmpl);
    rowIndex(tbody);
    rCount++;
});

// ─── Add Payment Row ─────────────────────────────────────────────
document.getElementById('addPaymentRow').addEventListener('click', function() {
    const tbody = document.getElementById('paymentBody');
    const tmpl  = tbody.querySelector('tr').cloneNode(true);
    tmpl.querySelectorAll('input[type=text]').forEach(i => i.value = '');
    tmpl.querySelector('.py-amount').value = 0;
    tmpl.querySelectorAll('[name]').forEach(el => {
        el.name = el.name.replace(/payment\[\d+\]/, 'payment[' + pyCount + ']');
    });
    tbody.appendChild(tmpl);
    rowIndex(tbody);
    pyCount++;
});

// ─── Remove rows ─────────────────────────────────────────────────
document.addEventListener('click', function(e) {
    const btn = e.target.closest('.remove-btn');
    if (!btn) return;

    if (btn.classList.contains('remove-purchase')) {
        const tbody = document.getElementById('purchaseBody');
        if (tbody.querySelectorAll('tr').length > 1) { btn.closest('tr').remove(); rowIndex(tbody); calcPurchaseTotal(); }
    }
    if (btn.classList.contains('remove-sale')) {
        const tbody = document.getElementById('salesBody');
        if (tbody.querySelectorAll('tr').length > 1) { btn.closest('tr').remove(); rowIndex(tbody); calcSaleTotal(); }
    }
    if (btn.classList.contains('remove-receipt')) {
        const tbody = document.getElementById('receiptBody');
        if (tbody.querySelectorAll('tr').length > 1) { btn.closest('tr').remove(); rowIndex(tbody); calcReceiptTotal(); }
    }
    if (btn.classList.contains('remove-payment')) {
        const tbody = document.getElementById('paymentBody');
        if (tbody.querySelectorAll('tr').length > 1) { btn.closest('tr').remove(); rowIndex(tbody); calcPaymentTotal(); }
    }
});
</script>

@endsection
