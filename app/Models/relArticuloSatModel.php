<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class relArticuloSatModel extends Model
{
    protected $table = 'movarticulosat';
    protected $primaryKey = 'kId';
    public $timestamps = false;

    public function relSATArticulo()
    {
        return $this->belongsTo('App\Models\articulo', 'fkIdArticulo');
    }

    public function relSATMedidaSAT()
    {
        return $this->belongsTo('App\Models\medidaSAT', 'fkIdUMedidaSAT');
    }
}