<?php

namespace App\Interfaces\Repositories;

use App\Models\Wallet;

interface WalletRepositoryInterface
{
    public function findByUserId(int $userId): ?Wallet;
    public function createForUser(int $userId): Wallet;
    public function updateBalance(Wallet $wallet, float $amount): bool;
}
