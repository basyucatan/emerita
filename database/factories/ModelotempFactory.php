<?php

namespace Database\Factories;

use App\Models\Modelotemp;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ModelotempFactory extends Factory
{
    protected $model = Modelotemp::class;

    public function definition()
    {
        return [
			'IdPresuelem' => fake()->name(),
			'IdModelo' => fake()->name(),
			'IdLinea' => fake()->name(),
			'modelo' => fake()->name(),
			'ancho' => fake()->name(),
			'alto' => fake()->name(),
			'IdColorable' => fake()->name(),
			'IdColorPerfil' => fake()->name(),
			'IdVidrio' => fake()->name(),
			'IdColorVidrio' => fake()->name(),
			'foto' => fake()->name(),
			'fichaTecnica' => fake()->name(),
        ];
    }
}
