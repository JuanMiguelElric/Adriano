<?php

namespace App\Strategies;

use App\Interfaces\Repositories\WalletRepositoryInterface;
use App\Interfaces\Repositories\TransactionRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransferStrategy implements TransactionStrategyInterface
{
    public function __construct(
        private WalletRepositoryInterface $walletRepository,
        private TransactionRepositoryInterface $transactionRepository
    ) {}

    public function execute(object $dados): void
    {
        DB::transaction(function () use ($dados) {
            $senderWallet = $this->walletRepository->createForUser(Auth::id());

            if ($senderWallet->balance < $dados->amount) {
                throw new \Exception('Saldo insuficiente!');
            }

            $recipient = User::where('email', $dados->recipient)->firstOrFail();
            $recipientWallet = $this->walletRepository->createForUser($recipient->id);

            $senderWallet->decrement('balance', $dados->amount);
            $recipientWallet->increment('balance', $dados->amount);

            $this->transactionRepository->create([
                'wallet_id' => $senderWallet->id,
                'type' => 'transfer',
                'amount' => $dados->amount,
                'description' => $dados->description,
                'transfer_to' => $recipientWallet->id,
                'status' => 'completed',
            ]);
        });
    }
}
