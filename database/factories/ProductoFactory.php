<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductoFactory extends Factory
{
    protected $model = Producto::class;

    public function definition()
    {
        return [
			'codigo' => fake()->name(),
			'foto' => fake()->name(),
			'linkCMSG' => fake()->name(),
			'producto' => fake()->name(),
			'IdClase' => fake()->name(),
			'precioU' => fake()->name(),
			'precioN' => fake()->name(),
			'costoU' => fake()->name(),
			'stockMin' => fake()->name(),
			'pDescuento' => fake()->name(),
			'activo' => fake()->name(),
			'obs' => fake()->name(),
        ];
    }
}
