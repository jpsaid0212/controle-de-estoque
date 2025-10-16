<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fornecedor;

class FornecedorSeeder extends Seeder {
    public function run(): void {
        $fornecedores = [
            ['nome' => 'Fornecedor Padrão', 'email' => null, 'telefone' => null, 'endereco' => null],
            ['nome' => 'Tech Distribuidora', 'email' => 'contato@tech.com', 'telefone' => '11 99999-0000', 'endereco' => 'Rua Exemplo, 100']
        ];
        foreach ($fornecedores as $f) Fornecedor::firstOrCreate(['nome' => $f['nome']], $f);
    }
}
