<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_product_can_be_created_with_all_fields()
    {
        Storage::fake('public');
        $category = Category::factory()->create();

        $image = UploadedFile::fake()->image('product.jpg');

        $product = Product::create([
            'name' => 'Producto de Prueba',
            'price' => 199.99,
            'category_id' => $category->id,
            'description' => 'Descripción de prueba con texto enriquecido.',
            'stock' => 25,
            'image' => $image->store('products', 'public'),
        ]);

        /* Comprobar que el producto existe en la base de datos */
        $this->assertDatabaseHas('products', [
            'name' => 'Producto de Prueba',
            'price' => 199.99,
            'category_id' => $category->id,
            'stock' => 25,
        ]);

        Storage::disk('public')->assertExists($product->image);
    }

    public function test_a_product_requires_mandatory_fields()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        Product::create([]);
    }

    public function test_product_belongs_to_a_category()
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create([
            'category_id' => $category->id,
        ]);

        $this->assertEquals($category->id, $product->category->id);
        $this->assertInstanceOf(Category::class, $product->category);
    }
}
