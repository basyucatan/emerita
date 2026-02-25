<?php

namespace Database\Factories;

use App\Models\Presuocsdet;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PresuocsdetFactory extends Factory
{
    protected $model = Presuocsdet::class;

    public function definition()
    {
        return [
			'IdPresuOC' => fake()->name(),
			'IdMaterialCosto' => fake()->name(),
			'cantidadRequerida' => fake()->name(),
			'cantidadAlmacen' => fake()->name(),
			'cantidadComprar' => fake()->name(),
			'costoU' => fake()->name(),
        ];
    }
}
