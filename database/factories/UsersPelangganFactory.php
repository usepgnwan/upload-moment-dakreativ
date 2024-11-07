<?php

namespace Database\Factories;

use App\Models\UsersPelanggan;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UsersPelanggan>
 */
class UsersPelangganFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = UsersPelanggan::class;

    public function definition(): array
    {

        return [
            'name' => fake()->name(),
            'token' => fake()->lexify('?????'),
            'foto' =>  $this->faker->imageUrl(640, 480, 'nature', true, 'Faker'),
            'foto_sampul' =>  $this->faker->imageUrl(640, 480, 'nature', true, 'Faker'),
            'paket_id'=> rand(1,2),
            'event_id'=> rand(1,2),
            'user_id'=> 1,
            'tanggal_acara'=> Carbon::now()->format('Y-m-d')
        ];
    }
}
