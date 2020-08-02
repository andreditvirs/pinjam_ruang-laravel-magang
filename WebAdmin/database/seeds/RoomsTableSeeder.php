<?php

use App\Room;
use Illuminate\Database\Seeder;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Room::create([
            'nama' => 'Ruang Aula',
            'lantai' => '1',
            'kapasitas' => '50',
            'fasilitas' => 'AC',
            'foto' => 'ruang/ruang_aula.jpg'
        ]);

        Room::create([
            'nama' => 'Ruang Smart Province',
            'lantai' => '2',
            'kapasitas' => '50',
            'fasilitas' => 'Proyektor',
            'foto' => 'ruang/ruang_smart_office.jpg'
        ]);

        Room::create([
            'nama' => 'Ruang Rapat Kadis',
            'lantai' => '2',
            'kapasitas' => '50',
            'fasilitas' => 'Kipas Angin',
            'foto' => 'ruang/ruang_rapat_kadis.jpg'
        ]);

        Room::create([
            'nama' => 'Ruang Komando',
            'lantai' => '1',
            'kapasitas' => '50',
            'fasilitas' => 'Kulkas',
            'foto' => 'ruang/ruang_komando.jpg'
        ]);

        Room::create([
            'nama' => 'Ruang Workshop',
            'lantai' => '1',
            'kapasitas' => '50',
            'fasilitas' => 'AC, Podium',
            'foto' => 'ruang/ruang_workshop.jpg'
        ]);
        
    }
}
