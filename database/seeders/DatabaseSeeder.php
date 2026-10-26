<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Branch;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Crear marcas de prueba
        $marca1 = Branch::create(['nombre' => 'Samsung']);
        $marca2 = Branch::create(['nombre' => 'Apple']);
        $marca3 = Branch::create(['nombre' => 'Sony']);

        // 2. Crear productos de prueba asociados a las marcas
        Product::create([
            'nombre' => 'Galaxy S23',
            'precio' => '899.99',
            'marca'  => $marca1->codigo,
        ]);

        Product::create([
            'nombre' => 'iPhone 15',
            'precio' => '999.99',
            'marca'  => $marca2->codigo,
        ]);

        Product::create([
            'nombre' => 'Audífonos WH-1000XM5',
            'precio' => '349.99',
            'marca'  => $marca3->codigo,
        ]);
    }
}