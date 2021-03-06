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
    
    //Katras dienas dienas izdarītā ierakstu notiektai nedēļai
    public function scopeWeeksHoursWithProjects($query,$user_id, $week){

        $hours=DB::select("SELECT projects.id, SUM(hours.hours) as hours, hours.day FROM `projects` 
        JOIN `hours`ON projects.id=hours.project_id JOIN `users` ON hours.user_id=users.id 
        WHERE users.id=? AND hours.week=? GROUP BY hours.day ASC, projects.id",[$user_id, $week]);
        
        return $hours;
     }

     //Noteiktas nedēļas katra projekta nostrādāto stundu summa
    public function scopeProjectsSum($query,$user_id, $week){

        $hours=DB::select("SELECT SUM(hours.hours) as sum ,projects.id 
        FROM `projects` JOIN `hours` ON projects.id=hours.project_id 
        JOIN `users` ON hours.user_id=users.id 
        WHERE users.id=? AND hours.week=? 
        GROUP BY projects.id, projects.title",[$user_id, $week]);
        
        return $hours;
     }

     //Katras dienas dienas izdarītā ierakstu notiektai nedēļai ārpus projekta
     public function scopeOutofProjectsSum($query,$user_id, $week){

        $hours=DB::select("SELECT SUM(hours.hours) as sum  
        FROM `hours` JOIN `users` ON hours.user_id=users.id 
        WHERE users.id=? AND hours.week=? AND hours.project_id IS NULL",[$user_id, $week]);
         
        return $hours;
     }

     //noteiktās nedēļas nostrādāto stundu summa
     public function scopeTotalHours($query,$user_id, $week){

        $hours=DB::select("SELECT SUM(hours.hours) as total  
        FROM `hours` JOIN `users` ON hours.user_id=users.id 
        WHERE users.id=? AND hours.week=?",[$user_id, $week]);
         
        return $hours;
     }

     //Katras dienas dienas izdarītā ierakstu notiektai nedēļai ārpus projekta
    public function scopeWeeksHoursWithoutProjects($query,$user_id, $week){

        $hours=DB::select("SELECT SUM(hours.hours) as hours, hours.day 
        FROM `hours` JOIN `users` ON hours.user_id=users.id 
        WHERE users.id=? AND hours.week=? AND hours.project_id IS NULL 
        GROUP BY hours.day ASC",[$user_id, $week]);
         
        return $hours;
     }  

    //visi dienas izdarītie ieraksti dilstoša secībā noteiktam lietotājam 
     public function scopeEachDay($query,$user_id){

        $hours=DB::select("SELECT hours.id, hours.day, hours.description, hours.hours, hours.project_id
        FROM `hours` JOIN `users` ON hours.user_id=users.id WHERE users.id=?
        GROUP BY hours.day DESC,hours.id, hours.description, hours.hours, hours.project_id",[$user_id]);
         
        return $hours;
     }

}
