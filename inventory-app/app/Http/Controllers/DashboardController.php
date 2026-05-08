<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Sale;
use App\Models\Item;
use App\Models\CashBook;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPurchases = Purchase::sum('amount');
        $totalSales = Sale::sum('amount');
        $totalItems = Item::count();
        $totalInventory = Item::sum('quantity');
        
        $totalReceipts = CashBook::where('type', 'receipt')->sum('amount');
        $totalPayments = CashBook::where('type', 'payment')->sum('amount');
        $cashBalance = $totalReceipts - $totalPayments;

        $recentPurchases = Purchase::with(['vendor', 'item'])->latest()->take(5)->get();
        $recentSales = Sale::with(['customer', 'item'])->latest()->take(5)->get();

        return view('dashboard', compact(
            'totalPurchases',
            'totalSales',
            'totalItems',
            'totalInventory',
            'totalReceipts',
            'totalPayments',
            'cashBalance',
            'recentPurchases',
            'recentSales'
        ));
    }
}
