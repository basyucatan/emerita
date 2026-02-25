<?php

namespace Database\Factories;

use App\Models\Pedido;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PedidoFactory extends Factory
{
    protected $model = Pedido::class;

    public function definition()
    {
        return [
			'IdUser' => fake()->name(),
			'IdCliente' => fake()->name(),
			'FechaH' => fake()->name(),
			'total' => fake()->name(),
			'totalArticulos' => fake()->name(),
			'estatus' => fake()->name(),
			'Obs' => fake()->name(),
			'adicionales' => fake()->name(),
        ];
    }
}
