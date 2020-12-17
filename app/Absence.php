<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    //Ar šo specifizē kuru datu bāzes tabulu modelis izmantos
    protected $table = 'absences';
    
    //Veido attiecību starp prombūtnes un lietotāja datu bāzes tabulam
    public function user(){
        return $this->belongsTo('App\User');
    }
}
