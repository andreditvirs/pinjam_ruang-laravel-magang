<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoomsTableSeeder::class);
        // User::create([
        //     "nama" => "cacan",
        //     "username" => "admin",
        //     // "user_accessed" =>"administrator",
        //     "password" => Hash::make('admin')
        // ]);
    }
}
