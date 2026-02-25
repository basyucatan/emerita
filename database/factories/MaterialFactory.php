<?php

namespace Database\Factories;

use App\Models\Material;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MaterialFactory extends Factory
{
    protected $model = Material::class;

    public function definition()
    {
        return [
			'IdClase' => fake()->name(),
			'IdMarca' => fake()->name(),
			'IdTipoDefault' => fake()->name(),
			'referencia' => fake()->name(),
			'material' => fake()->name(),
			'foto' => fake()->name(),
			'rendimiento' => fake()->name(),
			'KgxMetro' => fake()->name(),
			'IdUnidadRend' => fake()->name(),
        ];
    }
}
