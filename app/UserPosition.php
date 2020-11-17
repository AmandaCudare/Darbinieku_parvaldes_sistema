<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPosition extends Model
{
    protected $table = "user_positions";
    public function position(){
        return $this->belongsTo('App\Position');
    }
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
