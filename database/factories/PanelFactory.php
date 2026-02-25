<?php

namespace Database\Factories;

use App\Models\Panel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PanelFactory extends Factory
{
    protected $model = Panel::class;

    public function definition()
    {
        return [
			'panel' => fake()->name(),
			'ancho' => fake()->name(),
			'alto' => fake()->name(),
        ];
    }
}
