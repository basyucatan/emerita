<?php

namespace Database\Factories;

use App\Models\Regla;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ReglaFactory extends Factory
{
    protected $model = Regla::class;

    public function definition()
    {
        return [
			'IdLinea' => fake()->name(),
			'IdMaterial' => fake()->name(),
			'IdMatRelacion' => fake()->name(),
			'baseCalculo' => fake()->name(),
			'efectoCalculo' => fake()->name(),
			'factor' => fake()->name(),
        ];
    }
}
