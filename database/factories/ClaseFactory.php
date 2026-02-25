<?php

namespace Database\Factories;

use App\Models\Clase;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClaseFactory extends Factory
{
    protected $model = Clase::class;

    public function definition()
    {
        return [
			'clase' => fake()->name(),
			'orden' => fake()->name(),
			'depto' => fake()->name(),
        ];
    }
}
