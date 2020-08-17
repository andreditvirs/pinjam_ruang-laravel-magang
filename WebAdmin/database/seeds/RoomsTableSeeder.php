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
            'lantai' => '4',
            'kapasitas' => '150',
            'fasilitas' => 'AC , Wifi, Podium, Proyektor, Microfone, Gong',
            'foto' => 'rooms/aula.jpg'
        ]);

        Room::create([
            'nama' => 'Ruang Komando',
            'lantai' => '1',
            'kapasitas' => '25',
            'fasilitas' => 'Kulkas',
            'foto' => 'rooms/komando.jpg'
        ]);

        Room::create([
            'nama' => 'Ruang Rapat Kadis',
            'lantai' => '2',
            'kapasitas' => '30',
            'fasilitas' => 'Wifi, Whiteboard, AC, LEDTelevisi, Sound System',
            'foto' => 'rooms/rapat_kadis.jpg'
        ]);

        Room::create([
            'nama' => 'Ruang Smart Province',
            'lantai' => '4',
            'kapasitas' => '15',
            'fasilitas' => 'Proyektor, Speaker, AC, Komputer, Wifi',
            'foto' => 'rooms/smart_province.jpg'
        ]);

        Room::create([
            'nama' => 'Ruang Workshop',
            'lantai' => '1',
            'kapasitas' => '20',
            'fasilitas' => 'AC, Proyektor, AC, Komputer',
            'foto' => 'rooms/workshop.jpg'
        ]);
        
    }
}
