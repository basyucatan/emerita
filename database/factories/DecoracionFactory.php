<?php

namespace Database\Factories;

use App\Models\Decoracion;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DecoracionFactory extends Factory
{
    protected $model = Decoracion::class;

    public function definition()
    {
        return [
			'decoracion' => fake()->name(),
			'adicionales' => fake()->name(),
        ];
    }
}
