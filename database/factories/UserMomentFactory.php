<?php

namespace Database\Factories;

use App\Models\UserMoment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UserMomentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        $fileUrl = $this->faker->imageUrl(640, 480, 'nature', true, 'Faker');
        $fileExtension = pathinfo($fileUrl, PATHINFO_EXTENSION);
        return [

            'type' => 'public',
            'user_massage_id' => rand(1,3),
            'user_pelanggan_id' => 1,
            'file' => $fileUrl,
            'ext' => $fileExtension ,
        ];
    }
}
