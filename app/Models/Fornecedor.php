<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    use HasFactory;

    protected $table = 'fornecedores'; // Forçando o nome correto da tabela

    protected $fillable = ['nome', 'email', 'telefone', 'endereco'];
}
