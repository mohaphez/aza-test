<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StarLog>
 */
class StarLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'star' => fake()->numberBetween(-5, 5),
            'user_id' => User::all()->random()->id,
            'post_id' => Post::all()->random()->id
        ];
    }
}
