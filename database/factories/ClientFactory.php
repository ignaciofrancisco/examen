<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    public function definition(): array
    {
        return [
            'rut_empresa' => $this->faker->unique()->numerify('########-#'),
            'rubro' => $this->faker->word,
            'razon_social' => $this->faker->company,
            'telefono' => $this->faker->phoneNumber,
            'direccion' => $this->faker->address,
            'nombre_contacto' => $this->faker->name,
            'email_contacto' => $this->faker->unique()->safeEmail,
        ];
    }
}
