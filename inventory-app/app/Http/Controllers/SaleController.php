<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Customer;
use App\Models\Item;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with(['customer', 'item'])->latest()->paginate(10);
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $customers = Customer::all();
        $items = Item::all();
        return view('sales.create', compact('customers', 'items'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sale_date' => 'required|date',
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'nullable|string|max:20',
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
            'rate' => 'required|numeric|min:0',
        ]);

        // Find or create customer
        $customer = Customer::firstOrCreate(
            ['name' => $validated['customer_name']],
            ['phone' => $validated['customer_phone'] ?? '']
        );

        // Create sale
        $saleData = [
            'sale_date' => $validated['sale_date'],
            'customer_id' => $customer->id,
            'item_id' => $validated['item_id'],
            'quantity' => $validated['quantity'],
            'rate' => $validated['rate'],
            'amount' => $validated['quantity'] * $validated['rate'],
            'status' => 'completed'
        ];
        
        Sale::create($saleData);

        // Update inventory
        $item = Item::find($validated['item_id']);
        $item->quantity -= $validated['quantity'];
        $item->save();

        return redirect()->route('sales.index')->with('success', 'Sale added successfully! Customer saved.');
    }

    public function edit(Sale $sale)
    {
        $customers = Customer::all();
        $items = Item::all();
        return view('sales.edit', compact('sale', 'customers', 'items'));
    }

    public function update(Request $request, Sale $sale)
    {
        $validated = $request->validate([
            'sale_date' => 'required|date',
            'customer_id' => 'required|exists:customers,id',
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
            'rate' => 'required|numeric|min:0',
        ]);

        $validated['amount'] = $validated['quantity'] * $validated['rate'];
        $sale->update($validated);

        return redirect()->route('sales.index')->with('success', 'Sale updated successfully!');
    }

    public function destroy(Sale $sale)
    {
        $sale->delete();
        return redirect()->route('sales.index')->with('success', 'Sale deleted successfully!');
    }
}
