<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'balance'];

    // Relacionamento: Uma carteira pertence a um usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relacionamento: Uma carteira tem muitas transações
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
