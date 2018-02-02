<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    protected $table = 'catalog';
    public $primaryKey = 'id';
    public $timestamps = true;
}
