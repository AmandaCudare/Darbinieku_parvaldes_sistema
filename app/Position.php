<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
   public function user(){
       return $this->belongsTo('App\User','user_id');
   }

   public function project(){
    return $this->belongsTo('App\Project','project_id');
}
}
