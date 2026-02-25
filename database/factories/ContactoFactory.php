<?php

namespace Database\Factories;

use App\Models\Contacto;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ContactoFactory extends Factory
{
    protected $model = Contacto::class;

    public function definition()
    {
        return [
			'IdEmpresa' => fake()->name(),
			'contacto' => fake()->name(),
			'telefono' => fake()->name(),
        ];
    }
}
