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
			'razonSocial' => fake()->name(),
			'logo' => fake()->name(),
			'adicionales' => fake()->name(),
        ];
    }
}
