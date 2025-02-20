<?php

namespace Database\Factories;

use App\Models\Curso;
use Illuminate\Database\Eloquent\Factories\Factory;

class CursoFactory extends Factory
{
    protected $model = Curso::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->sentence(2) ,
            'horas' => $this->faker->numberBetween(10, 100),
        ];
    }
}
