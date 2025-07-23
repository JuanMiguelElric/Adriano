<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function ValidandoAcesso(){
  
        if(auth()->user()->role == "cliente"){
            return redirect()->route('cliente.dashboard');

        }elseif(auth()->user()->role == "admin"){
            return redirect()->route('admin.dashboard');
        }
    }

    // dashboard Cliente

    public function DashboardCliente()
    {
        // Garante que o cliente sempre tenha uma carteira
        $wallet = Wallet::firstOrCreate(
            ['user_id' => Auth::id()],
            ['balance' => 0]
        );

        // Pega as transações relacionadas à carteira do usuário
        $transactions = $wallet->transactions()->latest()->take(10)->get();

        return view('cliente.cliente', compact('wallet', 'transactions'));
    }
    //dashboard adimin
    public function DashboardAdmin()
    {
        $transactions = Transaction::with('wallet.user')->latest()->get();

        return view('admin.dashboard', compact('transactions'));
    }
}
