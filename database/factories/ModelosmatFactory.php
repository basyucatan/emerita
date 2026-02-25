<?php

namespace Database\Factories;

use App\Models\Modelosmat;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ModelosmatFactory extends Factory
{
    protected $model = Modelosmat::class;

    public function definition()
    {
        return [
			'IdModelo' => fake()->name(),
			'principal' => fake()->name(),
			'cantidad' => fake()->name(),
			'IdMaterial' => fake()->name(),
			'IdTablaHerraje' => fake()->name(),
			'cantidadHerraje' => fake()->name(),
			'diferenciador' => fake()->name(),
			'IdTipo' => fake()->name(),
			'posicion' => fake()->name(),
			'formula' => fake()->name(),
			'errFormula' => fake()->name(),
			'dimensiones' => fake()->name(),
			'costo' => fake()->name(),
			'tipCosto' => fake()->name(),
			'adicionales' => fake()->name(),
			'obs' => fake()->name(),
        ];
    }
}
