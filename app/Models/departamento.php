<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class departamento extends Model
{
    protected $table = 'catDepartamento';
    protected $primaryKey = 'kId';
    public $timestamps = false;
}