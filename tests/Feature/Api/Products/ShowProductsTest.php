<?php

namespace Tests\Feature\Api\Products;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;


class ShowProductsTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_user_cannot_see_a_product(): void
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);
        $response = $this->getJson(route('api.product.show', ['id' => $product->id]));

        $response->assertUnauthorized();
    }

    public function test_user_can_see_a_product(): void
    {
        $admin = User::factory()->create();
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        $response = $this->actingAs($admin)->getJson(route('api.product.show', ['id' => $product->id]));

        $response->assertOk();
    }
}
