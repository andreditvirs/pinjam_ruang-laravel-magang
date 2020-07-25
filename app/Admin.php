<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $fillable = [
        'nip', 'username', 'password','nama', 'jenis_kelamin', 'jabatan_id', 'department_id', 'foto'
    ];
}
