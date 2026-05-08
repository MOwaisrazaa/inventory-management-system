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
        return view('cashbook.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'transaction_date' => 'required|date',
            'type' => 'required|in:receipt,payment',
            'from_to' => 'required|string',
            'description' => 'required|string',
            'amount' => 'required|numeric|min:0',
        ]);

        CashBook::create($validated);

        return redirect()->route('cashbook.index')->with('success', 'Transaction added successfully!');
    }

    public function edit(CashBook $cashBook)
    {
        return view('cashbook.edit', compact('cashBook'));
    }

    public function update(Request $request, CashBook $cashBook)
    {
        $validated = $request->validate([
            'transaction_date' => 'required|date',
            'type' => 'required|in:receipt,payment',
            'from_to' => 'required|string',
            'description' => 'required|string',
            'amount' => 'required|numeric|min:0',
        ]);

        $cashBook->update($validated);

        return redirect()->route('cashbook.index')->with('success', 'Transaction updated successfully!');
    }

    public function destroy(CashBook $cashBook)
    {
        $cashBook->delete();
        return redirect()->route('cashbook.index')->with('success', 'Transaction deleted successfully!');
    }
}
