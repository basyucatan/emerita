<?php

namespace Database\Factories;

use App\Models\Materialscosto;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MaterialscostoFactory extends Factory
{
    protected $model = Materialscosto::class;

    public function definition()
    {
        return [
			'IdMaterial' => fake()->name(),
			'IdColor' => fake()->name(),
			'IdVidrio' => fake()->name(),
			'IdBarra' => fake()->name(),
			'IdUnidad' => fake()->name(),
			'precio' => fake()->name(),
        ];
    }
}
