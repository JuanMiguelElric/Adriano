<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Criar um gerente
        User::create([
            'name' => 'Gerente Exemplo',
            'email' => 'gerente@exemplo.com',
            'email_verified_at' => now(),
            'password' => Hash::make('senha123'), // Senha com hash
            'role' => 1, // Gerente
        ]);

        // Criar um cliente
        User::create([
            'name' => 'Cliente Exemplo',
            'email' => 'cliente@exemplo.com',
            'email_verified_at' => now(),
            'password' => Hash::make('senha123'), // Senha com hash
            'role' => 0, // Cliente
        ]);

        // Criar mais usuários conforme necessário
    }
}
