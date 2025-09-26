<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'code' => 'P001',
                'name' => 'Notebook Dell',
                'quantity' => 10,
                'price' => 3500.00,
                'description' => 'Notebook Dell Inspiron com 16GB RAM e SSD 512GB.'
            ],
            [
                'code' => 'P002',
                'name' => 'Mouse Gamer',
                'quantity' => 50,
                'price' => 150.00,
                'description' => 'Mouse gamer RGB com 6 botões programáveis.'
            ],
            [
                'code' => 'P003',
                'name' => 'Teclado Mecânico',
                'quantity' => 30,
                'price' => 300.00,
                'description' => 'Teclado mecânico switch blue retroiluminado.'
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
