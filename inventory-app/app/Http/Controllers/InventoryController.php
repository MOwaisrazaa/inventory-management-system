<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Purchase;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::query();

        // Search filter
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        // Low stock filter
        if ($request->has('low_stock') && $request->low_stock == '1') {
            $query->where('quantity', '<', 10);
        }

        $items = $query->orderBy('name')->paginate(20);

        // Get recent transactions
        $recentPurchases = Purchase::with(['item', 'vendor'])
            ->orderBy('purchase_date', 'desc')
            ->limit(5)
            ->get();

        $recentSales = Sale::with(['item', 'customer'])
            ->orderBy('sale_date', 'desc')
            ->limit(5)
            ->get();

        // Calculate statistics
        $stats = [
            'total_items' => Item::count(),
            'low_stock_items' => Item::where('quantity', '<', 10)->count(),
            'total_inventory_value' => Item::sum(DB::raw('quantity * purchase_price')),
            'total_sales_value' => Sale::sum('amount'),
        ];

        return view('inventory.index', compact('items', 'recentPurchases', 'recentSales', 'stats'));
    }
}
