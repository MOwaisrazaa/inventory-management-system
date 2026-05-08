<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Vendor;
use App\Models\Item;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with(['vendor', 'item'])->latest()->paginate(10);
        return view('purchases.index', compact('purchases'));
    }

    public function create()
    {
        $vendors = Vendor::all();
        $items = Item::all();
        return view('purchases.create', compact('vendors', 'items'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'purchase_date' => 'required|date',
            'vendor_id' => 'required|exists:vendors,id',
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
            'rate' => 'required|numeric|min:0',
        ]);

        $validated['amount'] = $validated['quantity'] * $validated['rate'];
        
        Purchase::create($validated);

        // Update inventory
        $item = Item::find($validated['item_id']);
        $item->quantity += $validated['quantity'];
        $item->save();

        return redirect()->route('purchases.index')->with('success', 'Purchase added successfully!');
    }

    public function edit(Purchase $purchase)
    {
        $vendors = Vendor::all();
        return view('purchases.edit', compact('purchase', 'vendors'));
    }

    public function update(Request $request, Purchase $purchase)
    {
        $validated = $request->validate([
            'purchase_date' => 'required|date',
            'vendor_id' => 'required|exists:vendors,id',
            'quantity' => 'required|integer|min:1',
            'rate' => 'required|numeric|min:0',
        ]);

        // Calculate the difference in quantity to update inventory
        $quantityDiff = $validated['quantity'] - $purchase->quantity;
        
        // Update the item quantity
        $item = Item::find($purchase->item_id);
        $item->quantity += $quantityDiff;
        $item->save();

        // Update purchase
        $validated['amount'] = $validated['quantity'] * $validated['rate'];
        $purchase->update($validated);

        return redirect()->route('purchases.index')->with('success', 'Purchase updated successfully!');
    }

    public function destroy(Purchase $purchase)
    {
        $purchase->delete();
        return redirect()->route('purchases.index')->with('success', 'Purchase deleted successfully!');
    }
}
