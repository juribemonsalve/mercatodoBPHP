<?php

namespace Tests\Feature\Api\Products;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

class IndexProductsTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_user_cannot_see_products_list(): void
    {
        $response = $this->getJson(route('api.products.index'));
        $response->assertUnauthorized();
    }

    public function test_user_can_see_all_products(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $products = Product::factory(5)->create(['category_id' => $category->id]);

        $response = $this->actingAs($user)->getJson(route('api.products.index'));

        $response->assertOk();
        $response->assertJsonCount(5, 'data');
    }


}
