<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hour extends Model
{
    public function hours_users(){
        return $this->hasMany('App\Hours_user');
    }

    public function project(){
        return $this->belongsTo('App\Project','project_id');
    }

    public function day(){
        return $this->belongsTo('App\Day', 'days_id');
    }
}
