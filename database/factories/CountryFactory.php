<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CountryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => json_encode([
                $this->faker->languageCode() => $this->faker->country(),
                $this->faker->languageCode() => $this->faker->country(),
            ]),
            'code' => $this->faker->countryCode()
        ];
    }
}
