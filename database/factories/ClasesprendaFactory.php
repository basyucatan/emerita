<?php

namespace Database\Factories;

use App\Models\Clasesprenda;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClasesprendaFactory extends Factory
{
    protected $model = Clasesprenda::class;

    public function definition()
    {
        return [
			'IdClase' => fake()->name(),
			'IdPrenda' => fake()->name(),
        ];
    }
}
