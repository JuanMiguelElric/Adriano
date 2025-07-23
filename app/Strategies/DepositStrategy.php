<?php

namespace App\Strategies;

use App\Interfaces\Repositories\WalletRepositoryInterface;
use App\Interfaces\Repositories\TransactionRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DepositStrategy implements TransactionStrategyInterface
{
    public function __construct(
        private WalletRepositoryInterface $walletRepository,
        private TransactionRepositoryInterface $transactionRepository
    ) {}

    public function execute(object $dados): void
    {
        DB::transaction(function () use ($dados) {
            $wallet = $this->walletRepository->createForUser(Auth::id());
            $wallet->increment('balance', $dados->amount);

            $this->transactionRepository->create([
                'wallet_id' => $wallet->id,
                'type' => 'deposit',
                'amount' => $dados->amount,
                'description' => $dados->description,
                'status' => 'completed',
            ]);
        });
    }
}
