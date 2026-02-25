<?php

namespace Database\Factories;

use App\Models\Moneda;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MonedaFactory extends Factory
{
    protected $model = Moneda::class;

    public function definition()
    {
        return [
			'moneda' => fake()->name(),
			'centavos' => fake()->name(),
			'simbolo' => fake()->name(),
			'abreviatura' => fake()->name(),
			'tipoCambio' => fake()->name(),
        ];
    }
}
