<?php

namespace Database\Factories;

use App\Models\Barra;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BarraFactory extends Factory
{
    protected $model = Barra::class;

    public function definition()
    {
        return [
			'longitud' => fake()->name(),
			'descripcion' => fake()->name(),
        ];
    }
}
