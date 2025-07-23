<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;


        protected $fillable = [
        'wallet_id',
        'type',        // deposit, withdraw, transfer
        'amount',
        'description',
        'recipient_id' // usado para transferências
    ];

    // Relacionamento: Uma transação pertence a uma carteira
    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    // Relacionamento: Uma transação pode ter um destinatário (para transferências)
    public function transferToWallet()
    {
        return $this->belongsTo(Wallet::class, 'transfer_to');
    }
}

