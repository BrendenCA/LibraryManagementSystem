<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
  public $timestamps = true;

  public function borrow()
  {
      return $this->belongsTo('App\Borrow', 'borrowId');
  }

  public function user()
  {
      return $this->belongsTo('App\Users', 'userId');
  }
}
