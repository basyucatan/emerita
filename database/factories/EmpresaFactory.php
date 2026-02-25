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
			'IdNegocio' => fake()->name(),
			'tipo' => fake()->name(),
			'empresa' => fake()->name(),
			'direccion' => fake()->name(),
			'gmaps' => fake()->name(),
			'telefono' => fake()->name(),
			'email' => fake()->name(),
			'adicionales' => fake()->name(),
        ];
    }
}
