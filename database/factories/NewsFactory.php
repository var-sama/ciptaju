<?php

namespace Database\Factories;

use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'content' => fake()->paragraphs(3, true),
            'image_path' => 'news/'.fake()->uuid().'.jpg',
            'published_at' => fake()->dateTimeBetween('-1 year', 'now'),
            'title' => fake()->sentence(6),
        ];
    }
}
