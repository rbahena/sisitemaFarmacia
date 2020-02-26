<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'catUser';
    protected $primaryKey = 'kId';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */ 
     protected $fillable = [
        'sUsrName','email','sEmailVerified','password','sToken','fFechaAlta','fFechaBaja','bEstatus'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
