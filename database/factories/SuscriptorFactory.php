<?php

namespace Database\Factories;

use App\Models\Suscriptor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SuscriptorFactory extends Factory
{
    protected $model = Suscriptor::class;

    public function definition()
    {
        return [
			'Suscriptor' => fake()->name(),
			'IdTipo' => fake()->name(),
			'IdClase' => fake()->name(),
			'IdGrupo' => fake()->name(),
			'Inicio' => fake()->name(),
			'Fin' => fake()->name(),
			'Adicionales' => fake()->name(),
			'Obs' => fake()->name(),
        ];
    }
}
