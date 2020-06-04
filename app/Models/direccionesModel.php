<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class direccionesModel extends Model
{
    protected $table = 'catDireccion';
    protected $primaryKey = 'kId';
    public $timestamps = false;
}
