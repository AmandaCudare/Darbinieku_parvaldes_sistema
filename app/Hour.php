<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hour extends Model
{
    //Ar šo specifizē kuru datu bāzes tabulu modelis izmantos
    protected $table = 'hours';

    //Veido attiecību starp nostrādātajām stundām un lietotāju datu bāzes tabulām
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    //Veido attiecību starp nostrādātajām stundām un projekta datu bāzes tabulām
    public function project(){
        return $this->belongsTo('App\Project','project_id');
    }

}
