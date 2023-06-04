<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "username" => "bookingAdmin",
            "email" => "bookingAdmin@gmail.com",
            "password" => bcrypt('bookingAdmin123'),
            "level" => 1,
        ]);
    }
}
