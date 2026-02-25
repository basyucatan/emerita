<?php

namespace Database\Factories;

use App\Models\Distritosserv;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DistritosservFactory extends Factory
{
    protected $model = Distritosserv::class;

    public function definition()
    {
        return [
			'IdDistrito' => fake()->name(),
			'IdServicio' => fake()->name(),
			'IdComite' => fake()->name(),
			'IdComiteCan' => fake()->name(),
			'servidor' => fake()->name(),
			'telefono' => fake()->name(),
			'asamblea1' => fake()->name(),
			'asamblea2' => fake()->name(),
        ];
    }
}
