<?php

namespace Database\Factories;

use App\Models\Documentospag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DocumentospagFactory extends Factory
{
    protected $model = Documentospag::class;

    public function definition()
    {
        return [
			'IdDocumento' => fake()->name(),
			'pagina' => fake()->name(),
			'textoOri' => fake()->name(),
			'textoNor' => fake()->name(),
        ];
    }
}
