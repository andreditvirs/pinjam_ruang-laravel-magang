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
            'nama' => 'Ruang Anjasmoro',
            'lantai' => '4',
            'kapasitas' => '150',
            'fasilitas' => 'AC , Wi-Fi, Podium, Proyektor, Microfone, Gong',
            'foto' => 'rooms/anjasmoro.jpg'
        ]);

        Room::create([
            'nama' => 'Ruang Argopuro',
            'lantai' => '2',
            'kapasitas' => '30',
            'fasilitas' => 'Wi-Fi, Whiteboard, AC, LED Televisi, Sound System',
            'foto' => 'rooms/argopuro.jpg'
        ]);

        Room::create([
            'nama' => 'Ruang Panderman',
            'lantai' => '3',
            'kapasitas' => '25',
            'fasilitas' => '12 PC Komputer, Smart TV, Wi-Fi, AC, CCT TV, Fingerprint',
            'foto' => 'rooms/panderman.jpeg'
        ]);

        Room::create([
            'nama' => 'Ruang Semeru',
            'lantai' => '4',
            'kapasitas' => '15',
            'fasilitas' => 'Proyektor, Speaker, AC, Komputer, Wi-Fi',
            'foto' => 'rooms/semeru.jpg'
        ]);

        Room::create([
            'nama' => 'Ruang Wilis',
            'lantai' => '1',
            'kapasitas' => '20',
            'fasilitas' => 'AC, Proyektor, Komputer',
            'foto' => 'rooms/wilis.jpg'
        ]);
        
    }
}
