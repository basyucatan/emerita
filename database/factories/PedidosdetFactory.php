<?php

namespace Database\Factories;

use App\Models\Pedidosdet;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PedidosdetFactory extends Factory
{
    protected $model = Pedidosdet::class;

    public function definition()
    {
        return [
			'IdPedido' => fake()->name(),
			'IdProducto' => fake()->name(),
			'cantidad' => fake()->name(),
			'precioU' => fake()->name(),
        ];
    }
}
