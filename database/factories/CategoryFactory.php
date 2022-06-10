<?php

namespace Database\Factories;

use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'memo' => $this->faker->text($maxNbChars = 100),
            'sort' => $this->faker->numberBetween($min = 1, $max = 100),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
    }
}
