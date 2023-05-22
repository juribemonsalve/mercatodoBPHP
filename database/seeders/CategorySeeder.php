<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Category::create([
            'name' => 'Tecnologia',
            'description' => 'Computación, Zona gamer, Accesorios gamer, TV y video, Audio,Smartwatch y accesorios, Consolas, Electromovilidad, Fotografía, Drones, Hogar inteligente',
        ]);
        Category::create([
            'name' => 'Celulares y accesorios',
            'description' => 'Celulares, Smartwatch y accesorios, Audífonos, Accesorios celulares',
        ]);
        Category::create([
            'name' => 'Electrohogar',
            'description' => 'Refrigeración, Climatización, Lavado y planchado, Cocina, Aspirado y limpieza, Electrodomésticos de cocina, Maquinas de coser, Cuidado personal',
        ]);
    }
}
