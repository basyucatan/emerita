<?php

namespace Database\Factories;

use App\Models\Tablaherrajesdet;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TablaherrajesdetFactory extends Factory
{
    protected $model = Tablaherrajesdet::class;

    public function definition()
    {
        return [
			'IdTablaHerraje' => fake()->name(),
			'cantidad' => fake()->name(),
			'IdMaterial' => fake()->name(),
			'default' => fake()->name(),
			'rangoMenor' => fake()->name(),
			'rangoMayor' => fake()->name(),
			'adicionales' => fake()->name(),
        ];
    }
}
