<?php

namespace Database\Factories;

use App\Models\Modelossvg;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ModelossvgFactory extends Factory
{
    protected $model = Modelossvg::class;

    public function definition()
    {
        return [
			'IdModeloPre' => fake()->name(),
			'IdPadre' => fake()->name(),
			'tipoLogico' => fake()->name(),
			'ancho' => fake()->name(),
			'alto' => fake()->name(),
			'x' => fake()->name(),
			'y' => fake()->name(),
			'grosor' => fake()->name(),
			'IdApertura' => fake()->name(),
			'd' => fake()->name(),
			'style' => fake()->name(),
			'props' => fake()->name(),
        ];
    }
}
