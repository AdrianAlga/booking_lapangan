<?php

namespace Database\Seeders;

use App\Models\Time;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TimesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $times = [
            ['clock' => '08:00:00'],
            ['clock' => '09:00:00'],
            ['clock' => '10:00:00'],
            ['clock' => '11:00:00'],
            ['clock' => '12:00:00'],
            ['clock' => '13:00:00'],
            ['clock' => '14:00:00'],
            ['clock' => '15:00:00'],
            ['clock' => '16:00:00'],
            ['clock' => '17:00:00'],
            ['clock' => '18:00:00'],
            ['clock' => '19:00:00'],
            ['clock' => '20:00:00'],
            ['clock' => '21:00:00'],
            ['clock' => '22:00:00'],
        ];

        foreach ($times as $time) {
            Time::create($time);
        }
    }
}
