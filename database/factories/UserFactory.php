<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    public function definition(): array
    {
        $firstName = $this->faker->firstName;
        $lastName = $this->faker->lastName;

        return [
            'rut' => $this->faker->unique()->numerify('########-#'),
            'nombre' => $firstName,
            'apellido' => $lastName,
            'email' => strtolower($firstName . '.' . $lastName) . '@ventasfix.cl',
            'password' => Hash::make('password123'), // default
        ];
    }
}
