<?php

namespace Database\Factories;

use App\Models\Presupuesto;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PresupuestoFactory extends Factory
{
    protected $model = Presupuesto::class;

    public function definition()
    {
        return [
			'IdCliente' => fake()->name(),
			'IdObra' => fake()->name(),
			'IdColorable' => fake()->name(),
			'canceleria' => fake()->name(),
			'IdColorPerfil' => fake()->name(),
			'IdVidrio' => fake()->name(),
			'IdColorVidrio' => fake()->name(),
			'fecha' => fake()->name(),
			'porDescuento' => fake()->name(),
			'descripcion' => fake()->name(),
			'obs' => fake()->name(),
			'estatus' => fake()->name(),
        ];
    }
}
