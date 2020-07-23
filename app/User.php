<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'nip', 'username', 'password','nama', 'jenis_kelamin', 'jabatan_id', 'departement_id'
    ];
}
