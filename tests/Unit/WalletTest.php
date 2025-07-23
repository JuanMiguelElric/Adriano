<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WalletTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_deposit_money()
    {
        $user = User::factory()->create();
        $wallet = Wallet::factory()->create([
            'user_id' => $user->id,
            'balance' => 100
        ]);

        $response = $this->actingAs($user)->post(route('wallet.deposit'), [
            'amount' => 50,
            'description' => 'Depósito de teste'
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('wallets', [
            'id' => $wallet->id,
            'balance' => 150
        ]);
        $this->assertDatabaseHas('transactions', [
            'wallet_id' => $wallet->id,
            'type' => 'deposit',
            'amount' => 50
        ]);
    }
}
