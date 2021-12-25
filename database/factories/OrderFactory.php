<?php

namespace Database\Factories;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'patient_id' => $this->faker->ssn,
            'patient_first_name' => $this->faker->firstName,
            'patient_last_name' => $this->faker->lastName,
            'patient_date_of_birth' => $this->faker->date(),
            'patient_phone' => $this->faker->phoneNumber,
            'patient_email' => Arr::random([null, $this->faker->email]),
            'reason_of_test' => Arr::random(['Exposed', 'Traveling']),
            'covid_test_type' => Arr::random(['Sars-cov-2 NAA', 'Sars-cov-2 PCR']),
            'date_of_test' => date('Y-m-d'),
        ];
    }
}
