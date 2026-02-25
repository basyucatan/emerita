<?php

namespace Database\Factories;

use App\Models\Experiencia;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ExperienciaFactory extends Factory
{
    protected $model = Experiencia::class;

    public function definition()
    {
        return [
			'IdDistrito' => fake()->name(),
			'titulo' => fake()->name(),
			'foto' => fake()->name(),
			'experiencia' => fake()->name(),
			'adicionales' => fake()->name(),
        ];
    }
}
