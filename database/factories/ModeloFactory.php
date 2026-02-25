<?php

namespace Database\Factories;

use App\Models\Modelo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ModeloFactory extends Factory
{
    protected $model = Modelo::class;

    public function definition()
    {
        return [
			'modelo' => fake()->name(),
			'adicionales' => fake()->name(),
        ];
    }
}
