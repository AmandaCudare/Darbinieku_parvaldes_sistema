<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function scopeWeeksHoursWithProjects($query,$user_id, $week){

        $hours=DB::select("SELECT hours.hours, hours.day, projects.title FROM `projects` JOIN `hours`ON projects.id=hours.project_id JOIN `users` ON hours.user_id=users.id WHERE users.id=? AND hours.week=? GROUP BY hours.day ASC, projects.title, hours.hours ",[$user_id, $week]);
         
        return $hours;
     }

     public function scopeWeeksHoursWithoutProjects($query,$user_id, $week){

        $hours=DB::select("SELECT hours.hours, hours.day FROM `hours` JOIN `users` ON hours.user_id=users.id WHERE users.id=? AND hours.week=? AND hours.project_id IS NULL GROUP BY hours.day ASC, hours.hours",[$user_id, $week]);
         
        return $hours;
     }  

}
