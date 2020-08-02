<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'nama', 'lantai', 'kapasitas', 'fasilitas', 'foto'
    ];
}
