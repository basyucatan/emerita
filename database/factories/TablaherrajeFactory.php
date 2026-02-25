<?php

namespace Database\Factories;

use App\Models\Tablaherraje;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TablaherrajeFactory extends Factory
{
    protected $model = Tablaherraje::class;

    public function definition()
    {
        return [
			'IdLinea' => fake()->name(),
			'tablaHerraje' => fake()->name(),
			'fichaTecnica' => fake()->name(),
        ];
    }
}
