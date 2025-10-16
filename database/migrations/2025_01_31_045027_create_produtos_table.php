<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->text('descricao')->nullable();
            $table->foreignId('categoria_id')->constrained('categorias')->cascadeOnDelete();
            $table->foreignId('fornecedor_id')->nullable()->constrained('fornecedores')->nullOnDelete();
            $table->integer('quantidade')->default(0);
            $table->decimal('preco', 10, 2)->default(0);
            $table->integer('estoque_minimo')->nullable();
            $table->string('sku', 64)->nullable()->unique();
            $table->string('codigo_barras', 64)->nullable();
            $table->string('unidade', 16)->nullable(); // ex: UN, CX, KG
            $table->decimal('preco_custo', 10, 2)->nullable();
            $table->boolean('ativo')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['categoria_id', 'fornecedor_id']);
            $table->index('nome');
        });
    }

    public function down(): void {
        Schema::dropIfExists('produtos');
    }
};
