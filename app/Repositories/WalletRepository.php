<?php

namespace App\Repositories;

use App\Interfaces\Repositories\WalletRepositoryInterface;
use App\Models\Wallet;

class WalletRepository implements WalletRepositoryInterface
{
    public function findByUserId(int $userId): ?Wallet
    {
        return Wallet::where('user_id', $userId)->first();
    }

    public function createForUser(int $userId): Wallet
    {
        return Wallet::firstOrCreate(['user_id' => $userId], ['balance' => 0]);
    }

    public function updateBalance(Wallet $wallet, float $amount): bool
    {
        $wallet->balance = $amount;
        return $wallet->save();
    }
}
