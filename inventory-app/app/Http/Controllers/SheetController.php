<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Customer;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SheetController extends Controller
{
    // Single page: create form + date-wise records + prev/next navigation
    public function index(Request $request)
    {
        $date = $request->get('date', date('Y-m-d'));

        $items     = Item::all();
        $vendors   = Vendor::orderBy('name')->get();
        $customers = Customer::orderBy('name')->get();

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

        // Saved journal entries for this date
        $journals = DB::table('sheet_journals')
            ->where('date', $date)->orderBy('id')->get();

        // All dates that have any data - simple approach
        $p  = DB::table('sheet_purchases')->distinct()->pluck('date')->toArray();
        $s  = DB::table('sheet_sales')->distinct()->pluck('date')->toArray();
        $r  = DB::table('sheet_receipts')->distinct()->pluck('date')->toArray();
        $py = DB::table('sheet_payments')->distinct()->pluck('date')->toArray();
        $j  = DB::table('sheet_journals')->distinct()->pluck('date')->toArray();

        $allDates = collect(array_unique(array_merge($p, $s, $r, $py, $j)))->sort()->values();

        $prevDate = $allDates->filter(fn($d) => $d < $date)->last();
        $nextDate = $allDates->filter(fn($d) => $d > $date)->first();

        return view('sheets.index', compact(
            'date', 'items', 'vendors', 'customers',
            'purchases', 'sales', 'receipts', 'payments', 'journals',
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
                
                // Skip if completely empty OR if no meaningful data
                if (empty($vendorName) && !$itemId && $rate == 0) continue;
                
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
                
                // Skip if completely empty OR if no meaningful data
                if (empty($customerName) && !$itemId && $rate == 0) continue;
                
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
                // Skip if from is empty AND amount is 0
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
                // Skip if to is empty AND amount is 0
                if (empty($to) && $amount == 0) continue;
                DB::table('sheet_payments')->insert([
                    'date' => $date, 'to_party' => $to, 'status' => $status,
                    'amount' => $amount, 'created_at' => now(), 'updated_at' => now(),
                ]);
            }
        }

        // Journal rows (Hawala entries)
        if ($request->has('journal')) {
            foreach ($request->input('journal') as $row) {
                $debit  = trim($row['debit_party']  ?? '');
                $credit = trim($row['credit_party'] ?? '');
                $amount = (float) ($row['amount']      ?? 0);
                $desc   = trim($row['description']  ?? '');
                if (empty($debit) && empty($credit) && $amount == 0) continue;
                DB::table('sheet_journals')->insert([
                    'date'         => $date,
                    'debit_party'  => $debit,
                    'credit_party' => $credit,
                    'amount'       => $amount,
                    'description'  => $desc,
                    'created_at'   => now(),
                    'updated_at'   => now(),
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

    // Delete a saved row
    public function deleteRow(Request $request)
    {
        $table = $request->input('table'); // sheet_purchases, sheet_sales, sheet_receipts, sheet_payments
        $id    = $request->input('id');
        $date  = $request->input('date', date('Y-m-d'));

        // Validate table name for security
        $allowedTables = ['sheet_purchases', 'sheet_sales', 'sheet_receipts', 'sheet_payments'];
        if (in_array($table, $allowedTables)) {
            DB::table($table)->where('id', $id)->delete();
        }

        return redirect()->route('sheets.index', ['date' => $date])
                         ->with('success', 'Row deleted successfully!');
    }
}
