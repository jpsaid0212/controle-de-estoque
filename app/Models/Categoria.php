<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = ['nome']; // Adicione os campos que podem ser inseridos

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }
}
