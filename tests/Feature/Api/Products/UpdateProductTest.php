<?php

namespace Tests\Feature\Api\Products;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

class UpdateProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_user_cannot_update_a_product(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        $response = $this->putJson(route('api.product.update', ['id' => $product->id]), [
            'name' => 'Auriculares de prueba',
            'description' => 'El producto es excelente',
            'price' => 999,
            'quantity' => 10,
            'category_id' => $category->id,
            'status' => 'active',
        ]);

        $response->assertUnauthorized();
    }

    public function test_user_can_update_a_product(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        $response = $this->actingAs($user)->putJson(route('api.product.update', ['id' => $product->id]), [
            'name' => 'Auriculares de prueba',
            'description' => 'El producto es excelente',
            'price' => 999,
            'quantity' => 10,
            'category_id' => $category->id,
            'status' => 'active',
        ]);

        $response->assertOk();
    }
}
