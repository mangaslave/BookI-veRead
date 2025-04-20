<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FormatFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['Hardcover', 'Paperback', 'Ebook', 'Audiobook']),
        ];
    }
}
