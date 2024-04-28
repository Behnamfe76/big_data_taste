<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BigDataCachIndex>
 */
class BigDataCacheIndexFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'body' => 'Rerum repellat harum tempore exercitationem. Harum vel qui eius commodi velit fugiat. Maxime et laudantium voluptas aut laboriosam. Iusto provident quam est et sed.',
            'image' => '/var/folders/ln/c8y8x9ys4xbgwn0z62ctwkq00000gn/T/67e86ec524a099e8b51c80dcf872d87c.png',
            'country' => 'france',
            'city' => 'paris',
            'address' => 'Rerum voluptatem',
            'email' => 'behnam@gmail.com',
            'test5' => 'Rerum voluptatem adipisci facere at voluptates quo atque.',
            'test6' => 'Rerum voluptatem adipisci facere at voluptates quo atque.',
            'test7' => 'Rerum voluptatem adipisci facere at voluptates quo atque.',
            'test8' => 'Rerum voluptatem adipisci facere at voluptates quo atque.',
            'test9' => 'Rerum voluptatem adipisci facere at voluptates quo atque.',
            'test10' => 'Rerum voluptatem adipisci facere at voluptates quo atque.',
            'test11' => 'Rerum voluptatem adipisci facere at voluptates quo atque.',
            'test12' => 'Rerum voluptatem adipisci facere at voluptates quo atque.',
            'test13' => 'Rerum voluptatem adipisci facere at voluptates quo atque.',
        ];
    }
}
