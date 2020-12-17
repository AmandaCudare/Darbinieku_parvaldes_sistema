<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPosition extends Model
{
    //Ar šo specifizē kuru datu bāzes tabulu modelis izmantos
    protected $table = "user_positions";

    //Veido attiecību starp lietotāja pieteikšanās un amata datu bāzes tabulam
    public function position(){
        return $this->belongsTo('App\Position');
    }

    //Veido attiecību starp lietotāja pieteikšanās un lietotāja datu bāzes tabulam
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
