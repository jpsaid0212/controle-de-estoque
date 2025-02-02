<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;
use App\Models\Fornecedor; // Certifique-se de importar Fornecedor

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'categoria_id',
        'fornecedor_id',
        'quantidade',
        'preco'
    ];

    // Relação com Categoria (Muitos para Um)
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    // Relação com Fornecedor (Muitos para Um)
    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class);
    }
}
