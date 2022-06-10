<?php

namespace Database\Factories;

use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Price>
 */
class PriceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'price' => ($this->faker->numberBetween($min = 100, $max = 999))*1000,
            'memo' => ($this->faker->numberBetween($min = 100, $max = 999))*1000 ,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
    }
}
