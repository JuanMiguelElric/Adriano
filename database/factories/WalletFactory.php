<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Wallet>
 */
class WalletFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Cria automaticamente um usuário associado
            'balance' => $this->faker->randomFloat(2, 100, 1000), // saldo aleatório entre 100 e 1000
        ];
    }
}
