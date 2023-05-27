<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'transaction_type',
        'amount',
        'recipient_email',
        'balance'
    ];
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}