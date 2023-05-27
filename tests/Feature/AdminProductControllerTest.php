<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminProductControllerTest extends TestCase
{
    use RefreshDatabase;
    // Asegúrate de incluir este trait si deseas utilizar una base de datos de prueba actualizada

    public function test_permission_index_adminproduct(): void
    {
        $response = $this->get(route('product.index'));
        $response->assertRedirect(route('login'));
    }
}
