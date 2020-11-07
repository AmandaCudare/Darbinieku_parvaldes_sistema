<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    protected $table = 'projects';

   public function positions(){
       return $this->hasMany('App\Position');
   }

   public function user(){
    return $this->belongsTo('App\User','creator_id');
    }

    public function hours(){
    return $this->hasMany('App\Hour');
    }
}
