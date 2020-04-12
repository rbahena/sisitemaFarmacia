<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class codigoBarraModel extends Model
{
    protected $table = 'movArticuloCodigo';
    protected $primaryKey = 'kId';
    public $timestamps = false;

    public function relCodigosBarraArticulo()
    {
        return $this->belongsTo('App\Models\articulo', 'fkIdArticulo');
    }
}