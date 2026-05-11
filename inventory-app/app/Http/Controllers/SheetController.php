<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SheetController extends Controller
{
    // Single page: create form + date-wise records + prev/next navigation
    public function index(Request $request)
    {
        $date = $request->get('date', date('Y-m-d'));

        $items     = Item::all();
        $customers = Customer::all();
        $vendors   = Vendor::all();

        // Saved purchases for this date
        $purchases = DB::table('sheet_purchases')
            ->leftJoin('items', 'sheet_purchases.item_id', '=', 'items.id')
            ->where('sheet_purchases.date', $date)
            ->select('sheet_purchases.*', 'items.name as item_name')
            ->orderBy('sheet_purchases.id')
            ->get();

        // Saved sales for this date
        $sales = DB::table('sheet_sales')
            ->leftJoin('items', 'sheet_sales.item_id', '=', 'items.id')
            ->where('sheet_sales.date', $date)
            ->select('sheet_sales.*', 'items.name as item_name')
            ->orderBy('sheet_sales.id')
            ->get();

        // Saved receipts for this date
        $receipts = DB::table('sheet_receipts')
            ->where('date', $date)->orderBy('id')->get();

        // Saved payments for this date
        $payments = DB::table('sheet_payments')
            ->where('date', $date)->orderBy('id')->get();

        // Previous date that has any data
        $prevDate = DB::table('sheet_purchases')->select('date')
            ->union(DB::table('sheet_sales')->select('date'))
            ->union(DB::table('sheet_receipts')->select('date'))
            ->union(DB::table('sheet_payments')->select('date'))
            ->where('date', '<', $date)
            ->orderBy('date', 'desc')
            ->value('date');

        // Next date that has any data
        $nextDate = DB::table('sheet_purchases')->select('date')
            ->union(DB::table('sheet_sales')->select('date'))
            ->union(DB::table('sheet_receipts')->select('date'))
            ->union(DB::table('sheet_payments')->select('date'))
            ->where('date', '>', $date)
            ->orderBy('date', 'asc')
            ->value('date');

        return view('sheets.index', compact(
            'date', 'items',
            'purchases', 'sales', 'receipts', 'payments',
            'prevDate', 'nextDate'
        ));
    }

    // Save new entries
    public function store(Request $request)
    {
        $date = $request->input('date', date('Y-m-d'));

        // Purchase rows
        if ($request->has('purchase')) {
            foreach ($request->input('purchase') as $row) {
                $vendorName = trim($row['vendor_name'] ?? '');
                $itemId     = !empty($row['item_id']) ? $row['item_id'] : null;
                $qty        = (int)   ($row['quantity'] ?? 0);
                $rate       = (float) ($row['rate']     ?? 0);
                if (empty($vendorName) && !$itemId && $qty == 0 && $rate == 0) continue;
                DB::table('sheet_purchases')->insert([
                    'date' => $date, 'vendor_name' => $vendorName, 'item_id' => $itemId,
                    'quantity' => $qty, 'rate' => $rate, 'amount' => $qty * $rate,
                    'created_at' => now(), 'updated_at' => now(),
                ]);
            }
        }

        // Sale rows
        if ($request->has('sale')) {
            foreach ($request->input('sale') as $row) {
                $customerName = trim($row['customer_name'] ?? '');
                $itemId       = !empty($row['item_id']) ? $row['item_id'] : null;
                $qty          = (int)   ($row['quantity'] ?? 0);
                $rate         = (float) ($row['rate']     ?? 0);
                if (empty($customerName) && !$itemId && $qty == 0 && $rate == 0) continue;
                DB::table('sheet_sales')->insert([
                    'date' => $date, 'customer_name' => $customerName, 'item_id' => $itemId,
                    'quantity' => $qty, 'rate' => $rate, 'amount' => $qty * $rate,
                    'created_at' => now(), 'updated_at' => now(),
                ]);
            }
        }

        // Receipt rows
        if ($request->has('receipt')) {
            foreach ($request->input('receipt') as $row) {
                $from   = trim($row['from']   ?? '');
                $amount = (float) ($row['amount'] ?? 0);
                $status = $row['status'] ?? 'received';
                if (empty($from) && $amount == 0) continue;
                DB::table('sheet_receipts')->insert([
                    'date' => $date, 'from_party' => $from, 'status' => $status,
                    'amount' => $amount, 'created_at' => now(), 'updated_at' => now(),
                ]);
            }
        }

        // Payment rows
        if ($request->has('payment')) {
            foreach ($request->input('payment') as $row) {
                $to     = trim($row['to']     ?? '');
                $amount = (float) ($row['amount'] ?? 0);
                $status = $row['status'] ?? 'paid';
                if (empty($to) && $amount == 0) continue;
                DB::table('sheet_payments')->insert([
                    'date' => $date, 'to_party' => $to, 'status' => $status,
                    'amount' => $amount, 'created_at' => now(), 'updated_at' => now(),
                ]);
            }
        }

        return redirect()->route('sheets.index', ['date' => $date])
                         ->with('success', 'Entries saved successfully!');
    }

    // Keep old routes working
    public function create()
    {
        return redirect()->route('sheets.index');
    }

    public function list(Request $request)
    {
        return redirect()->route('sheets.index', ['date' => $request->get('date', date('Y-m-d'))]);
    }
}
