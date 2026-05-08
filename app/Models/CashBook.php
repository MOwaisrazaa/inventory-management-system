<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashBook extends Model
{
    protected $table = 'cash_book';
    
    protected $fillable = ['transaction_date', 'type', 'from_to', 'description', 'amount', 'status', 'notes'];

    protected $casts = [
        'transaction_date' => 'date',
        'amount' => 'decimal:2',
    ];
}
