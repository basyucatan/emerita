<?php

namespace Database\Factories;

use App\Models\Curriculasdet;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CurriculasdetFactory extends Factory
{
    protected $model = Curriculasdet::class;

    public function definition()
    {
        return [
			'IdCurricula' => fake()->name(),
			'servicio' => fake()->name(),
			'desde' => fake()->name(),
			'hasta' => fake()->name(),
			'resultado' => fake()->name(),
			'obs' => fake()->name(),
        ];
    }
}
