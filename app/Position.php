<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Position extends Model
{
    //Ar šo specifizē kuru datu bāzes tabulu modelis izmantos
    protected $table = "positions";

    //Veido attiecību starp amata un projekta datu bāzes tabulam
   public function project(){
    return $this->belongsTo('App\Project','project_id');
   }
    //Veido attiecību starp amatu un lietotāja pieteikšanās datu bāzes tabulam
    public function user_positions(){
        return $this->hasMany('App\UserPosition');
    }
    //Funkcija,kurā iegūst amata nosaukumu un lietotāja informāciju, amatu pieteikumiem
    public function scopeShowPositions($query,$project_id){

        $positions = DB::select("SELECT positions.id as position_id, positions.name,positions.people_count,users.First_name, users.Last_name, users.email, users.id as user_id, user_positions.id as uposition_id 
        FROM `user_positions`JOIN `positions` ON user_positions.position_id=positions.id 
        JOIN `projects` ON projects.id=positions.project_id 
        JOIN `users` ON user_positions.user_id=users.id 
        WHERE projects.id=? AND user_positions.accepted IS NULL 
        GROUP BY user_positions.id, positions.name, users.id, users.First_name, users.Last_name, users.email, positions.id, positions.people_count",[$project_id]);       
        
        return $positions;
     }
     //Funckija, kurā iegūst amata pieteikuma idenfikatoru, kam pieteikums ir apstiprināts
     public function scopeAssignCount($query,$position){

        $assigned_count = DB::select("SELECT user_positions.id 
        FROM `positions` JOIN `user_positions` ON user_positions.position_id=positions.id
         WHERE user_positions.accepted=true AND positions.id=?",[$position]);
    
        return $assigned_count;
     }

     
      
}
