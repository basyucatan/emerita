<?php

namespace Database\Factories;

use App\Models\Traspasosdet;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TraspasosdetFactory extends Factory
{
    protected $model = Traspasosdet::class;

    public function definition()
    {
        return [
			'IdTraspaso' => fake()->name(),
			'IdMatCosto' => fake()->name(),
			'cantidad' => fake()->name(),
			'valorU' => fake()->name(),
			'dimensiones' => fake()->name(),
			'adicionales' => fake()->name(),
        ];
    }
}
