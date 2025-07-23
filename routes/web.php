<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Wallet\WalletController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get("/validarautenticacao",[HomeController::class,'ValidandoAcesso'])->name('validar.role');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth','user-access:admin'])->group(function(){

    Route::get('/dashboard/admin',[HomeController::class,'DashboardAdmin'])->name('admin.dashboard');

});

Route::middleware(['auth','user-access:cliente'])->group(function(){

    Route::get('/dashboard/cliente',[HomeController::class,'DashboardCliente'])->name('cliente.dashboard');
    Route::post('/deposit', [WalletController::class, 'deposit'])->name('wallet.deposit');
    Route::post('/withdraw', [WalletController::class, 'withdraw'])->name('wallet.withdraw');
    Route::post('/transfer', [WalletController::class, 'transfer'])->name('wallet.transfer');

});
require __DIR__.'/auth.php';
