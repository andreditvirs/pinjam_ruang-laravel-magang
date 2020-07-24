<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'r_id', 'u_id', 'keperluan', 'tanggal_mulai', 'tanggal_selesai', 'file'
    ];
}
