<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public function definition()
    {
        $products = [
            'Computadora portátil (laptop)',
            'Tablet',
            'Televisor inteligente (smart TV)',
            'Consola de videojuegos',
            'Altavoz inteligente',
            'Reloj inteligente',
            'Auriculares inalámbricos',
            'Cámara digital o cámara réflex digital',
            'Dron',
            'Impresora 3D',
            'Gafas de realidad virtual',
            'Gafas de realidad aumentada',
            'Proyector de video',
            'Asistente de voz virtual',
            'Fundas y estuches para teléfonos',
            'Protectores de pantalla para teléfonos',
            'Cargadores portátiles',
            'Auriculares con cable o inalámbricos',
            'Soportes y soportes para teléfonos',
            'Tarjetas de memoria para expandir el almacenamiento del teléfono',
            'Adaptadores y cables de carga',
            'Aspiradora robotizada',
            'Enchufes inteligentes',
            'Luces inteligentes',
            'Termostatos inteligentes',
            'Cámaras de seguridad para el hogar',
            'Timbres inteligentes',
            'Asistentes de voz para el hogar',
            'Dispositivos de control de energía',
        ];

        $descriptions = [
            'El producto es bueno',
            'El producto es excelente',
            'El producto es genial',
        ];

        return [
            'cover_img' => $this->faker->imageUrl(640, 480, $this->faker->randomElement(['Technology', 'Cell phones and accessories', 'accessories electric home'])),
            'name' => $this->faker->randomElement($products),
            'description' => $this->faker->randomElement($descriptions),
            'price' => $this->faker->randomFloat(0, 0, 1000000),
            'quantity' => $this->faker->numberBetween(0, 100),
            'category_id' => Category::inRandomOrder()->first()->id,
            'status' => $this->faker->randomElement(['active', 'disabled']),
        ];
    }
}
