<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Database\Factories\numerify;

class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->numerify('Lokasi ###'),
            'max_qty' => '100',
            'area' => "1",
            'zone' => "1",
            'aisle' => "1",
            'bay' => "1",
            'level' => "1",
            'position' => "1",
            'id_group' => 0,
        ];
    }
}
