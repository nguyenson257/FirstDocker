<?php

namespace Database\Factories;

use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sport>
 */
class SportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'uuid' => $this->faker->numberBetween($min = 1, $max = 100),
            'name' => $this->faker->name,
            'image_path' => "img".($this->faker->numberBetween($min = 1, $max = 20)).".jpg",
            'describe' => $this->faker->text($maxNbChars = 100),
            'price_id' => $this->faker->numberBetween($min = 1, $max = 50),
            'category_id' => $this->faker->numberBetween($min = 1, $max = 100),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
    }
}
