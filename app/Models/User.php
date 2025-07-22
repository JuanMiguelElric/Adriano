<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute ;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'password','role'];

    // Relacionamento: Um usuário tem uma carteira
    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    // criação de múltiplos middlewares
    protected function role(): Attribute
    {
        return new Attribute(
            get: fn($value) => ["cliente",'admin'][$value] ?? null,
        );
    }
}