<?php

namespace Database\Factories;

use App\Models\Mensaje;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MensajeFactory extends Factory
{
    protected $model = Mensaje::class;

    public function definition()
    {
        return [
			'titulo' => fake()->name(),
			'fechaIni' => fake()->name(),
			'fechaFin' => fake()->name(),
			'foto' => fake()->name(),
			'contenido' => fake()->name(),
			'documento' => fake()->name(),
			'urlLink' => fake()->name(),
        ];
    }
}
