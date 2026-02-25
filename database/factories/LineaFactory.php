<?php

namespace Database\Factories;

use App\Models\Linea;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LineaFactory extends Factory
{
    protected $model = Linea::class;

    public function definition()
    {
        return [
			'IdMarca' => fake()->name(),
			'IdColorablePerfil' => fake()->name(),
			'linea' => fake()->name(),
			'orden' => fake()->name(),
        ];
    }
}
