<?php

namespace Database\Factories;

use App\Models\Negocio;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NegocioFactory extends Factory
{
    protected $model = Negocio::class;

    public function definition()
    {
        return [
			'negocio' => fake()->name(),
			'rfc' => fake()->name(),
			'direccion' => fake()->name(),
			'ciudad' => fake()->name(),
			'telefono' => fake()->name(),
			'logo' => fake()->name(),
			'cuenta' => fake()->name(),
			'email' => fake()->name(),
        ];
    }
}
