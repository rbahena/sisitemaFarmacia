<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class articuloPrecioModel extends Model
{
    protected $table = 'movarticuloprecio';
    protected $primaryKey = 'kId';
    public $timestamps = false;

    public function relPrecioArticulo()
    {
        return $this->belongsTo('App\Models\articulo', 'fkIdArticulo');
    }
}