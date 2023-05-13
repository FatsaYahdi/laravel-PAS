<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image_name' => $this->faker->imageUrl($width = 640, $height = 480),
            'description' => $this->faker->sentence,
            'title' => $this->faker->sentence,
            'slug' => Str::slug($this->faker->sentence),
        ];
    }
}
