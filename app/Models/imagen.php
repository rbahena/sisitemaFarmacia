<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class imagen extends Model
{
    protected $table = 'movImage';
    protected $primaryKey = 'kId';
    public $timestamps = false;

    public function relImagenArticulo()
    {
        return $this->belongsTo('App\Models\articulo', 'fkIdArticulo');
    }
}