<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder {
    public function run(): void {
        $nomes = ['Geral', 'Informática', 'Papelaria', 'Higiene', 'Alimentos'];
        foreach ($nomes as $n) Categoria::firstOrCreate(['nome' => $n]);
    }
}
