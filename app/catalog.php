<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    protected $table = 'catalog';
    public $primaryKey = 'id';
    public $timestamps = true;

    public function genre()
    {
        return $this->belongsTo('App\Genre', 'genreId');
    }

    public function author()
    {
        return $this->belongsTo('App\Author', 'authorId');
    }
}
