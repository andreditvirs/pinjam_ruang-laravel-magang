<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserAuth extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'users';
    /** 
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nip', 'username', 'password','nama', 'jenis_kelamin', 'jabatan_id', 'department_id', 'foto'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    
    protected $hidden = [
        'id', 'password', 'remember_token', 'department_id', 'jabatan_id', 'created_at', 'updated_at'

    ];
}
