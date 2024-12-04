<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Post::class;
    public function definition(): array
    {
        return [
        
            'title' => $this->faker->sentence, // Generate a random title
            'summary' => $this->faker->text(100), // Generate a random summary
            'content' => $this->faker->text(200), // Generate random content
            'image' => $this->faker->imageUrl(), // Generate a random image URL
            'user_id' => $this->faker->randomElement([2, 1]), // Create a related user if needed
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
