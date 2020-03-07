<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class medidaSAT extends Model
{
    protected $table = 'catUMedidaSAT';
    protected $primaryKey = 'kId';
    public $timestamps = false;
    
    // public function relArticulos()
    // {
    //     return $this->belongsToMany('App\Models\articulos', 'movarticulosat');
    // }
}