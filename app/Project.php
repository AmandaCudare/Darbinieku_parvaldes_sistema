<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Project extends Model
{
   //Ar so specifizē kuru datu bāzes tabulu modelis izmantos
   protected $table = 'projects';
   //veido attiecību starp projekta un amatu datu bāzes tabulām, kurā projektam ir daudz amatu
   public function positions(){
       return $this->hasMany('App\Position');
   }
//veido attiecību starp projekta un lietotāju datu bāzes tabulām, kurā projektam viens lietotajs, kas izveido projektu
   public function user(){
    return $this->belongsTo('App\User','creator_id');
    }
//veido attiecību starp projekta un nostrādāto stundu datu bāzes tabulām, kurā projektam ir vairakas nostrādātās stundas ieraksti
    public function hours(){
    return $this->hasMany('App\Hour');
    }
   //Funkcija, kurā no datu bāzes iegūst projektu lietotāja kas ir apstiprināts projekta amatā
    public function scopeAssignedProjects($query,$user_id){

       $assignprojects=DB::select("SELECT projects.title, projects.start_date, projects.end_date, projects.assign_till, projects.id FROM `projects` JOIN `positions` ON projects.id=positions.project_id JOIN `user_positions` ON user_positions.position_id=positions.id JOIN `users` ON user_positions.user_id=users.id WHERE users.id=? AND user_positions.accepted='1' GROUP BY projects.title, projects.start_date ASC, projects.end_date, projects.assign_till, projects.id",[$user_id]);
        
       return $assignprojects;
    }
   //funkcija kurā iegūst projekta nosaukumu un identifikātoru nostrādāto stundu funkcijai
    public function scopeHourProjects($query,$user_id){

        $hourprojects=DB::select("SELECT projects.title, projects.id FROM `projects` JOIN `positions` ON projects.id=positions.project_id JOIN `user_positions` ON user_positions.position_id=positions.id JOIN `users` ON user_positions.user_id=users.id WHERE users.id=? AND user_positions.accepted='1' GROUP BY projects.title, projects.id",[$user_id]);
         
        return $hourprojects;
     }
     //Funckija kurā iegūst projektu kas ir pievienots nostrādāto stundu ierakstam
     public function scopeHourEditProjects($query,$user_id, $project_id){

        $editprojects = DB::select("SELECT projects.id, projects.title FROM `projects` JOIN `positions` ON projects.id=positions.project_id JOIN `user_positions` ON user_positions.position_id=positions.id JOIN `users` ON user_positions.user_id=users.id WHERE users.id=? AND user_positions.accepted=true AND projects.id NOT IN(SELECT projects.id FROM `projects` WHERE projects.id=?) GROUP BY projects.id, projects.title, projects.start_date, projects.end_date",[$user_id, $project_id]);
        
        return $editprojects;
     }
}
