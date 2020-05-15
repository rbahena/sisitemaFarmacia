<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tipoEmpleadoModel extends Model
{
    protected $table = 'catTEmpleado';
    protected $primaryKey = 'kId';
    public $timestamps = false;
}