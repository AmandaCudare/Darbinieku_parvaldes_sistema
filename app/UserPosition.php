<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    //Visu amatu pieteikumus notiektā projektā noteiktajam lietotājam
    public function scopeProjectsPositions($query,$user_id, $projects_id){
        $assigned_count = DB::select("SELECT user_positions.id ,user_positions.accepted, user_positions.assigned, user_positions.position_id
        FROM `user_positions` JOIN `positions` ON user_positions.position_id=positions.id 
        JOIN `projects` ON positions.project_id=projects.id 
        JOIN `users` ON users.id=user_positions.user_id
        WHERE users.id=? AND projects.id=?
        AND (user_positions.accepted IS NULL OR user_positions.accepted IS NOT NULL)"
        ,[$user_id, $projects_id]);
    
        return $assigned_count;
     }
}
