<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        $priceNet = $this->faker->numberBetween(1000, 50000);
        $priceSale = $priceNet * 1.19;

        return [
            'sku' => strtoupper($this->faker->bothify('SKU-####')),
            'nombre' => $this->faker->words(3, true),
            'descripcion_corta' => $this->faker->sentence(5),
            'descripcion_larga' => $this->faker->paragraph(3),
            'imagen' => $this->faker->imageUrl(640, 480, 'products', true),
            'precio_neto' => $priceNet,
            'precio_venta' => $priceSale,
            'stock_actual' => $this->faker->numberBetween(0, 100),
            'stock_minimo' => $this->faker->numberBetween(1, 10),
            'stock_bajo' => $this->faker->numberBetween(10, 30),
            'stock_alto' => $this->faker->numberBetween(50, 100),
        ];
    }
}
