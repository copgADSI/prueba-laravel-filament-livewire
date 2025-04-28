<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $categories = [
            [
                'name' => 'Ropa',
            ],
            [
                'name' => 'Calzado',
            ],
            [
                'name' => 'Accesorios',
            ],
        ];

        Category::insert($categories);

        $products = [
            [
                'name' => 'Camiseta de algodón',
                'price' => 29.99,
                'description' => 'Camiseta 100% algodón, color negro.',
                'stock' => 50,
                'image' => 'productos/camiseta-negra.jpg',
                'category_id' => 1,
            ],
            [
                'name' => 'Jeans azul oscuro',
                'price' => 49.99,
                'description' => 'Jeans azul oscuro de corte slim.',
                'stock' => 30,
                'image' => 'productos/jeans.jpg',
                'category_id' => 2,
            ],
            [
                'name' => 'Zapatillas deportivas',
                'price' => 79.99,
                'description' => 'Zapatillas deportivas para correr.',
                'stock' => 20,
                'image' => 'productos/zapatillas.jpg',
                'category_id' => 3,
            ],
        ];

        Product::insert($products);
    }
}
