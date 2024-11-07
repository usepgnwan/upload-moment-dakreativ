<?php

namespace Database\Seeders;

use App\Models\Paket as ModelsPaket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class Paket extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // title
        // harga
        // limit_file
        $now = Carbon::now();
        ModelsPaket::insert([
            [
                'title' => 'Seru',
                'harga' => '300000',
                'limit_file'=> 300,
                'limit_hari'=> 30,
                'created_at' =>$now
            ],
            [
                'title' => 'Asik',
                'harga' => '400000',
                'limit_file'=> 400,
                'limit_hari'=> 40,
                'created_at' =>$now
            ]
        ]);
    }
}
