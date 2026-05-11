<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Customer;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SheetController extends Controller
{
    // Page 1: Create Sheet Form
    public function create()
    {
        $items     = Item::all();
        $customers = Customer::all();
        $vendors   = Vendor::all();
        return view('sheets.create', compact('items', 'customers', 'vendors'));
    }

    // Save Sheet Data
    public function store(Request $request)
    {
        $date = $request->input('date', date('Y-m-d'));

        // ── Save Purchase rows ──────────────────────────────────────
        if ($request->has('purchase')) {
            foreach ($request->input('purchase') as $row) {
                $vendorId = !empty($row['vendor_id']) ? $row['vendor_id'] : null;
                $itemId   = !empty($row['item_id'])   ? $row['item_id']   : null;
                $qty      = (int)   ($row['quantity'] ?? 0);
                $rate     = (float) ($row['rate']     ?? 0);

                // Skip completely empty rows
                if (!$vendorId && !$itemId && $qty == 0 && $rate == 0) continue;

                DB::table('sheet_purchases')->insert([
                    'date'       => $date,
                    'vendor_id'  => $vendorId,
                    'item_id'    => $itemId,
                    'quantity'   => $qty,
                    'rate'       => $rate,
                    'amount'     => $qty * $rate,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // ── Save Sale rows ──────────────────────────────────────────
        if ($request->has('sale')) {
            foreach ($request->input('sale') as $row) {
                $customerId = !empty($row['customer_id']) ? $row['customer_id'] : null;
                $itemId     = !empty($row['item_id'])     ? $row['item_id']     : null;
                $qty        = (int)   ($row['quantity'] ?? 0);
                $rate       = (float) ($row['rate']     ?? 0);

                if (!$customerId && !$itemId && $qty == 0 && $rate == 0) continue;

                DB::table('sheet_sales')->insert([
                    'date'        => $date,
                    'customer_id' => $customerId,
                    'item_id'     => $itemId,
                    'quantity'    => $qty,
                    'rate'        => $rate,
                    'amount'      => $qty * $rate,
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ]);
            }
        }

        // ── Save Receipt rows ───────────────────────────────────────
        if ($request->has('receipt')) {
            foreach ($request->input('receipt') as $row) {
                $from   = trim($row['from']   ?? '');
                $amount = (float) ($row['amount'] ?? 0);
                $status = $row['status'] ?? 'received';

                if (empty($from) && $amount == 0) continue;

                DB::table('sheet_receipts')->insert([
                    'date'        => $date,
                    'from_party'  => $from,
                    'status'      => $status,
                    'amount'      => $amount,
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ]);
            }
        }

        // ── Save Payment rows ───────────────────────────────────────
        if ($request->has('payment')) {
            foreach ($request->input('payment') as $row) {
                $to     = trim($row['to']     ?? '');
                $amount = (float) ($row['amount'] ?? 0);
                $status = $row['status'] ?? 'paid';

                if (empty($to) && $amount == 0) continue;

                DB::table('sheet_payments')->insert([
                    'date'       => $date,
                    'to_party'   => $to,
                    'status'     => $status,
                    'amount'     => $amount,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return redirect()->route('sheets.list', ['date' => $date])
                         ->with('success', 'Sheet saved successfully!');
    }

    // Page 2: Date-wise List
    public function list(Request $request)
    {
        $date = $request->get('date', date('Y-m-d'));

        // Purchases with vendor & item names
        $purchases = DB::table('sheet_purchases')
            ->leftJoin('vendors', 'sheet_purchases.vendor_id', '=', 'vendors.id')
            ->leftJoin('items',   'sheet_purchases.item_id',   '=', 'items.id')
            ->where('sheet_purchases.date', $date)
            ->select(
                'sheet_purchases.*',
                'vendors.name as vendor_name',
                'items.name   as item_name'
            )
            ->orderBy('sheet_purchases.id')
            ->get();

        // Sales with customer & item names
        $sales = DB::table('sheet_sales')
            ->leftJoin('customers', 'sheet_sales.customer_id', '=', 'customers.id')
            ->leftJoin('items',     'sheet_sales.item_id',     '=', 'items.id')
            ->where('sheet_sales.date', $date)
            ->select(
                'sheet_sales.*',
                'customers.name as customer_name',
                'items.name     as item_name'
            )
            ->orderBy('sheet_sales.id')
            ->get();

        // Receipts
        $receipts = DB::table('sheet_receipts')
            ->where('date', $date)
            ->orderBy('id')
            ->get();

        // Payments
        $payments = DB::table('sheet_payments')
            ->where('date', $date)
            ->orderBy('id')
            ->get();

        // All unique dates for quick filter
        $dates = DB::table('sheet_purchases')->select('date')
            ->union(DB::table('sheet_sales')->select('date'))
            ->union(DB::table('sheet_receipts')->select('date'))
            ->union(DB::table('sheet_payments')->select('date'))
            ->orderBy('date', 'desc')
            ->pluck('date')
            ->unique()
            ->values();

        return view('sheets.list', compact('purchases', 'sales', 'receipts', 'payments', 'dates', 'date'));
    }
}
