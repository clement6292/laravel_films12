<?php

namespace Database\Factories;

use App\Models\Film;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Film>
 */
class FilmFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Film::class;

    public function definition(): array
    {
        return [
            'title' => fake()->sentence(2, true),           
            'year' => fake()->year,           
            'description' => fake()->paragraph(),
        ];
    }
}
