<?php

namespace Database\Factories;

use App\Models\Unidad;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UnidadFactory extends Factory
{
    protected $model = Unidad::class;

    public function definition()
    {
        return [
			'tipo' => fake()->name(),
			'unidad' => fake()->name(),
			'abreviatura' => fake()->name(),
			'factorConversion' => fake()->name(),
        ];
    }
}
