<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class genre extends Model
{
  protected $table = 'genre';
  public $primaryKey = 'id';
  public $timestamps = true;
}
