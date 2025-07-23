<?php

namespace App\Strategies;

use App\Interfaces\Repositories\WalletRepositoryInterface;
use App\Interfaces\Repositories\TransactionRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WithdrawStrategy implements TransactionStrategyInterface
{
    public function __construct(
        private WalletRepositoryInterface $walletRepository,
        private TransactionRepositoryInterface $transactionRepository
    ) {}

    public function execute(object $dados): void
    {
        DB::transaction(function () use ($dados) {
            $wallet = $this->walletRepository->createForUser(Auth::id());

            if ($wallet->balance < $dados->amount) {
                throw new \Exception('Saldo insuficiente!');
            }

            $wallet->decrement('balance', $dados->amount);

            $this->transactionRepository->create([
                'wallet_id' => $wallet->id,
                'type' => 'withdraw',
                'amount' => $dados->amount,
                'description' => $dados->description,
                'status' => 'completed',
            ]);
        });
    }
}
