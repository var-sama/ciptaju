<?php

namespace Database\Factories;

use App\Models\News;
use App\Models\User;
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
            'author_id' => User::factory(),
            'category' => fake()->word(),
            'content' => fake()->paragraphs(3, true),
            'image_path' => 'news/'.fake()->uuid().'.jpg',
            'is_featured' => false,
            'published_at' => fake()->dateTimeBetween('-1 year', 'now'),
            'title' => fake()->sentence(6),
        ];
    }
}
