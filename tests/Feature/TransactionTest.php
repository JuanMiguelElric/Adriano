<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransactionTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_transfer_money_to_another_user()
    {
        $sender = User::factory()->create();
        $recipient = User::factory()->create();

        $senderWallet = Wallet::factory()->create(['user_id' => $sender->id, 'balance' => 200]);
        $recipientWallet = Wallet::factory()->create(['user_id' => $recipient->id, 'balance' => 50]);

        $response = $this->actingAs($sender)->post(route('wallet.transfer'), [
            'recipient' => $recipient->email,
            'amount' => 50,
            'description' => 'Transferência de teste'
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('wallets', [
            'id' => $senderWallet->id,
            'balance' => 150
        ]);
        $this->assertDatabaseHas('wallets', [
            'id' => $recipientWallet->id,
            'balance' => 100
        ]);
        $this->assertDatabaseHas('transactions', [
            'wallet_id' => $senderWallet->id,
            'type' => 'transfer',
            'amount' => 50,
            'transfer_to' => $recipientWallet->id
        ]);
    }
}
