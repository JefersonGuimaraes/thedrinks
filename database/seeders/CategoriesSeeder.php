<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['category' => 'Alcoólico'],
            ['category' => 'Batido'],
            ['category' => 'Mexido'],
            ['category' => 'Montado'],
            ['category' => 'Não alcoólico'],
        ];

        // Inserir as categorias na tabela 'categories'
        Category::insert($categories);
    }
}
