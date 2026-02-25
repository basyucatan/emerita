<?php

namespace Database\Factories;

use App\Models\Servicio;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ServicioFactory extends Factory
{
    protected $model = Servicio::class;

    public function definition()
    {
        return [
			'servicio' => fake()->name(),
			'abreviatura' => fake()->name(),
			'orden' => fake()->name(),
        ];
    }
}
