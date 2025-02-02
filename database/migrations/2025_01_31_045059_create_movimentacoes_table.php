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
    Schema::create('movimentacoes', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('produto_id');
        $table->enum('tipo', ['entrada', 'saida']);
        $table->integer('quantidade');
        $table->timestamps();

        $table->foreign('produto_id')->references('id')->on('produtos')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimentacoes');
    }
};
