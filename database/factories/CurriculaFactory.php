<?php

namespace Database\Factories;

use App\Models\Curricula;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CurriculaFactory extends Factory
{
    protected $model = Curricula::class;

    public function definition()
    {
        return [
			'nombre' => fake()->name(),
			'fechaNacimiento' => fake()->name(),
			'edoCivil' => fake()->name(),
			'direccion' => fake()->name(),
			'ciudad' => fake()->name(),
			'email' => fake()->name(),
			'estudios' => fake()->name(),
			'actividadLaboral' => fake()->name(),
			'fechaIngresoAA' => fake()->name(),
			'IdDistrito' => fake()->name(),
			'IdGrupo' => fake()->name(),
			'IdComiteAsamblea' => fake()->name(),
			'serviciosDistrito' => fake()->name(),
			'serviciosDeseados' => fake()->name(),
			'dispViaje' => fake()->name(),
			'dispVehiculo' => fake()->name(),
			'dispIntegrante' => fake()->name(),
			'dispSolvencia' => fake()->name(),
			'dispComputacion' => fake()->name(),
			'obs' => fake()->name(),
        ];
    }
}
