<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class direccionesModel extends Model
{
    protected $table = 'relProveedorDireccion';
    protected $primaryKey = 'fkIdProveedor';
    public $timestamps = false;
}