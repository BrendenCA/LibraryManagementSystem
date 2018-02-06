<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    protected $table = 'borrow';
    public $primaryKey = 'id';
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User', 'userId');
    }

    public function catalog()
    {
        return $this->belongsTo('App\Catalog', 'catalogId');
    }
}
