<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hours_user extends Model
{
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function hour(){
        return $this->belongsTo('App\Hour','worked_hours_id');
    }
}
