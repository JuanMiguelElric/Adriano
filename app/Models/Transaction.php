<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['wallet_id', 'type', 'amount', 'transfer_to', 'status'];

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

