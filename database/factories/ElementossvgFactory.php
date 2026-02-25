<?php

namespace Database\Factories;

use App\Models\Elementossvg;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ElementossvgFactory extends Factory
{
    protected $model = Elementossvg::class;

    public function definition()
    {
        return [
			'IdModeloSvg' => fake()->name(),
			'posicion' => fake()->name(),
			'anguloInicio' => fake()->name(),
			'anguloFin' => fake()->name(),
			'dominante' => fake()->name(),
			'd' => fake()->name(),
			'style' => fake()->name(),
			'props' => fake()->name(),
        ];
    }
}
