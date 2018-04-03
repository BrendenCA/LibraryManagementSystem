<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    protected $table = 'borrow';
    public $primaryKey = 'id';
    public $timestamps = false;
    protected $dates = ['borrowed_on', 'returned_on'];

    public function calcFine()
    {
        $temp = $this->borrowed_on->diffInDays(now());
        if($temp > 10)
          return $temp*100;
        return 0;
    }

    public function calcCharges($at)
    {
        $duration = $this->borrowed_on->diffInDays($at);
        if($duration == 0)
          $duration =  1;
        return $this->catalog->price * $duration;
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'userId');
    }

    public function catalog()
    {
        return $this->belongsTo('App\Catalog', 'catalogId');
    }
}
