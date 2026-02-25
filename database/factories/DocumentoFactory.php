<?php

namespace Database\Factories;

use App\Models\Documento;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DocumentoFactory extends Factory
{
    protected $model = Documento::class;

    public function definition()
    {
        return [
			'fechaEmision' => fake()->name(),
			'adicionales' => fake()->name(),
        ];
    }
}
