<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('produtos', function (Blueprint $table) {
        $table->id();
        $table->string('nome');
        $table->text('descricao')->nullable();
        $table->unsignedBigInteger('categoria_id');
        $table->unsignedBigInteger('fornecedor_id')->nullable();
        $table->integer('quantidade')->default(0);
        $table->decimal('preco', 10, 2);
        $table->timestamps();

        $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');
        $table->foreign('fornecedor_id')->references('id')->on('fornecedores')->onDelete('set null');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
