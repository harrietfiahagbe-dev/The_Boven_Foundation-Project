<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'amount',
        'payment_method',
        'transaction_reference',
        'payment_date',
        'notes',
        'acknowledged'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'payment_date' => 'date',
        'acknowledged' => 'boolean',
    ];
}
