<?php

namespace Database\Seeders;

use App\Models\Event as ModelsEvent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class Event extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        ModelsEvent::insert([
            [
                'title' => 'Nikahan',
                'created_at' =>$now
            ],
            [
                'title' => 'Reoni',
                'created_at' =>$now
            ]
        ]);
    }
}
