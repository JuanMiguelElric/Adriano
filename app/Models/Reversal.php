<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reversal extends Model
{
    use HasFactory;

    protected $fillable = ['transaction_id', 'reason'];

    // Relacionamento: Uma reversão pertence a uma transação
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}

