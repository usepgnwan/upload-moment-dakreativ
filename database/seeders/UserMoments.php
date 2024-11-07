<?php

namespace Database\Seeders;

use App\Models\UserMoment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserMoments extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $count = $this->command->ask('Berapa Create Message? ');

        $check = $this->command->confirm('Yakin Create Message?');
        if ($check) {
            UserMoment::factory($count)->create();
        } else {
            $this->command->info('gagal buat Message');
        }
    }
}
