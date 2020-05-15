<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class empleadoModel extends Model
{
    protected $table = 'catEmpleado';
    protected $primaryKey = 'kId';
    public $timestamps = false;

    public function relEmpleadoTipoEmpleado()
    {
        return $this->belongsTo('App\Models\tipoEmpleadoModel', 'iTipoEmpleado');
    }
}