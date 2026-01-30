<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Laptops',
            'Smartphones',
            'Tablets',
            'Accesorios',
            'Periféricos',
            'Componentes',
            'Redes',
            'Almacenamiento',
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}
