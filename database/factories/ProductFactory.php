<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $products = ['tafel', 'stoel', 'laptop', 'beker', 'drinkfles', 'rugzak', 'slaapzak', 'horloge', 'luidspreker'];

        return [
            'name' => $this->faker->colorName() . ' ' . $this->faker->randomElement($products),
            'sku' => strtoupper($this->faker->bothify('???#####')),
            'description' => $this->faker->realText(),
        ];
    }
}
