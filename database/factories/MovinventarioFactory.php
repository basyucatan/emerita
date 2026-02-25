<?php

namespace Database\Factories;

use App\Models\Movinventario;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MovinventarioFactory extends Factory
{
    protected $model = Movinventario::class;

    public function definition()
    {
        return [
			'IdUserEnv' => fake()->name(),
			'IdUserRec' => fake()->name(),
			'tipo' => fake()->name(),
			'IdMatCosto' => fake()->name(),
			'IdOrigen' => fake()->name(),
			'IdDestino' => fake()->name(),
			'fechaH' => fake()->name(),
			'cantidad' => fake()->name(),
			'valorU' => fake()->name(),
			'dimensiones' => fake()->name(),
			'adicionales' => fake()->name(),
        ];
    }
}
