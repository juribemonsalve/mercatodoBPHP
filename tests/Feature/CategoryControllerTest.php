<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase; // Asegúrate de incluir este trait si deseas utilizar una base de datos de prueba actualizada

    public function test_permission_index_category(): void
    {
        $response = $this->get(route('categories.index'));
        $response->assertRedirect(route('login'));
    }
}
