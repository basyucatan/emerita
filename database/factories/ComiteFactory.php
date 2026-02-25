<?php

namespace Database\Factories;

use App\Models\Comite;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ComiteFactory extends Factory
{
    protected $model = Comite::class;

    public function definition()
    {
        return [
			'comite' => fake()->name(),
			'abreviatura' => fake()->name(),
			'orden' => fake()->name(),
			'comAsamblea' => fake()->name(),
        ];
    }
}
