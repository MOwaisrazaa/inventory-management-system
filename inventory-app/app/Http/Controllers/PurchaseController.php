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
        return view('purchases.create', compact('vendors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'purchase_date' => 'required|date',
            'vendor_id' => 'required|exists:vendors,id',
            'item_name' => 'required|string|max:255',
            'item_sku' => 'nullable|string|max:100',
            'purchase_price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'rate' => 'required|numeric|min:0',
        ]);

        // Normalize empty SKU to null
        $sku = !empty($validated['item_sku']) ? $validated['item_sku'] : null;

        // Check if item already exists by name and SKU
        $item = Item::where('name', $validated['item_name'])
            ->where(function($query) use ($sku) {
                if ($sku === null) {
                    $query->whereNull('sku');
                } else {
                    $query->where('sku', $sku);
                }
            })
            ->first();

        if (!$item) {
            // Create new item
            $item = Item::create([
                'name' => $validated['item_name'],
                'sku' => $sku,
                'purchase_price' => $validated['purchase_price'],
                'sale_price' => $validated['sale_price'],
                'quantity' => $validated['quantity'],
            ]);
        } else {
            // Update existing item quantity
            $item->quantity += $validated['quantity'];
            $item->save();
        }

        // Create purchase record
        $purchaseData = [
            'purchase_date' => $validated['purchase_date'],
            'vendor_id' => $validated['vendor_id'],
            'item_id' => $item->id,
            'quantity' => $validated['quantity'],
            'rate' => $validated['rate'],
            'amount' => $validated['quantity'] * $validated['rate'],
        ];
        
        Purchase::create($purchaseData);

        return redirect()->route('purchases.index')->with('success', 'Purchase added successfully and item saved!');
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
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
            'rate' => 'required|numeric|min:0',
        ]);

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
