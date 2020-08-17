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
        $this->call([PositionInDepartmentsTableSeeder::class,
                    RoomsTableSeeder::class,
                    DepartmentsTableSeeder::class,
                    UsersTableSeeder::class,
                    AdminsTableSeeder::class,
                    ]);
    }
}