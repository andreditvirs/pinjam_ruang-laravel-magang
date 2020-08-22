<?php

use App\Department;
use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create([
            'nama' => 'Sekertariat',
            'kepala_id' => 1
        ]);

        Department::create([
            'nama' => 'Bidang Informasi Publik',
            'kepala_id' => 2
        ]);

        Department::create([
            'nama' => 'Bidang Komunikasi Publik',
            'kepala_id' => 3
        ]);

        Department::create([
            'nama' => 'Bidang Aplikasi Informatika',
            'kepala_id' => 4
        ]);

        Department::create([
            'nama' => 'Bidang Infrastruktur TIK',
            'kepala_id' => 5
        ]);

        Department::create([
            'nama' => 'Bidang Pengolahan Data dan Statistik',
            'kepala_id' => 6
        ]);
    }
}
