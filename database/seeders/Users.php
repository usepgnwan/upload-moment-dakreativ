<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $count = $this->command->ask('Berapa Create user? ');

        $check = $this->command->confirm('Yakin Create user?');
        if ($check) {
            User::factory(10)->create();
        } else {
            $this->command->info('gagal buat user');
        }
    }
}
