<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use SoftDeletes;

    protected $table = 'produtos';

    protected $fillable = [
        'nome',
        'descricao',
        'categoria_id',
        'fornecedor_id',
        'quantidade',
        'preco',
    ];

    protected $casts = [
        'preco' => 'decimal:2',
        'quantidade' => 'integer',
    ];

    // aceita "50,99" e "1.234,56"
    public function setPrecoAttribute($value): void
    {
        if (is_string($value)) {
            $value = str_replace(['.', ','], ['', '.'], $value);
        }
        $this->attributes['preco'] = $value === '' || $value === null ? 0 : (float) $value;
    }

    // RELACIONAMENTOS
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class, 'fornecedor_id');
    }

    public function movimentacoes()
    {
        return $this->hasMany(Movimentacao::class, 'produto_id');
    }
}
