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
        Schema::create('reversals', function (Blueprint $table) {
            $table->id();

            // Transação que foi revertida
            $table->foreignId('transaction_id')
                  ->constrained()
                  ->onDelete('cascade');

            // Motivo do estorno/reversão
            $table->text('reason')->nullable();

            // Status da reversão (caso queira expandir no futuro)
            $table->enum('status', ['pending', 'approved', 'rejected'])
                  ->default('approved');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reversals');
    }
};
