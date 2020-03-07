<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class articuloStockModel extends Model
{
    protected $table = 'movArticuloStock';
    protected $primaryKey = 'kId';
    public $timestamps = false;

    public function relStockArticulo()
    {
        return $this->belongsTo('App\Models\articulo', 'fkIdArticulo');
    }
}