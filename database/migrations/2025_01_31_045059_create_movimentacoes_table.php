<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('movimentacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produto_id')->constrained('produtos')->cascadeOnDelete();
            $table->enum('tipo', ['entrada', 'saida']);
            $table->unsignedInteger('quantidade');
            $table->decimal('custo_unitario', 10, 2)->nullable();
            $table->text('observacao')->nullable();
            $table->timestamps();

            $table->index(['produto_id', 'tipo']);
            $table->index('created_at');
        });
    }

    public function down(): void {
        Schema::dropIfExists('movimentacoes');
    }
};
