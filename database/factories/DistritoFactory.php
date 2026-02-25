<?php

namespace Database\Factories;

use App\Models\Distrito;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DistritoFactory extends Factory
{
    protected $model = Distrito::class;

    public function definition()
    {
        return [
			'distrito' => fake()->name(),
			'panel' => fake()->name(),
			'orden' => fake()->name(),
			'direccion' => fake()->name(),
			'telefono' => fake()->name(),
			'foto' => fake()->name(),
			'gmaps' => fake()->name(),
			'ubicacion' => fake()->name(),
			'fechaHPle' => fake()->name(),
			'fechaHEst' => fake()->name(),
			'fechaHSer' => fake()->name(),
			'fechaHEva' => fake()->name(),
			'obs' => fake()->name(),
			'adicionales' => fake()->name(),
			'porcionGeo' => fake()->name(),
        ];
    }
}
