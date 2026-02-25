<?php

namespace Database\Factories;

use App\Models\Foto;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FotoFactory extends Factory
{
    protected $model = Foto::class;

    public function definition()
    {
        return [
			'IdPrenda' => fake()->name(),
			'IdModelo' => fake()->name(),
			'fondo' => fake()->name(),
			'foto' => fake()->name(),
			'adicionales' => fake()->name(),
        ];
    }
}
