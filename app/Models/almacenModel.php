<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class almacenModel extends Model
{
    protected $table = 'catAlmacen';
    protected $primaryKey = 'kId';
    public $timestamps = false;
}