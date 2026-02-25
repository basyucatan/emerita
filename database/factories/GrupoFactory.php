<?php

namespace Database\Factories;

use App\Models\Grupo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class GrupoFactory extends Factory
{
    protected $model = Grupo::class;

    public function definition()
    {
        return [
			'IdDistrito' => fake()->name(),
			'grupo' => fake()->name(),
			'miembros' => fake()->name(),
			'mujeres' => fake()->name(),
			'discapacitados' => fake()->name(),
			'LGBTQyMas' => fake()->name(),
			'direccion' => fake()->name(),
			'localidad' => fake()->name(),
			'tipo' => fake()->name(),
			'RSG' => fake()->name(),
			'RSGSup' => fake()->name(),
			'telefonoRSG' => fake()->name(),
			'respCAsam' => fake()->name(),
			'foto' => fake()->name(),
			'gmaps' => fake()->name(),
			'ubicacion' => fake()->name(),
			'IdComite' => fake()->name(),
			'clase' => fake()->name(),
			'Obs' => fake()->name(),
			'asamblea1' => fake()->name(),
			'asamblea2' => fake()->name(),
			'vigente' => fake()->name(),
        ];
    }
}
