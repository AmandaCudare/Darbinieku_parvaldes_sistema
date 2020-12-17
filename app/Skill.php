<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    //Ar šo specifizē kuru datu bāzes tabulu modelis izmantos
    protected $table = 'skills';
    //Veido attiecību starp prasmi un lietotāja datu bāzes tabulam
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
