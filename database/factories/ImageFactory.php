<?php

namespace Database\Factories;

use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'sport_id' => $this->faker->numberBetween($min = 1, $max = 100),
            'image_path' => "img".($this->faker->numberBetween($min = 1, $max = 20)).".jpg",
            'title' => $this->faker->text($maxNbChars = 100),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
    }
}
