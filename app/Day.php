<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    public function hours(){
        return $this->hasMany('App\Hour');
        }
}
