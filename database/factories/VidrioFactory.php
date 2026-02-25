<?php

namespace Database\Factories;

use App\Models\Vidrio;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VidrioFactory extends Factory
{
    protected $model = Vidrio::class;

    public function definition()
    {
        return [
			'vidrio' => fake()->name(),
			'grosor' => fake()->name(),
        ];
    }
}
