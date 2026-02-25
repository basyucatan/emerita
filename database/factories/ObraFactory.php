<?php

namespace Database\Factories;

use App\Models\Obra;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ObraFactory extends Factory
{
    protected $model = Obra::class;

    public function definition()
    {
        return [
			'IdEmpresa' => fake()->name(),
			'obra' => fake()->name(),
			'direccion' => fake()->name(),
			'ubicacion' => fake()->name(),
        ];
    }
}
