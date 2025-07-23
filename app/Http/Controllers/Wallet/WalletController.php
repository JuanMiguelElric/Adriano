<?php

namespace App\Http\Controllers\Wallet;

use App\Http\Controllers\Controller;
use App\Services\ReversalService;
use App\Services\WalletService;
use App\Strategies\DepositStrategy;
use App\Strategies\WithdrawStrategy;
use App\Strategies\TransferStrategy;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function deposit(Request $request, DepositStrategy $strategy)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'description' => 'required|string|max:255',
        ]);

        (new WalletService($strategy))->handle((object) $request->all());

        return back()->with('success', 'Depósito realizado com sucesso!');
    }

    public function withdraw(Request $request, WithdrawStrategy $strategy)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'description' => 'required|string|max:255',
        ]);

        try {
            (new WalletService($strategy))->handle((object) $request->all());
            return back()->with('success', 'Saque realizado com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function transfer(Request $request, TransferStrategy $strategy)
    {
        $request->validate([
            'recipient'    => 'required|email|exists:users,email',
            'amount'       => 'required|numeric|min:1',
            'description'  => 'required|string|max:255',
        ]);

        try {
            (new WalletService($strategy))->handle((object) $request->all());
            return back()->with('success', 'Transferência realizada com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function refund(Request $request, ReversalService $reversalService)
    {
        $request->validate([
            'transaction_id' => 'required|exists:transactions,id',
            'reason' => 'nullable|string|max:255'
        ]);

        return $reversalService->Reembolsar((object) $request->all());
    }

}
