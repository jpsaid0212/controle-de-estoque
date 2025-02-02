<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria;
use App\Models\Fornecedor;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::with(['categoria', 'fornecedor'])->get();
        return view('produtos.index', compact('produtos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        $fornecedores = Fornecedor::all();
        return view('produtos.create', compact('categorias', 'fornecedores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'categoria_id' => 'required|exists:categorias,id',
            'fornecedor_id' => 'nullable|exists:fornecedores,id',
            'quantidade' => 'required|integer|min:0',
            'preco' => 'required|numeric|min:0',
        ]);

        Produto::create($request->all());

        return redirect()->route('produtos.index')->with('success', 'Produto cadastrado com sucesso!');
    }

    public function edit(Produto $produto)
    {
        $categorias = Categoria::all();
        $fornecedores = Fornecedor::all();
        return view('produtos.edit', compact('produto', 'categorias', 'fornecedores'));
    }

    public function update(Request $request, Produto $produto)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'categoria_id' => 'required|exists:categorias,id',
            'fornecedor_id' => 'nullable|exists:fornecedores,id',
            'quantidade' => 'required|integer|min:0',
            'preco' => 'required|numeric|min:0',
        ]);

        $produto->update($request->all());

        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso!');
    }

    public function search(Request $request)
{
    $query = $request->input('query');

    // Busca pelo nome do produto usando LIKE
    $produtos = Produto::where('nome', 'LIKE', "%{$query}%")->get();

    return response()->json($produtos);
}


    public function destroy(Produto $produto)
    {
        $produto->delete();
        return redirect()->route('produtos.index')->with('success', 'Produto removido com sucesso!');
    }
}
