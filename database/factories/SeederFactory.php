<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;
use App\Models\Location;
use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $this->faker->name(),
        'email' => $this->faker->unique()->safeEmail(),
        'nik' => $faker->unique()->randomDigit,
        'departement' => $faker->randomElement([
            "IT", "HRD", "WHS", "Manager"
        ]),
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(Location::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->randomDigit,
        'max_qty' => '100',
        'area' => $faker->unique()->randomDigit,
        'zone' => $faker->unique()->randomDigit,
        'aisle' => $faker->unique()->randomDigit,
        'bay' => $faker->unique()->randomDigit,
        'level' => $faker->unique()->randomDigit,
        'position' => $faker->unique()->randomDigit,
        'id_group' => 0,
    ];
});

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => numerify('Product ###'),
        'detail' => $faker->paragraph(1),
        'stock' => 100,
        'satuan' => 'Pcs',
    ];
});
