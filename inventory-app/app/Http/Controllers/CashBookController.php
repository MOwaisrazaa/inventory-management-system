<?php

namespace App\Http\Controllers;

use App\Models\CashBook;
use Illuminate\Http\Request;

class CashBookController extends Controller
{
    public function index()
    {
        $receipts = CashBook::where('type', 'receipt')->latest()->paginate(10);
        $payments = CashBook::where('type', 'payment')->latest()->paginate(10);
        
        $totalReceipts = CashBook::where('type', 'receipt')->sum('amount');
        $totalPayments = CashBook::where('type', 'payment')->sum('amount');
        $balance = $totalReceipts - $totalPayments;

        return view('cashbook.index', compact('receipts', 'payments', 'totalReceipts', 'totalPayments', 'balance'));
    }

    public function create()
    {
        $customers = \App\Models\Customer::all();
        $vendors = \App\Models\Vendor::all();
        $items = \App\Models\Item::all();
        return view('cashbook.create', compact('customers', 'vendors', 'items'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'transaction_date' => 'required|date',
            'type' => 'required|in:receipt,payment',
            'payee_type' => 'required|in:customer,vendor',
            'customer_id' => 'required_if:payee_type,customer|nullable|exists:customers,id',
            'vendor_id' => 'required_if:payee_type,vendor|nullable|exists:vendors,id',
            'item_id' => 'nullable|exists:items,id',
            'description' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        // Set from_to based on payee_type
        if ($validated['payee_type'] === 'customer') {
            $customer = \App\Models\Customer::find($validated['customer_id']);
            $validated['from_to'] = $customer->name;
            $validated['vendor_id'] = null;
        } else {
            $vendor = \App\Models\Vendor::find($validated['vendor_id']);
            $validated['from_to'] = $vendor->name;
            $validated['customer_id'] = null;
        }

        CashBook::create($validated);

        return redirect()->route('cashbook.index')->with('success', 'Transaction added successfully!');
    }

    public function edit(CashBook $cashBook)
    {
        $customers = \App\Models\Customer::all();
        $vendors = \App\Models\Vendor::all();
        $items = \App\Models\Item::all();
        return view('cashbook.edit', compact('cashBook', 'customers', 'vendors', 'items'));
    }

    public function update(Request $request, CashBook $cashBook)
    {
        $validated = $request->validate([
            'transaction_date' => 'required|date',
            'type' => 'required|in:receipt,payment',
            'payee_type' => 'required|in:customer,vendor',
            'customer_id' => 'required_if:payee_type,customer|nullable|exists:customers,id',
            'vendor_id' => 'required_if:payee_type,vendor|nullable|exists:vendors,id',
            'item_id' => 'nullable|exists:items,id',
            'description' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        // Set from_to based on payee_type
        if ($validated['payee_type'] === 'customer') {
            $customer = \App\Models\Customer::find($validated['customer_id']);
            $validated['from_to'] = $customer->name;
            $validated['vendor_id'] = null;
        } else {
            $vendor = \App\Models\Vendor::find($validated['vendor_id']);
            $validated['from_to'] = $vendor->name;
            $validated['customer_id'] = null;
        }

        $cashBook->update($validated);

        return redirect()->route('cashbook.index')->with('success', 'Transaction updated successfully!');
    }

    public function destroy(CashBook $cashBook)
    {
        $cashBook->delete();
        return redirect()->route('cashbook.index')->with('success', 'Transaction deleted successfully!');
    }
}
