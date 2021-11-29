<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->numerify('Product ###'),
            'detail' => $this->faker->paragraph(1),
            'location_id' => \App\Models\Location::factory()->create()->id,
            'stock' => 100,
            'satuan' => $this->faker->randomElement([
                "Pcs", "Pak", "Botol",
            ]),
        ];
    }
}
