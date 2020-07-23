<?php

use App\PositionInDepartment;
use Illuminate\Database\Seeder;

class PositionInDepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PositionInDepartment::create([
            'nama' => 'Kepala Dinas'
        ]);

        PositionInDepartment::create([
            'nama' => 'Sekertaris'
        ]);

        PositionInDepartment::create([
            'nama' => 'Kasubagian'
        ]);

        PositionInDepartment::create([
            'nama' => 'Kepala'
        ]);

        PositionInDepartment::create([
            'nama' => 'Anggota'
        ]);

        PositionInDepartment::create([
            'nama' => 'Unstruktural'
        ]);
    }
}
