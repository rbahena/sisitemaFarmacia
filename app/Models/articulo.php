<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class articulo extends Model
{
    protected $table = 'catArticulo';
    protected $primaryKey = 'kId';
    public $timestamps = false;

    public function relDptoArticulo()
    {
        return $this->belongsTo('App\Models\departamento', 'fkIdDepartamento');
    }
    public function relLabArticulo()
    {
        return $this->belongsTo('App\Models\departamento', 'fkIdDepartamento');
    }
}
