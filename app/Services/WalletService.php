<?php

namespace App\Services;

use App\Strategies\TransactionStrategyInterface;

class WalletService
{
    public function __construct(private TransactionStrategyInterface $strategy) {}

    public function handle(object $dados): void
    {
        $this->strategy->execute($dados);
    }
}
