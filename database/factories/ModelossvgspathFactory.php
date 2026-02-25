<?php

namespace Database\Factories;

use App\Models\Modelossvgspath;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ModelossvgspathFactory extends Factory
{
    protected $model = Modelossvgspath::class;

    public function definition()
    {
        return [
			'IdModeloSvg' => fake()->name(),
			'tipoPath' => fake()->name(),
			'd' => fake()->name(),
			'points' => fake()->name(),
			'style' => fake()->name(),
			'props' => fake()->name(),
        ];
    }
}
