<?php

namespace Database\Factories;

use App\Models\Inquietud;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class InquietudFactory extends Factory
{
    protected $model = Inquietud::class;

    public function definition()
    {
        return [
			'fecha' => fake()->name(),
			'nombre' => fake()->name(),
			'telefono' => fake()->name(),
			'titulo' => fake()->name(),
			'inquietud' => fake()->name(),
			'respuesta' => fake()->name(),
			'estatus' => fake()->name(),
			'adicionales' => fake()->name(),
        ];
    }
}
