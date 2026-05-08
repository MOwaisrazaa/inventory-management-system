<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashBook extends Model
{
    protected $table = 'cash_book';
    
    protected $fillable = ['transaction_date', 'type', 'payee_type', 'customer_id', 'vendor_id', 'item_id', 'from_to', 'description', 'amount', 'status', 'notes'];

    protected $casts = [
        'transaction_date' => 'date',
        'amount' => 'decimal:2',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
