<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            "password" => bcrypt("admin"),
            'user_name' => "admin",
            'user_role' => "admin",
            'registered_at' => now(),
            'registered' => 1,
        ]);
    }
}
