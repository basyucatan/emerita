<?php

namespace Database\Factories;

use App\Models\Empresa;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EmpresaFactory extends Factory
{
    protected $model = Empresa::class;

    public function definition()
    {
        return [
			'tipo' => fake()->name(),
			'nombre' => fake()->name(),
			'direccion' => fake()->name(),
			'ubicacion' => fake()->name(),
			'telefono' => fake()->name(),
        ];
    }
}
