<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Comment::class;

    public function definition(): array
    {
        return [
            'comment'=>fake()->text(50),
            'user_id' => $this->faker->randomElement([4, 1]),
            'post_id' => $this->faker->randomElement([8,17,46 ]),
        ];
    }
}
