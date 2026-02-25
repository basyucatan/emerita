<?php

namespace Database\Factories;

use App\Models\Modelopremat;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ModeloprematFactory extends Factory
{
    protected $model = Modelopremat::class;

    public function definition()
    {
        return [
			'IdModeloPre' => fake()->name(),
			'IdMaterialCosto' => fake()->name(),
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
			'tipCosto' => fake()->name(),
			'obs' => fake()->name(),
			'adicionales' => fake()->name(),
        ];
    }
}
