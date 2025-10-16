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
        $produtos = Produto::with('categoria')->orderBy('nome')->get();
        $valorTotalEstoque = $produtos->reduce(fn ($soma, $p) => $soma + ($p->quantidade * (float) $p->preco), 0);
        return view('produtos.index', compact('produtos', 'valorTotalEstoque'));
    }

    public function create()
    {
        $categorias = Categoria::orderBy('nome')->get();
        $fornecedores = Fornecedor::orderBy('nome')->get();
        return view('produtos.create', compact('categorias', 'fornecedores'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'categoria_id' => 'required|exists:categorias,id',
            'fornecedor_id' => 'nullable|exists:fornecedores,id',
            'quantidade' => 'required|integer|min:0',
            'preco' => ['required'],
        ]);

        Produto::create($data);
        return redirect()->route('produtos.index')->with('success', 'Produto cadastrado com sucesso!');
    }

    public function edit(Produto $produto)
    {
        $categorias = Categoria::orderBy('nome')->get();
        $fornecedores = Fornecedor::orderBy('nome')->get();
        return view('produtos.edit', compact('produto', 'categorias', 'fornecedores'));
    }

    public function update(Request $request, Produto $produto)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'categoria_id' => 'required|exists:categorias,id',
            'fornecedor_id' => 'nullable|exists:fornecedores,id',
            'quantidade' => 'required|integer|min:0',
            'preco' => ['required'],
        ]);

        $produto->update($data);
        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso!');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $produtos = Produto::where('nome', 'LIKE', "%{$query}%")->get();
        return response()->json($produtos);
    }

    public function destroy(Produto $produto)
    {
        $produto->delete();
        return redirect()->route('produtos.index')->with('success', 'Produto enviado para a lixeira!');
    }

    public function trash()
    {
        $this->authorizeAdmin();
        $produtos = Produto::onlyTrashed()->with('categoria')->orderBy('deleted_at', 'desc')->get();
        return view('produtos.trash', compact('produtos'));
    }

    public function restore($id)
    {
        $this->authorizeAdmin();
        $produto = Produto::onlyTrashed()->where('id', $id)->firstOrFail();
        $produto->restore();
        return redirect()->route('produtos.trash')->with('success', 'Produto restaurado!');
    }

    public function forceDestroy(Produto $produto)
    {
        $this->authorizeAdmin();
        $produto->forceDelete();
        return back()->with('success', 'Produto excluído definitivamente!');
    }

    public function cleanTrash(Request $request)
{
    // Apenas admin pode fazer isso (opcional)
    $this->authorizeAdmin();

    // Limpa imediatamente todos os produtos soft-deletados
    $apagados = Produto::onlyTrashed()->count();

    if ($apagados > 0) {
        Produto::onlyTrashed()->forceDelete();
        return back()->with('success', "Lixeira limpa! {$apagados} produto(s) removido(s) definitivamente.");
    }

    return back()->with('success', 'Nenhum produto na lixeira.');
}


    protected function authorizeAdmin(): void
    {
        abort_unless(auth()->check() && auth()->user()->is_admin, 403);
    }
}
