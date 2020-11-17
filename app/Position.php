<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $table = "positions";

   public function project(){
    return $this->belongsTo('App\Project','project_id');
   }
    public function user_positions(){
        return $this->hasMany('App\UserPosition');
    }

}
