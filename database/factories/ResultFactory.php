<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ResultFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'has_covid' => $this->faker->boolean(),
            'has_flu_a' => $this->faker->boolean(),
            'has_flu_b' => $this->faker->boolean(),
            'has_rsv' => $this->faker->boolean(),
            'document' => 'fake.pdf',
        ];
    }
}
