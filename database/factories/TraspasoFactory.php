<?php

namespace Database\Factories;

use App\Models\Traspaso;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TraspasoFactory extends Factory
{
    protected $model = Traspaso::class;

    public function definition()
    {
        return [
			'tipo' => fake()->name(),
			'IdUserEnv' => fake()->name(),
			'IdUserRec' => fake()->name(),
			'IdDeptoOri' => fake()->name(),
			'IdDeptoDes' => fake()->name(),
			'fecha' => fake()->name(),
			'estatus' => fake()->name(),
			'adicionales' => fake()->name(),
        ];
    }
}
