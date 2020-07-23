<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nip' => '123456789123456789',
            'username' => 'username1',
            'password' => Hash::make('username'),
            'nama' => 'Drs. BENNY SAMPIRWANTO, M.Si',
            'jenis_kelamin' => 'L',
            'jabatan_id' => 1,
            'foto' => 'image.jpg',
            'department_id' => 1
        ]);

        User::create([
            'nip' => '111111111111111111',
            'username' => 'username2',
            'password' => Hash::make('username'),
            'nama' => 'Ir. Dra. AJU MUSTIKA DEWI, M.M.',
            'jenis_kelamin' => 'P',
            'jabatan_id' => 1,
            'foto' => 'image.jpg',
            'department_id' => 2
        ]);

        User::create([
            'nip' => '222222222222222222',
            'username' => 'username3',
            'password' => Hash::make('username'),
            'nama' => 'RATNA DIAH AYUNINGTYAS, SE',
            'jenis_kelamin' => 'P',
            'jabatan_id' => 1,
            'foto' => 'image.jpg',
            'department_id' => 3
        ]);

        User::create([
            'nip' => '333333333333333333',
            'username' => 'username4',
            'password' => Hash::make('username'),
            'nama' => 'EKO ROEDHY LOEGMANTO, S.H.',
            'jenis_kelamin' => 'L',
            'jabatan_id' => 1,
            'foto' => 'image.jpg',
            'department_id' => 4
        ]);

        User::create([
            'nip' => '999999999999999999',
            'username' => 'username5',
            'password' => Hash::make('username'),
            'nama' => 'SAMSURI, S.Sos. M.Si',
            'jenis_kelamin' => 'L',
            'jabatan_id' => 1,
            'foto' => 'image.jpg',
            'department_id' => 5
        ]);

        User::create([
            'nip' => '888888888888888888',
            'username' => 'username6',
            'password' => Hash::make('username'),
            'nama' => 'Drs. Ec. RUDY PRASETYA, MM',
            'jenis_kelamin' => 'L',
            'jabatan_id' => 1,
            'foto' => 'image.jpg',
            'department_id' => 6
        ]);

        User::create([
            'nip' => '777777777777777777',
            'username' => 'username7',
            'password' => Hash::make('username'),
            'nama' => 'PUTUT DARMAWAN, SE',
            'jenis_kelamin' => 'L',
            'jabatan_id' => 1,
            'foto' => 'image.jpg',
            'department_id' => 7
        ]);
        
        User::create([
            'nip' => '444444444444444444',
            'username' => 'username8',
            'password' => Hash::make('username'),
            'nama' => 'Drs. AGUNG SRIONO, SH, MM',
            'jenis_kelamin' => 'L',
            'jabatan_id' => 1,
            'foto' => 'image.jpg',
            'department_id' => 8
        ]);

        User::create([
            'nip' => '666666666666666666',
            'username' => 'username9',
            'password' => Hash::make('username'),
            'nama' => 'YANTI DYAH HARSONO, S.Sos, M.Si',
            'jenis_kelamin' => 'P',
            'jabatan_id' => 1,
            'foto' => 'image.jpg',
            'department_id' => 9
        ]);

        User::create([
            'nip' => '555555555555555555',
            'username' => 'username0',
            'password' => Hash::make('username'),
            'nama' => 'EDI SUPAJI, SH, MM',
            'jenis_kelamin' => 'L',
            'jabatan_id' => 1,
            'foto' => 'image.jpg',
            'department_id' => 1
        ]);
    }
}
