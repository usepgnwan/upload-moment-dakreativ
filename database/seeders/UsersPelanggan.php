<?php

namespace Database\Seeders;

use App\Models\UsersPelanggan as ModelsUsersPelanggan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersPelanggan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $count = $this->command->ask('Berapa Create user? ');

        $check = $this->command->confirm('Yakin Create user?');
        if ($check) {
            ModelsUsersPelanggan::factory( $count)->create()->each(function($v){

                  // Step 1: Format the name by removing spaces
                $username = Str::slug($v->name, '-');

                // Step 2: Check for uniqueness
                $originalUsername = $username;
                $counter = 1;

                while (ModelsUsersPelanggan::where('username', $username)->exists()) {
                    $username = $originalUsername . $counter;
                    $counter++;
                }

                // Assign the unique username to the user and save
                $v->username = $username;
                $v->save();

            });
        } else {
            $this->command->info('gagal buat user');
        }
    }
}
