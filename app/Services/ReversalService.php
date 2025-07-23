<?php
namespace App\Services;

use App\Models\Transaction;
use App\Models\Reversal;
use Illuminate\Support\Facades\DB;

class ReversalService
{
    public function Reembolsar(object $dados)
    {
        return DB::transaction(function () use ($dados) {
            $transaction = Transaction::with('wallet')->findOrFail($dados->transaction_id);

            if ($transaction->status !== 'completed') {
                return back()->with('error', 'Esta transação já foi reembolsada ou não está concluída.');
            }

            $wallet = $transaction->wallet;

            // Para transferências, também devolver do destinatário
            if ($transaction->type === 'transfer' && $transaction->transfer_to) {
                $recipientWallet = $transaction->recipientWallet;
                if ($recipientWallet->balance < $transaction->amount) {
                    return back()->with('error', 'O destinatário não tem saldo suficiente para reembolso.');
                }

                $recipientWallet->decrement('balance', $transaction->amount);
            }

            // Devolve o saldo ao remetente
            $wallet->increment('balance', $transaction->amount);

            // Marca a transação como reembolsada
            $transaction->update(['status' => 'reversed']);

            // Cria registro do reembolso
            Reversal::create([
                'transaction_id' => $transaction->id,
                'reason' => $dados->reason ?? 'Reembolso solicitado pelo usuário',
            ]);

            return back()->with('success', 'Reembolso realizado com sucesso!');
        });
    }
}
