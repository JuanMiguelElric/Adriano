<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            // Carteira que realizou a transação
            $table->foreignId('wallet_id')->constrained()->onDelete('cascade');

            // Tipo da transação
            $table->enum('type', ['deposit', 'withdraw', 'transfer'])->index();

            // Valor da transação
            $table->decimal('amount', 15, 2);

            // Destinatário (apenas para transferências)
            $table->foreignId('transfer_to')
                  ->nullable()
                  ->constrained('wallets')
                  ->onDelete('cascade');

            // Status da transação (caso tenha sido estornada)
            $table->enum('status', ['completed', 'reversed'])->default('completed');

            // Descrição da transação
            $table->string('description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
