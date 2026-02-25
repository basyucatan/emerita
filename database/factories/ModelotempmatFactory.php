<?php

namespace Database\Factories;

use App\Models\Modelotempmat;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ModelotempmatFactory extends Factory
{
    protected $model = Modelotempmat::class;

    public function definition()
    {
        return [
			'IdModeloTemp' => fake()->name(),
			'principal' => fake()->name(),
			'cantidad' => fake()->name(),
			'IdMaterial' => fake()->name(),
			'diferenciador' => fake()->name(),
			'IdTipo' => fake()->name(),
			'posicion' => fake()->name(),
			'formula' => fake()->name(),
			'errFormula' => fake()->name(),
			'dimensiones' => fake()->name(),
			'costo' => fake()->name(),
			'obs' => fake()->name(),
        ];
    }
}
