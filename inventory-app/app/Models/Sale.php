<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['sale_date', 'customer_id', 'item_id', 'quantity', 'rate', 'amount', 'status', 'notes'];

    protected $casts = [
        'sale_date' => 'date',
        'rate' => 'decimal:2',
        'amount' => 'decimal:2',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
