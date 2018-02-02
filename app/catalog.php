<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class catalog extends Model
{
    protected $table = 'catalog';
    public $primaryKey = 'id';
    public $timestamps = true;
}
