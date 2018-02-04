<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $table = 'genre';
    public $primaryKey = 'id';
    public $timestamps = true;

    public function catalog()
    {
        return $this->hasMany('App\Catalog', 'genreId');
    }
}
