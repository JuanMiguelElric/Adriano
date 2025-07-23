<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // Caso você use API futuramente

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Relacionamento: Um usuário tem UMA carteira.
     */
    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    /**
     * Relacionamento: Um usuário pode ter MUITAS transações (via carteira).
     */
    public function transactions()
    {
        return $this->hasManyThrough(Transaction::class, Wallet::class);
    }

    /**
     * Middleware de múltiplos papéis (cliente/admin).
     */
    protected function role(): Attribute
    {
        return new Attribute(
            get: fn($value) => ["cliente", "admin"][$value] ?? null,
        );
    }

    /**
     * Verificar se é Admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === "admin";
    }

    /**
     * Verificar se é Cliente.
     */
    public function isCliente(): bool
    {
        return $this->role === "cliente";
    }
}
