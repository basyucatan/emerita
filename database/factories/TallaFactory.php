<?php

namespace Database\Factories;

use App\Models\Talla;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TallaFactory extends Factory
{
    protected $model = Talla::class;

    public function definition()
    {
        return [
			'IdClase' => fake()->name(),
			'talla' => fake()->name(),
			'orden' => fake()->name(),
			'adicionales' => fake()->name(),
        ];
    }
}
