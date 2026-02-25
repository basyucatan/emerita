<?php

namespace Database\Factories;

use App\Models\Presuelem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PresuelemFactory extends Factory
{
    protected $model = Presuelem::class;

    public function definition()
    {
        return [
			'IdPresupuesto' => fake()->name(),
			'IdColorPerfil' => fake()->name(),
			'IdVidrio' => fake()->name(),
			'IdColorVidrio' => fake()->name(),
			'IdModelo' => fake()->name(),
			'cantidad' => fake()->name(),
			'tipo' => fake()->name(),
			'ancho' => fake()->name(),
			'alto' => fake()->name(),
			'descripcion' => fake()->name(),
			'ubicacion' => fake()->name(),
			'precioU' => fake()->name(),
        ];
    }
}
