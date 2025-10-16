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
    Route::resource('produtos', ProdutoController::class);
    Route::post('produtos/limpar-lixeira', [ProdutoController::class, 'cleanTrash'])->name('produtos.clean-trash');
    Route::get('produtos/lixeira', [ProdutoController::class, 'trash'])->name('produtos.trash');
    Route::post('produtos/{id}/restaurar', [ProdutoController::class, 'restore'])->name('produtos.restore');
    Route::delete('produtos/{produto}/force', [ProdutoController::class, 'forceDestroy'])->name('produtos.force-destroy');
    Route::post('produtos/lixeira/limpar', [ProdutoController::class, 'cleanTrash'])->name('produtos.clean-trash');

    // Rotas de Fornecedores
    Route::resource('fornecedores', FornecedorController::class);

    // Rotas de Categorias
    Route::resource('categorias', CategoriaController::class);

    // Rotas de Movimentações de Estoque
    Route::resource('movimentacoes', MovimentacaoController::class);
});

require __DIR__.'/auth.php';
