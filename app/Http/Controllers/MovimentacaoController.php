<?php

namespace App\Http\Controllers;

use App\Models\Movimentacao;
use App\Models\Produto;
use Illuminate\Http\Request;

class MovimentacaoController extends Controller
{
    public function index()
    {
        $movimentacoes = Movimentacao::with('produto')->orderByDesc('created_at')->get();
        return view('movimentacoes.index', compact('movimentacoes'));
    }

    public function create()
    {
        $produtos = Produto::all();
        return view('movimentacoes.create', compact('produtos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produto_id' => 'required|exists:produtos,id',
            'tipo' => 'required|in:entrada,saida',
            'quantidade' => 'required|integer|min:1',
        ]);

        $produto = Produto::find($request->produto_id);

        if ($request->tipo === 'saida' && $produto->quantidade < $request->quantidade) {
            return redirect()->back()->with('error', 'Estoque insuficiente para saída.');
        }

        // Criar a movimentação
        Movimentacao::create($request->all());

        // Atualizar a quantidade do produto
        if ($request->tipo === 'entrada') {
            $produto->increment('quantidade', $request->quantidade);
        } else {
            $produto->decrement('quantidade', $request->quantidade);
        }

        return redirect()->route('movimentacoes.index')->with('success', 'Movimentação registrada com sucesso!');
    }
}
