<?php

namespace Database\Factories;

use App\Models\Colorable;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ColorableFactory extends Factory
{
    protected $model = Colorable::class;

    public function definition()
    {
        return [
			'colorable' => fake()->name(),
			'tipo' => fake()->name(),
        ];
    }
}
