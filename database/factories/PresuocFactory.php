<?php

namespace Database\Factories;

use App\Models\Presuoc;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PresuocFactory extends Factory
{
    protected $model = Presuoc::class;

    public function definition()
    {
        return [
			'IdPresupuesto' => fake()->name(),
			'IdMarca' => fake()->name(),
			'IdProvee' => fake()->name(),
			'IdSolicita' => fake()->name(),
			'IdRecibe' => fake()->name(),
			'fechaGen' => fake()->name(),
			'fechaSur' => fake()->name(),
			'estatus' => fake()->name(),
        ];
    }
}
