<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class listaModel extends Model
{
    protected $table = 'catLista';
    protected $primaryKey = 'kId';
    public $timestamps = false;
}