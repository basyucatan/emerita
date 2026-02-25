<?php

namespace Database\Factories;

use App\Models\Apertura;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AperturaFactory extends Factory
{
    protected $model = Apertura::class;

    public function definition()
    {
        return [
			'apertura' => fake()->name(),
			'd' => fake()->name(),
			'emoji' => fake()->name(),
        ];
    }
}
