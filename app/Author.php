<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
  protected $table = 'author';
  public $primaryKey = 'id';
  public $timestamps = true;
}
