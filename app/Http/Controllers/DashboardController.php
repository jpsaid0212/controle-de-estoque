<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Fornecedor;
use App\Models\Categoria;
use App\Models\Movimentacao;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProdutos = Produto::count();
        $totalFornecedores = Fornecedor::count();
        $totalCategorias = Categoria::count();
        $totalMovimentacoes = Movimentacao::count();

        return view('dashboard.index', compact(
            'totalProdutos',
            'totalFornecedores',
            'totalCategorias',
            'totalMovimentacoes'
        ));
    }

    public function getChartData()
    {
        // 📊 1️⃣ Produtos mais vendidos (baseado em saídas)
        $produtosMaisVendidos = Movimentacao::where('tipo', 'saida')
            ->select('produto_id', DB::raw('SUM(quantidade) as total_vendido'))
            ->groupBy('produto_id')
            ->orderByDesc('total_vendido')
            ->take(5)
            ->with('produto') // Carregar os nomes dos produtos
            ->get();

        // 📈 2️⃣ Movimentações dos últimos 6 meses (entradas e saídas)
        $movimentacoesMeses = Movimentacao::select(
            DB::raw('MONTH(created_at) as mes'),
            DB::raw('YEAR(created_at) as ano'),
            DB::raw("SUM(CASE WHEN tipo = 'entrada' THEN quantidade ELSE 0 END) as total_entradas"),
            DB::raw("SUM(CASE WHEN tipo = 'saida' THEN quantidade ELSE 0 END) as total_saidas")
        )
        ->where('created_at', '>=', Carbon::now()->subMonths(6))
        ->groupBy('ano', 'mes')
        ->orderBy('ano')
        ->orderBy('mes')
        ->get();

        return response()->json([
            'produtosMaisVendidos' => $produtosMaisVendidos,
            'movimentacoesMeses' => $movimentacoesMeses
        ]);
    }
}
