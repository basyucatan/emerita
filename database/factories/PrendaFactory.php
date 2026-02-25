<?php

namespace Database\Factories;

use App\Models\Prenda;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PrendaFactory extends Factory
{
    protected $model = Prenda::class;

    public function definition()
    {
        return [
			'prenda' => fake()->name(),
			'adicionales' => fake()->name(),
        ];
    }
}
