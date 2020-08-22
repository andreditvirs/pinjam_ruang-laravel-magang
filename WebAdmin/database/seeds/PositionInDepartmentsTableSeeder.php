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
            'nama' => 'Kepala Bidang'
        ]);

        PositionInDepartment::create([
            'nama' => 'Kasubagian'
        ]);

        PositionInDepartment::create([
            'nama' => 'Sekertaris'
        ]);

        PositionInDepartment::create([
            'nama' => 'Anggota'
        ]);
    }
}
