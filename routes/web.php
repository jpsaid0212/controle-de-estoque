<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MovimentacaoController;
use Illuminate\Support\Facades\Route;

// Página inicial (login)
Route::get('/', function () {
    return view('home');
});

Route::get('/register', [RegisteredUserController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest');

// Dashboard protegido por autenticação
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/chart-data', [DashboardController::class, 'getChartData'])->name('dashboard.chart-data');

    // Gerenciamento de perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rotas de Produtos
    Route::resource('produtos', ProdutoController::class);

    // Rotas de Fornecedores
    Route::resource('fornecedores', FornecedorController::class);

    // Rotas de Categorias
    Route::resource('categorias', CategoriaController::class);

    // Rotas de Movimentações de Estoque
    Route::resource('movimentacoes', MovimentacaoController::class);
});

require __DIR__.'/auth.php';
