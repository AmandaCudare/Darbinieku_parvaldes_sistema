<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hour extends Model
{
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
    public function project(){
        return $this->belongsTo('App\Project','project_id');
    }

    public function day(){
        return $this->belongsTo('App\Day', 'days_id');
    }
}
