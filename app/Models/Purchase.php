<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = ['purchase_date', 'vendor_id', 'item_id', 'quantity', 'rate', 'amount', 'status', 'notes'];

    protected $casts = [
        'purchase_date' => 'date',
        'rate' => 'decimal:2',
        'amount' => 'decimal:2',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
