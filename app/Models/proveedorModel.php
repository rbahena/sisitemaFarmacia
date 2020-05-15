<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class proveedorModel extends Model
{
    protected $table = 'catProveedor';
    protected $primaryKey = 'kId';
    public $timestamps = false;
}