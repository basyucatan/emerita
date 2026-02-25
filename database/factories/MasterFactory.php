<?php

namespace Database\Factories;

use App\Models\Master;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MasterFactory extends Factory
{
    protected $model = Master::class;

    public function definition()
    {
        return [
			'IdClase' => fake()->name(),
			'IdPrenda' => fake()->name(),
			'master' => fake()->name(),
			'adicionales' => fake()->name(),
        ];
    }
}
