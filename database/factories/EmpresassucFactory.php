<?php

namespace Database\Factories;

use App\Models\Empresassuc;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EmpresassucFactory extends Factory
{
    protected $model = Empresassuc::class;

    public function definition()
    {
        return [
			'IdEmpresa' => fake()->name(),
			'sucursal' => fake()->name(),
			'direccion' => fake()->name(),
			'ubicacion' => fake()->name(),
			'telefono' => fake()->name(),
        ];
    }
}
