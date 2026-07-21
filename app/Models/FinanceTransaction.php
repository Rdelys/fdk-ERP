<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinanceTransaction extends Model
{
    protected $fillable = ['type', 'montant', 'description', 'date_transaction'];

    protected $casts = [
        'date_transaction' => 'date',
        'montant' => 'decimal:2',
    ];
}