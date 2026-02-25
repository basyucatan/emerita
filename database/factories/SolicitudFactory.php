<?php

namespace Database\Factories;

use App\Models\Solicitud;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SolicitudFactory extends Factory
{
    protected $model = Solicitud::class;

    public function definition()
    {
        return [
			'fecha' => fake()->name(),
			'nombre' => fake()->name(),
			'telefono' => fake()->name(),
			'titulo' => fake()->name(),
			'solicitud' => fake()->name(),
			'estatus' => fake()->name(),
			'adicionales' => fake()->name(),
        ];
    }
}
