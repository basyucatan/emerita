<?php

namespace Database\Factories;

use App\Models\Depto;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DeptoFactory extends Factory
{
    protected $model = Depto::class;

    public function definition()
    {
        return [
			'depto' => fake()->name(),
        ];
    }
}
